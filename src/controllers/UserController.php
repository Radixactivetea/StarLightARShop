<?php

namespace Src\Controllers;

use Core\AuthMiddleware;

class UserController extends Controller
{
    protected AuthMiddleware $authMiddleware;

    public function __construct()
    {
        parent::__construct();

        $this->authMiddleware = new AuthMiddleware();
    }

    public function index()
    {
        $user = $this->fetchUser();
        $cartNum = $this->fetchCartNum();
        $order = $this->fetchOrder();

        echo $this->view(
            'profile',
            [
                'user' => $user,
                'cartNum' => $cartNum,
                'order' => $order
            ]
        );
    }

    private function fetchUser()
    {
        return $this->db->findOrFail('user', ['user_id' => $_SESSION['user_id']]);
    }

    private function fetchCartNum()
    {
        return $this->db->query('SELECT COUNT(*) AS total_items FROM cart_items WHERE user_id = :id;', ['id' => $_SESSION['user_id']])->fetch();
    }

    private function fetchOrder()
    {
        $orders = $this->db->query("SELECT o.*, (SELECT COUNT(*) FROM orders WHERE user_id = :id) AS total_orders,
            COALESCE(SUM(oi.quantity), 0) AS total_items
            FROM orders o
            LEFT JOIN order_item oi ON o.order_id = oi.order_id
            WHERE o.user_id = :id
            GROUP BY o.order_id
            LIMIT 3;",
            ['id' => $_SESSION['user_id']]
        )->fetchAll();

        return array_map(function ($order) {

            $order['status_order'] = $this->updateStatusOrder(status: $order['order_status']);

            $order['status_class'] = $this->getStatusClass(status: $order['status_order']);


            return $order;

        }, $orders);
    }

    protected function getStatusClass(string $status): string
    {
        return match (strtolower($status)) {
            'cancelled' => 'status-cancelled',
            'processing' => 'status-paid',
            'delivered' => 'status-shipped',
            default => 'status-pending'
        };
    }

    protected function updateStatusOrder(string $status): string
    {
        return match (strtolower($status)) {
            'paid' => 'Processing',
            'cancelled' => 'Cancelled',
            'processing' => 'Not Paid Yet!',
            'shipped' => 'Delivered',
            default => 'status-pending'
        };
    }
}