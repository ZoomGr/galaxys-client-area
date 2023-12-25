<?php


namespace App\Services;




use App\Models\Favorite;
use App\Repositories\UsersRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UsersService implements UsersRepository
{

    public function getFavorites(): ?Collection
    {
        $query = Favorite::query();

        return $query->where('client_id', Auth::user()->user_id)->get()->groupBy('type');
    }

    public function updateNotificationSeen(): bool
    {
        try {
            $user = Auth::user();
            $user->notification_last_seen = Carbon::now();
            $user->saveOrFail();
            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    public function updateFavorites(Request $request): bool
    {
        try {
            $favorite = Favorite::where(['ed_entity' => $request->id, 'client_id' => Auth::user()->user_id])->first();

            if ($favorite == null) {
                $result = Favorite::create([
                    'ed_entity' => $request->id,
                    'type' => 'Game',
                    'client_id' => Auth::user()->user_id
                ]);

            } else {
                $result = $favorite->delete();
            }

            if ($result == null) {
                return false;
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateFavoriteFiles(Request $request): bool
    {
        try {
            $favorite = Favorite::where(['path' => $request->path, 'client_id' => Auth::user()->user_id])->first();
            $type = 'File';

            if(empty(pathinfo($request->path, PATHINFO_EXTENSION))) {
                $type = 'Folder';
            }

            if ($favorite == null) {
                $result = Favorite::create([
                    'path' => $request->path,
                    'type' => $type,
                    'client_id' => Auth::user()->user_id
                ]);

                if($type == 'Folder') {
                    Session::push($request->path, $request->path);
                }

            } else {
                $result = $favorite->delete();
                Session::forget($request->path, $request->path);
            }

            if ($result == null) {
                return false;
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}
