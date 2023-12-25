<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Game extends Model
{
    use HasFactory;

    public function favorite() {
        return $this->hasOne(Favorite::class, 'ed_entity')->where('client_id', Auth::user()->user_id);
    }
}
