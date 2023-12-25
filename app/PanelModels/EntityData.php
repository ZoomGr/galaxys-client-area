<?php


namespace App\PanelModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class EntityData extends Model
{
    use HasFactory;

    protected $fillable = [
        'ed_entity',
        'ed_title',
        'ed_text_1',
        'ed_number_1',
    ];

    protected $primaryKey = 'ed_entity';

    public $timestamps = false;

    protected $table = 'entity_data';
}
