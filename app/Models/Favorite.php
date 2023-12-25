<?php

namespace App\Models;

use App\Helpers\PanelEntity;
use App\PanelModels\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['ed_entity', 'client_id', 'type', 'path'];

    protected $hidden = ['created_at', 'updated_at'];

    public function user() {
        $this->belongsTo('users', 'client_id');
    }

    public function getFavEntity() {
        return PanelEntity::getOne(['entity_id' => $this->ed_entity]);
    }

    public function entities() {
        $this->hasMany(Entity::class, 'ed_entity', 'entity_id');
    }

    public function scopeFavFile($query, $path) {
        $result =  $query->where(['client_id' => Auth::user()->user_id, 'path' => $path] )->get();

        if ($result->count()) {
            return true;
        }

        return false;
    }
}
