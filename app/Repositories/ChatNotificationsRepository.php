<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface ChatNotificationsRepository
{
    public function getNewNotificationsCount(): array;
    public function getNewNotifications(): Collection;
    public function getLastNotifications(): Collection;
    public function getNotifications($long = false): Collection;
    public function getNewMessagesCount(): array;
    public function getChatsMessages():? array;
    public function addChatNewMessage(Request $request):? array;
    public function getMessagesByChatID(int $id):? array;
    public function setChatSeen(int $id): void;

    public function addChatConversation(Request $request):? array;
}
