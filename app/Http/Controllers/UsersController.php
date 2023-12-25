<?php

namespace App\Http\Controllers;

use App\Helpers\ErrorMessages;
use App\Helpers\NotificationHelper;
use App\Repositories\ChatNotificationsRepository;
use App\Repositories\MediaRepository;
use App\Repositories\QuizRepository;
use App\Repositories\UsersRepository;
use App\Services\ChatNotificationsService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    private $users_service;
    private $chat_notification_service;

    private $media_service;

    public function __construct(UsersRepository $users_service, ChatNotificationsRepository $chat_notification_service, MediaRepository $media_service)
    {
        $this->users_service = $users_service;
        $this->media_service = $media_service;
        $this->chat_notification_service = $chat_notification_service;
    }

    public function settings() {
        return view('users.settings');
    }

    public function favorites() {
        $favorites = $this->users_service->getFavorites();
        $favorites->all_files = [];

        if (isset($favorites['File'])) {
            foreach ($favorites['File'] as $file) {
                $result = $this->media_service->getFileData($file->path);
                if ($result) {
                    $favorites->all_files['files'][] = $result;
                }
            }
        }

        if (isset($favorites['Folder'])) {
            foreach ($favorites['Folder'] as $folder) {
                $result = $this->media_service->getFolderData($folder->path);
                if ($result) {
                    $favorites->all_files['directories'][] = $result;
                }
            }
        }

        return view('users.favorites')->with(compact('favorites'));
    }

    public function notifications() {
        $notifications = $this->chat_notification_service->getNotifications();
        //$userChats = $this->chat_notification_service->getChatsMessages();
        //$chatsNotifications = array_merge($userChats, $longNotifications->toArray());

//        usort($chatsNotifications, function($a, $b) {
//            if (strtotime($a['entity_update_date'] ?? $a['entity_creation_date']) > strtotime($b['entity_update_date'] ?? $b['entity_creation_date'])) {
//                return -1;
//            } elseif (strtotime($a['entity_update_date'] ?? $a['entity_creation_date']) < strtotime($b['entity_update_date'] ?? $b['entity_creation_date'])) {
//                return 1;
//            }
//            return 0;
//        });


        return view('users.notifications')->with(compact('notifications'));
    }

    public function supports() {
        $userChats = $this->chat_notification_service->getChatsMessages();
        return view('users.support')->with(compact('userChats'));
    }

    public function usersNewConversation() {
        return view('users.partials.new-conversation');
    }

    public function updateFavorites(Request $request) {
        return response()->json(['status' => $this->users_service->updateFavorites($request)]);

    }

    public function updateFavoriteFiles(Request $request) {
        return response()->json(['status' => $this->users_service->updateFavoriteFiles($request)]);

    }

    public function changePassword(Request $request) {

        try {
            if (!(Hash::check($request->current_password, $request->user()->password))) {
                return redirect()->back()->withErrors([
                    "pass_error" => true,
                    "current_password" => ["Your current password does not match with the password you provided. Please try again."]
                ]);
            }

            if(strcmp($request->current_password, $request->new_password) == 0){
                return redirect()->back()->withErrors([
                    "pass_error" => true,
                    "new_password" => ["New password matches the old password. Please choose a different one."]
                ]);
            }

            if($request->new_password !== $request->repeat_password){
                return redirect()->back()->withErrors([
                    "pass_error" => true,
                    "new_password" => ["New password not matches the repeat password."]
                ]);
            }

            $user = Auth::user();
            $user->password = Hash::make($request->new_password);
            $user->saveOrFail();

            return redirect()->back()->with('success', 'User settings updated!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function updateSettings(Request $request) {
        try {
            $user = Auth::user();
            $user->name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->saveOrFail();
            return redirect()->back()->with('success', 'User settings updated!');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }

    }

    public function updateNotificationSeen() {
        return response()->json(['status' => $this->users_service->updateNotificationSeen()]);
    }

    public function usersAddConversation(Request $request) {
        $result = $this->chat_notification_service->addChatConversation($request);

        if ($result) {
            return response()->json($result);
        }

        return response()->json(['data' => false], 403);
    }

    public function addChatNewMessage(Request $request) {
        $result = $this->chat_notification_service->addChatNewMessage($request);

        if ($result) {
            return response()->json($result);
        }

        return response()->json(['data' => false], 404);
    }

    public function getChatMessages(int $id) {
        try {
            $data = ['user_id' => Auth::user()->user_id];
            $data['message'] = $this->chat_notification_service->getMessagesByChatID($id);
            $this->chat_notification_service->setChatSeen($id);
            return response()->json($data);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function getChatNewMessages() {
        try {
            $result = $this->chat_notification_service->getNewMessagesCount();

            if ($result) {
                return response()->json($result, 200);
            }
        } catch (\Exception $ex) {
            return response()->json(['data' => false], 403);
        }
    }

}
