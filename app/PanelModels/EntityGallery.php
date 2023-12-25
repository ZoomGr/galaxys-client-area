<?php


namespace App\PanelModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class EntityGallery extends Model
{
    use HasFactory;

    protected $table =  'entity_gallery';

    public function entityGalleryLang(): HasMany {
        return $this->HasMany(EntityGalleryLang::class, 'egl_gallery');
    }
}
