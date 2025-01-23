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

    public function manageUser()
    {
        $this->authMiddleware->authenticate(AuthService::ROLE_ADMIN);

        $ban_requests = $this->db->query('SELECT br.*, u.firstname FROM ban_requests br LEFT JOIN user u ON br.seller_id = u.user_id 
    ORDER BY br.created_at DESC;')->fetchAll();

        $statusClassMap = [
            'pending' => 'bg-warning',
            'approved' => 'bg-success',
            'rejected' => 'bg-danger',
        ];

        foreach ($ban_requests as &$ban_request) {
            // Map the status to a CSS class
            $ban_request['css_class'] = $statusClassMap[$ban_request['status']] ?? 'text-muted';

            // Format the created_at date
            $ban_request['formatted_date'] = date('d M Y, H:i A', strtotime($ban_request['created_at']));

            // Limit the reason to a preview (e.g., first 50 characters)
            $ban_request['reason_preview'] = strlen($ban_request['reason']) > 50
                ? substr($ban_request['reason'], 0, 47) . '...'
                : $ban_request['reason'];
        }

        $summary = $this->db->query("SELECT 
        COUNT(CASE WHEN br.status = 'pending' THEN 1 END) AS total_pending,
        COUNT(CASE WHEN br.status = 'approved' THEN 1 END) AS total_approved,
        COUNT(CASE WHEN br.status = 'rejected' THEN 1 END) AS total_rejected,
        COUNT(DISTINCT br.seller_id) AS total_banned_users
    FROM ban_requests br
    WHERE br.status IN ('pending', 'approved', 'rejected')")->fetch();


        echo $this->view('admin/usermanagement', ['ban' => $ban_requests, 'summary' => $summary]);
    }

    public function banUser()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/user-management/user');
        }

        $dateTime = new \DateTime('now', new \DateTimeZone('Asia/Kuala_Lumpur'));

        try {

            $this->db->update(
                'ban_requests',
                $_POST['ban_id'],
                [
                    'status' => 'approved',
                    'admin_id' => $_SESSION['user_id'],
                    'updated_at' => $dateTime->format('Y-m-d H:i:s')
                ],
                'id'
            );

            $this->db->update(
                'user',
                $_POST['user_id'],
                [
                    'banned' => '1'
                ],
                'user_id'
            );

            $this->db->insert(
                'notifications',
                [
                    'user_id' => $_POST['seller_id'],
                    'title' => 'Banning request on ' . $_POST['user_id'],
                    'message' => 'Succesfull ban ' . $_POST['user_id'],
                    'category' => 'review'
                ]
            );

            setFlashMessage(
                'status',
                'You approve to ban this user'
            );

            redirect('/user-management/user');

        } catch (Exception $e) {

            dd($e);
            $this->handleProcessError($e, '/user-management/user');

        }
    }

    public function rejectBan()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/user-management/user');
        }

        $dateTime = new \DateTime('now', new \DateTimeZone('Asia/Kuala_Lumpur'));

        try {

            $this->db->update(
                'ban_requests',
                $_POST['ban_id'],
                [
                    'status' => 'rejected',
                    'admin_id' => $_SESSION['user_id'],
                    'updated_at' => $dateTime->format('Y-m-d H:i:s'),
                    'admin_notes' => $_POST['rejection_note']
                ],
                'id'
            );

            $this->db->insert(
                'notifications',
                [
                    'user_id' => $_POST['seller_id'],
                    'title' => 'Banning request on ' . $_POST['user_id'],
                    'message' => 'Your request were rejected: ' . $_POST['rejection_note'],
                    'category' => 'review'
                ]
            );

            setFlashMessage(
                'status',
                'You did not approve to ban this user'
            );

            redirect('/user-management/user');

        } catch (Exception $e) {

            dd($e);
            $this->handleProcessError($e, '/user-management/user');

        }
    }

    public function manageSeller()
    {
        $this->authMiddleware->authenticate(AuthService::ROLE_ADMIN);

        $summary = $this->db->query("SELECT 
        COUNT(CASE WHEN sr.status = 'pending' THEN 1 END) AS total_pending,
        COUNT(CASE WHEN sr.status = 'approved' THEN 1 END) AS total_approved,
        COUNT(CASE WHEN sr.status = 'rejected' THEN 1 END) AS total_rejected,
        (
            SELECT COUNT(*) 
            FROM user 
            WHERE role = 'staff'
        ) AS total_sellers
    FROM seller_requests sr;")->fetch();

        $request = $this->db->query(" SELECT sr.*, u.firstname AS user_firstname,s.user_id AS seller_id, s.firstname AS requested_by_name 
        FROM seller_requests sr LEFT JOIN user u ON sr.user_id = u.user_id LEFT JOIN user s ON sr.requested_by = s.user_id")->fetchAll();

        $statusClassMap = [
            'pending' => 'bg-warning',
            'approved' => 'bg-success',
            'rejected' => 'bg-danger',
        ];

        foreach ($request as &$user) {
            // Map the status to a CSS class
            $user['css_class'] = $statusClassMap[$user['status']] ?? 'text-muted';

            // Format the created_at date
            $user['formatted_date'] = date('d M Y, H:i A', strtotime($user['created_at']));

        }

        $allSeller = $this->db->findAll('user', ['role' => 'staff']);

        echo $this->view('admin/sellermanagement', ['summary' => $summary, 'request' => $request, 'allSeller' => $allSeller]);
    }

    public function transferSeller()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/user-management/seller');
        }

        try {

            $this->db->update(
                'seller_requests',
                $_POST['request_id'],
                [
                    'status' => 'approved'
                ],
                'id'
            );

            $this->db->update(
                'user',
                $_POST['user_id'],
                [
                    'role' => 'staff'
                ],
                'user_id'
            );

            $this->db->insert(
                'notifications',
                [
                    'user_id' => $_POST['seller_id'],
                    'title' => 'Transfer Account ' . $_POST['user_id'],
                    'message' => $_POST['user_id'] . 'Successfully become one of staff members',
                    'category' => 'review'
                ]
            );

            redirect('/user-management/seller');

        } catch (Exception $e){

            dd($e);
            $this->handleProcessError($e, '/user-management/seller');
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

    public function requestBan()
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/help&center/request-ban');
        }

        $requestBanDetails = $this->validateBanRequest($_POST);

        try {

            $this->insertBan($requestBanDetails);

            setFlashMessage(
                'status',
                'Your request submitted',
                'success'
            );

            redirect('/help&center/request-ban');

        } catch (Exception $e) {

            $this->handleProcessError($e, '/help&center/request-ban', $e);

        }
    }

    public function validateSeller()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['unset_session'])) {

            unset($_SESSION['user']);

            redirect('/help&center/request-seller');
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/help&center/request-seller');
        }

        $validation = new FormValidator($_POST);

        $validation->required('email')->email('email');

        if (!$validation->passes()) {
            $this->handleValidationError('/help&center/request-seller', $validation->getErrors());
        }

        $email = $validation->getSanitizedValue('email');

        $userExist = $this->db->find('user', ['email' => $email]);

        if (!$userExist) {

            setFlashMessage(
                'status',
                'User Not Found!',
                'error'
            );

            redirect('/help&center/request-seller');
        }

        unset($_SESSION['user']);

        $_SESSION['user'] = $userExist;

        redirect('/help&center/request-seller');
    }

    public function requestSeller()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/help&center/request-seller');
        }

        try {

            $this->insertRequestSeller($_SESSION['user']);

            unset($_SESSION['user']);

            setFlashMessage(
                'status',
                'Your request has been submited.',
                'success'
            );

            redirect('/help&center/request-seller');

        } catch (Exception $e) {

            dd($e);
            $this->handleProcessError($e, '/help&center/request-seller');

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

    private function insertBan(array $data)
    {
        $dateTime = new \DateTime('now', new \DateTimeZone('Asia/Kuala_Lumpur'));

        $this->db->insert(
            'ban_requests',
            [
                'user_id' => $data['user_id'],
                'seller_id' => $_SESSION['user_id'],
                'reason' => $data['reason'],
                'evidence' => $data['evidence'],
                'created_at' => $dateTime->format('Y-m-d H:i:s')
            ]
        );
    }

    private function validateBanRequest($data)
    {
        $validation = new FormValidator($data);

        $validation
            ->required('username', "User's Name")
            ->required('reason', 'Reason')
            ->required('evidence', 'Evidence');

        if (!$validation->passes()) {

            $this->handleValidationError('/help&center/request-ban', $validation->getErrors());

        }

        $userFirstname = $validation->getSanitizedValue('username');

        $userExist = $this->db->find('user', ['firstname' => $userFirstname]);

        if (!$userExist) {

            setFlashMessage(
                'status',
                "User with name {$userFirstname} is not exist",
                'error'
            );
            redirect('/help&center/request-ban');
        }

        $validations = $validation->getSanitizedData();
        $validations['user_id'] = $userExist['user_id'];

        return $validations;
    }

    private function insertRequestSeller(array $data)
    {
        $dateTime = new \DateTime('now', new \DateTimeZone('Asia/Kuala_Lumpur'));

        $this->db->insert(
            'seller_requests',
            [
                'user_id' => $data['user_id'],
                'status' => 'pending',
                'requested_by' => $_SESSION['user_id'],
                'created_at' => $dateTime->format('Y-m-d H:i:s')
            ]
        );
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
        return $this->db->find('user', ['user_id' => $_SESSION['user_id']]);
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