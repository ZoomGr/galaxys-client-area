<?php

namespace App\Services;

use App\Helpers\PanelEntity;
use App\PanelModels\Entity;
use App\PanelModels\EntityData;
use App\PanelModels\EntityDataLang;
use App\Repositories\ChatNotificationsRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatNotificationsService implements ChatNotificationsRepository
{
    public function getNewMessagesCount(): array
    {
        $chats = Entity::where([
            'entity_type' => 'chat',
            'entity_parent' => Auth::user()->user_profile_entity
        ])->pluck('entity_id')->toArray();

        $messages = Entity::whereIn('entity_parent', $chats)->whereHas('entityData', function ($q)  {
            $q->where('ed_number_1', 0);
            $q->orWhereNull('ed_number_1');
        })->get();

        return ['messages' => $messages->count()];
    }

    public function getChatsMessages():? array
    {
        $chats = Entity::with('entityData')->where([
            'entity_type' => 'chat',
            'entity_parent' => Auth::user()->user_profile_entity
        ])->get()->toArray();

        foreach ($chats as &$chat) {
            $chat['unseen_messages'] = Entity::where('entity_parent', $chat['entity_id'])->whereHas('entityData', function ($q)  {
                $q->where('ed_number_1', 0);
            })->get()->count();
        }

        return $chats;
    }

    public function getMessagesByChatID(int $id): ?array
    {
        return Entity::with('entityData')->where([
            'entity_type' => 'chat_message',
            'entity_parent' => $id
        ])->orderBy('entity_order', 'DESC')->get()->toArray();

    }

    public function setChatSeen(int $id): void
    {
        $chat_unseen_messages = Entity::where('entity_parent', $id)->whereHas('entityData', function ($q)  {
            $q->where('ed_number_1', 0);
            $q->orWhereNull('ed_number_1');
        })->get();


        foreach ($chat_unseen_messages as $chat_unseen_message) {
           EntityData::where('ed_entity', $chat_unseen_message->entity_id)->update(['ed_number_1' => 1]);
        }
    }

    public function addChatNewMessage(Request $request): ?array
    {
        try {
            $respData = [];
            $user = Auth::user();
            $respData['user'] = $user;

            $chat =  Entity::with('entityData', 'entityDataLang')->where([
                'entity_type' => 'chat',
                'entity_parent' => Auth::user()->user_profile_entity,
                'entity_id' => $request->chat_id
            ])->firstOrFail();

            $chat->entity_update_date = Carbon::now();
            $chat->saveOrFail();

            $chat->entityData->forceFill(['ed_text_1' => $request->message])->save();

            $this->createChatMessage($request, $request->chat_id, $user);
            $respData['chat'] = $chat->toArray();

            return $respData;
        } catch (\Exception $ex) {
//            DB::rollBack();
            return null;
        }
    }

    public function addChatConversation(Request $request):? array
    {
//        DB::beginTransaction();
        try {
            $respData = [];
            $user = Auth::user();
            $respData['user']['full_name'] = $user-> first_name .' ' . $user->last_name;

            if ($user->user_profile_entity == null) {
                $userChats = Entity::create([
                    'entity_parent' => ID_CHATS,
                    'entity_type' => 'chat_user',
                    'entity_sub_type' => 'chat',
                    'entity_creator' => $user->user_id,
                    'entity_visible' => 1,
                    'entity_creation_date' => Carbon::now()
                ]);

                EntityData::create([
                    'ed_entity' => $userChats->entity_id,
                    'ed_title' => $user->name . ' '. $user->last_name
                ]);
                $user->user_profile_entity = $userChats->entity_id;
                $user->saveOrFail();
                $userChatsID = $userChats->entity_id;
            } else {
                $userChats = PanelEntity::getOne(['entity_parent' => ID_CHATS, 'entity_id' => $user->user_profile_entity]);
                $userChatsID = $userChats->entity_id;
            }

            $respData['chat'] = $this->createNewChat($request, $userChatsID, $user);

//            DB::commit();
            return $respData;
        } catch (\Exception $ex) {
//            DB::rollBack();
            return null;
        }
    }

    protected function createNewChat($request, $parent_id, $user): array {
        $userChat = Entity::create([
            'entity_parent' => $parent_id,
            'entity_type' => 'chat',
            'entity_sub_type' => 'chat_message',
            'entity_creator' => $user->user_id,
            'entity_visible' => 1,
            'entity_creation_date' => Carbon::now()
        ]);

        EntityData::create([
            'ed_entity' => $userChat->entity_id,
            'ed_title' => $request->subject,
            'ed_text_1' => $request->message
        ]);

        $this->createChatMessage($request, $userChat->entity_id, $user);

        return $userChat->toArray();
    }

    protected function createChatMessage($request, $parent_id, $user): void {
        $userMessage = Entity::create([
            'entity_parent' => $parent_id,
            'entity_type' => 'chat_message',
            'entity_creator' => $user->user_id,
            'entity_visible' => 1,
            'entity_creation_date' => Carbon::now()
        ]);

        EntityData::create([
            'ed_entity' => $userMessage->entity_id,
            'ed_number_1' => 1,
            'ed_text_1' => $request->message
        ]);
    }

    public function getNewNotificationsCount(): array
    {

        $newNotifications = $this->getNewNotifications();
        return ['notification' => $newNotifications->count()];
    }

    public function getNewNotifications(): Collection
    {
        $user = Auth::user();
        $query = Entity::query();
        $query->with('entityData', 'entityDataLang')->where(['entity_visible' => 1, 'entity_parent' => ID_NOTIFICATIONS]);

        if ($user->notification_last_seen != null) {
            $query->where(function ($query) use ($user) {
                $query->where('entity_creation_date', '>', $user->notification_last_seen);
                $query->orWhere('entity_update_date', '>', $user->notification_last_seen);
            });
        }
        $query->orderBy('entity_update_date', 'DESC');

        return $query->get();
    }

    public function getLastNotifications(): Collection
    {
        $query = Entity::query();
        $query->with('entityData', 'entityDataLang')->where(['entity_visible' => 1, 'entity_parent' => ID_NOTIFICATIONS]);
        $query->limit(5);
        $query->orderBy('entity_creation_date', 'DESC');
        $query->orderBy('entity_update_date', 'DESC');

        return $query->get();
    }

    public function getNotifications($long = false): Collection
    {
        $query = Entity::query();
        $query->with('entityData', 'entityDataLang')->where(
            [
                'entity_visible' => 1,
                'entity_parent' => ID_NOTIFICATIONS,
            ]);

        if ($long) {
            $query->whereHas('entityData', function ($q)  {
                $q->where('ed_number_1', 2);
            });
        }

        $query->orderBy('entity_creation_date', 'DESC');
        $query->orderBy('entity_update_date', 'DESC');

        return $query->get();
    }
}
