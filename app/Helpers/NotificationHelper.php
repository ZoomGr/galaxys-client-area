<?php

namespace App\Helpers;

use App\Repositories\ChatNotificationsRepository;
use App\Services\ChatNotificationsService;

class NotificationHelper
{
    private $chat_notification_service;

    public function __construct(ChatNotificationsRepository $chat_notification_service) {
        $this->chat_notification_service = $chat_notification_service;
    }

    public function getNewMessagesCount() {
        return $this->chat_notification_service->getNewMessagesCount();
    }

    public function getNewNotificationsCount() {
        return $this->chat_notification_service->getNewNotificationsCount();
    }

    public function getNewNotifications() {
        return $this->chat_notification_service->getNewNotifications();
    }

    public function getLastNotifications() {
        return $this->chat_notification_service->getLastNotifications();
    }
}
