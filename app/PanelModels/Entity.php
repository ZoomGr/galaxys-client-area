<?php


namespace App\PanelModels;

use App\Models\Favorite;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;


class Entity extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_parent',
        'entity_type',
        'entity_sub_type',
        'entity_creator',
        'entity_visible',
        'entity_creation_date',
    ];

    public $timestamps = false;

    protected $primaryKey = 'entity_id';

    public function entityData() : HasOne {
        return $this->hasOne(EntityData::class, 'ed_entity', 'entity_id');
    }

    public function entityDataLang() : HasOne {
        return $this->HasOne(EntityDataLang::class, 'edl_entity', 'entity_id');
//            ->where('edl_lang = ', LANG);
    }

    public function entityGallery(): HasMany {
        return $this->HasMany(EntityGallery::class, 'eg_entity', 'entity_id');
    }

    public function entityOptions(): HasMany {
        return $this->HasMany(EntityOption::class, 'eo_entity', 'entity_id');
    }

    public function entityWords(): HasMany {
        return $this->HasMany(EntityWords::class, 'ew_entity', 'entity_id');
    }

    public function entitySEO(): HasOne {
        return $this->hasOne(EntitySeo::class, 'es_entity', 'entity_id');
    }

    public function favorite() {
        return $this->hasOne(Favorite::class, 'ed_entity', 'entity_id')->where('client_id', Auth::user()->user_id);
    }

}
