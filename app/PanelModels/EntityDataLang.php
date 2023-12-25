<?php


namespace App\PanelModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class EntityDataLang extends Model
{
    use HasFactory;

    protected $fillable = [
        'edl_entity',
        'edl_lang',
        'edl_title',
        'edl_text_1',
    ];

    public $timestamps = false;

    protected $table = 'entity_data_lang';

}
