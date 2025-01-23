<?php

namespace Src\Controllers;

use Core\AuthMiddleware;
use Core\AuthService;
use Core\FormValidator;
use Exception;

class OrderController extends Controller
{
    protected AuthMiddleware $authMiddleware;
    private $userRole;

    public function __construct()
    {
        parent::__construct();

        $this->authMiddleware = new AuthMiddleware();

        $this->userRole = $this->authMiddleware->getUserRole();

        $this->authMiddleware->redirectRestrictedUsers([AuthService::ROLE_ADMIN, AuthService::ROLE_GUEST]);
    }

    public function index()
    {
        $this->authMiddleware->authenticate('staff');

        $orders = $this->getAllOrders();

        echo $this->view('seller/orders', [
            'orders' => $orders
        ]);
    }

    public function orderDetail($id)
    {
        $order = $this->fetchOrder($id);
        $order_item = $this->fetchListItem($id);

        $view = $this->userRole === AuthService::ROLE_CUSTOMER ? 'order' : ($this->userRole === AuthService::ROLE_STAFF ? 'seller/order' : null);

        if ($view) {
            echo $this->view($view, ['order' => $order, 'order_item' => $order_item]);
        }
    }

    public function updateTracking()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/orders');
        }

        $validator = new FormValidator($_POST);

        $validator
            ->minLength('trackingNumberInput', 14)
            ->maxLength('trackingNumberInput', 16)
            ->required('trackingNumberInput');

        if (!$validator->passes()) {

            $this->handleValidationError('/orders', $validator->getErrors());

        }

        clearErrors();


        try {
            $trackingData = $validator->getSanitizedData();

            $trackingNum = $trackingData['order_id'];

            $order = $this->fetchOrder($trackingNum);

            $this->db->update(
                '`orders`',
                $trackingData['order_id'],
                [
                    'tracking_number' => $trackingNum,
                    'order_status' => 'Shipped'
                ],
                'order_id'
            );

            $this->setNotification($trackingData['order_id'], $order['user_id'], $trackingNum);

            setFlashMessage('status', 'Tracking number updated successfully!', 'success');

        } catch (Exception $e) {

            $message = "An error occurred while updating the order. Please try again.";
            $this->handleProcessError($e, 'orders', $message);

        }

        redirect('/orders');
    }

    protected function getAllOrders(): array
    {
        $orders = $this->db->query('SELECT 
            o.*,
            u.firstname,
            DATE_FORMAT(o.date, "%d/%m/%Y") AS formatted_date,
            DATE_FORMAT(o.time, "%h:%i %p") AS formatted_time
            FROM `orders` o
            LEFT JOIN `user` u ON o.user_id = u.user_id
            ORDER BY o.date DESC;'
        )->fetchAll();

        return array_map(function ($order) {

            $order['status_class'] = $this->getStatusClass($order['order_status']);

            $order['can_add_tracking'] = strtolower($order['order_status']) === 'paid' && empty($order['tracking_number']);

            $order['has_tracking'] = !empty($order['tracking_number']);

            return $order;

        }, $orders);
    }

    protected function getStatusClass(string $status): string
    {
        return match (strtolower($status)) {
            'paid' => 'status-paid',
            'cancelled' => 'status-cancelled',
            'processing' => 'status-processing',
            'shipped' => 'status-shipped',
            default => 'status-pending'
        };
    }

    private function fetchOrder($id)
    {
        return $this->db->findOrFail('orders', ['order_id' => $id]);
    }

    private function fetchListItem($id)
    {
        return $this->db->query(
            'SELECT o.*, p.* FROM `order_item` o 
            JOIN product p on o.product_id = p.product_id
            WHERE o.order_id = :order_id',
            ['order_id' => $id]
        )->fetchAll();
    }

    private function setNotification($order, $user, $trackingNum)
    {
        $dateTime = new \DateTime('now', new \DateTimeZone('Asia/Kuala_Lumpur'));

        $this->db->insert(
            'notifications',
            [
                'user_id' => $user,
                'title' => "Order shipped.",
                'message' => "To keep update with your parcel, please refer this tracking number: {$trackingNum}.",
                'category' => 'Order',
                'created_at' => $dateTime->format('Y-m-d H:i:s')
            ]
        );
    }
}