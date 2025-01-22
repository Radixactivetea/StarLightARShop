<?php

namespace Src\Controllers;

use Core\AuthMiddleware;
use Core\AuthService;
use Core\FileValidator;
use Core\FormValidator;
use Exception;

class UserController extends Controller
{
    protected AuthMiddleware $authMiddleware;
    private $userRole;

    public function __construct()
    {
        parent::__construct();

        $this->authMiddleware = new AuthMiddleware();

        $this->userRole = $this->authMiddleware->getUserRole();

        $this->authMiddleware->redirectRestrictedUsers([AuthService::ROLE_GUEST]);
    }

    public function index()
    {
        $user = $this->fetchUser();
        $address = $this->fetchUserAddress();
        $cartNum = $this->fetchCartNum();
        $notiNum = $this->fetchNotiNum();
        $order = $this->fetchOrder();

        if ($this->userRole == 'staff') {

            echo $this->view('seller/setting', ['user' => $user]);

        } else {

            echo $this->view(
                'profile',
                [
                    'user' => $user,
                    'cartNum' => $cartNum,
                    'notiNum' => $notiNum,
                    'order' => $order,
                    'address' => $address
                ]
            );
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/profile');
        }

        [$validator, $fileValidator] = $this->initializeValidators();

        if ($validator->passes() && $fileValidator->passes()) {

            $user = $validator->getSanitizedData();

            try {

                $this->processUpdate($user, $fileValidator);

                clearErrors();

                setFlashMessage(
                    'status',
                    'Successfully update you profile',
                    'success'
                );

                redirect('/profile');

            } catch (Exception $e) {

                dd($e);

                setFlashMessage(
                    'status',
                    'Unable to update your profile. Please try again.',
                    'error'
                );

                redirect('/profile');

            }
        } else {

            setFlashMessage(
                'status',
                'Unable to update your profile. Please try again.',
                'error'
            );

            $this->handleValidationError('/profile', $validator->getErrors());
        }
    }

    private function processUpdate($validator, FileValidator $fileValidator)
    {
        $this->db->transaction(function ($db) use ($validator, $fileValidator) {

            $imagePath = !$fileValidator->isEmpty()
                ? $fileValidator->move('public/upload/profile')
                : $validator['uploaded_file'];


            $db->update(
                'user',
                $_SESSION['user_id'],
                [
                    'firstname' => $validator['firstname'],
                    'lastname' => $validator['lastname'],
                    'email' => $validator['email'],
                    'phone_num' => $validator['phonenum'],
                    'profile_pic_url' => $imagePath
                ],
                'user_id'
            );

            $addressData = [
                'name' => $validator['firstname'] . ' ' . $validator['lastname'],
                'phone_number' => $validator['phonenum'],
                'street_address' => $validator['street_address'] ?? '',
                'city' => $validator['city'] ?? '',
                'state' => $validator['state'] ?? '',
                'post_code' => $validator['post_code'] ?? '',
                'is_default' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            if ($this->fetchUserAddress()) {

                $db->update('address', $_SESSION['user_id'], $addressData, 'user_id');

            } else {

                $addressData['user_id'] = $_SESSION['user_id'];
                $addressData['created_at'] = date('Y-m-d H:i:s');
                $db->insert('address', $addressData);

            }


            $this->updatePassword($validator);

        });
    }

    private function updatePassword($data)
    {

        $user = $this->fetchUser();

        if (!empty($data['currentpassword'])) {

            if ($user && password_verify($data['currentpassword'], $user['password'])) {

                $hashedPassword = password_hash($data['newpassword'], PASSWORD_BCRYPT);

                $this->db->update(
                    'user',
                    $_SESSION['user_id'],
                    [
                        'password' => $hashedPassword
                    ],
                    'user_id'
                );

            } else {

                throw new Exception('Password updated cannot be done.');

            }
        }
    }

    private function initializeValidators()
    {
        $validator = new FormValidator($_POST);
        $fileValidator = new FileValidator($_FILES['profile_picture']);

        $validator
            ->required('firstname', 'Full name')
            ->required('lastname', 'Last Name')
            ->required('email', 'Email');

        if (!empty($_POST['currentpassword'])) {

            $validator
                ->required('newpassword', 'New password')
                ->minLength('newpassword', 8, 'Password')
                ->required('confirmpassword', 'Confirm password')
                ->minLength('confirmpassword', 8, 'Password')
                ->match('newpassword', 'confirmpassword', 'Password');

        }

        $fileValidator
            ->maxSize(5);

        return [$validator, $fileValidator];
    }

    private function fetchUser()
    {
        return $this->db->findOrFail('user', ['user_id' => $_SESSION['user_id']]);
    }

    private function fetchUserAddress()
    {
        return $this->db->find('address', conditions: ['user_id' => $_SESSION['user_id'], 'is_default' => 1]);
    }

    private function fetchCartNum()
    {
        return $this->db->query('SELECT COUNT(*) AS total_items FROM cart_items WHERE user_id = :id;', ['id' => $_SESSION['user_id']])->fetch();
    }

    private function fetchNotiNum()
    {
        return $this->db->query('SELECT COUNT(*) AS total_notification FROM notifications WHERE user_id = :id;', ['id' => $_SESSION['user_id']])->fetch();
    }

    private function fetchOrder()
    {
        $orders = $this->db->query("SELECT o.*, (SELECT COUNT(*) FROM orders WHERE user_id = :id) AS total_orders,
            COALESCE(SUM(oi.quantity), 0) AS total_items
            FROM orders o
            LEFT JOIN order_item oi ON o.order_id = oi.order_id
            WHERE o.user_id = :id
            GROUP BY o.order_id;",
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
            'shipped' => 'status-shipped',
            'delivered' => 'status-shipped',
            default => 'status-pending'
        };
    }

    protected function updateStatusOrder(string $status): string
    {
        return match (strtolower($status)) {
            'paid' => 'Processing',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled',
            'processing' => 'Not Paid Yet!',
            'shipped' => 'Shipped',
            default => 'processing'
        };
    }
}