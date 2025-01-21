<?php

namespace Src\Controllers;

use Core\AuthMiddleware;
use Core\AuthService;

class NotificationController extends Controller
{
    protected AuthMiddleware $authMiddleware;
    private string $userRole;

    private const VIEW_PATHS = [
        AuthService::ROLE_STAFF => 'seller/notification',
        AuthService::ROLE_ADMIN => 'notification',
        AuthService::ROLE_CUSTOMER => 'notification'
    ];

    private const CATEGORY_CLASSES = [
        'order' => 'bg-primary',
        'promotion' => 'bg-success',
        'stock' => 'bg-info',
        'review' => 'bg-warning',
        'default' => 'bg-primary'
    ];

    public function __construct()
    {
        parent::__construct();
        
        $this->authMiddleware = new AuthMiddleware();
        $this->userRole = $this->authMiddleware->getUserRole();
        $this->authMiddleware->redirectRestrictedUsers([AuthService::ROLE_GUEST], '/login');
    }

    public function index(): void
    {
        $notifications = $this->fetchNotifications();
        $notifications = $this->enrichNotificationsWithCategories($notifications);
        
        $viewPath = self::VIEW_PATHS[$this->userRole] ?? 'notification';
        echo $this->view($viewPath, ['notifications' => $notifications]);
    }

    private function fetchNotifications(): array
    {
        return $this->db->findAll('notifications', [
            'user_id' => $_SESSION['user_id']
        ]);
    }

    private function enrichNotificationsWithCategories(array $notifications): array
    {
        return array_map(function ($notification) {
            $notification['categoryClass'] = $this->getCategoryClass($notification['category']);
            return $notification;
        }, $notifications);
    }

    private function getCategoryClass(string $category): string
    {
        $category = strtolower($category);
        return self::CATEGORY_CLASSES[$category] ?? self::CATEGORY_CLASSES['default'];
    }
}