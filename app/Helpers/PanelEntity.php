<?php


namespace App\Helpers;


use App\PanelModels\EntityOption;
use DataSource\Entity\Entity;
use phpDocumentor\Reflection\Types\Boolean;

class PanelEntity
{

    const OR_WHERE = 'multiple';

    public static function getMultiple($filters = array(), $with = false, $sortings = array(), $page = false, $limit = false)
    {
        $records = \App\PanelModels\Entity::query();
        $records->where('entity_visible', 1);

        foreach($filters as $field=>$value)
        {
            if (is_array($value)) {
                if ($field == PanelEntity::OR_WHERE) {
                    foreach ($value as $relation => $data) {
                        if (is_array($data)) {
                            $records->orWhereHas($relation, function($q) use ($data){
                                foreach ($data as $key => $data) {
                                    if (is_array($data)) {
                                        $q->where($key, $data[0], $data[1]);
                                    } else {
                                        $q->where($key, $data);
                                    }
                                }
                            });
                        } else {
                            $records->orWhere($relation, $data);
                        }
                    }
                } elseif (self::isArrayAssoc($value)) {
                    $records->whereHas($field, function ($q) use ($value) {
                        foreach ($value as $key => $data) {
                            if (is_array($data)) {
                                if ($data[0] == PanelEntity::OR_WHERE) {
                                    if (isset($data[2])) {
                                        $q->orWhere($key, $data[1], $data[2]);
                                    } else {
                                        $q->orWhere($key, $data[1]);
                                    }
                                } else {
                                    $q->where($key, $data[0], $data[1]);
                                }
                            } else {
                                $q->where($key, $data);
                            }
                        }

                    });
                } else {
                    $records->whereIn($field, $value);
                }

            } else {
                $records->where($field, $value);
            }

        }

        foreach($sortings as $column => $sort)
        {
            $records->orderBy($column, $sort);
        }

        if($page!==false && $limit!==false)
        {
            $page = abs( (int)$page );
            $limit = abs( (int)$limit );

            if($page < 1)
            {
                $page = 1;
            }

            if($limit < 1)
            {
                $limit = 1;
            }

            $offset = ($page - 1) * $limit;

            $records->offset($offset)->limit($limit);
        } elseif ($limit!==false) {
            $records->limit($limit);
        }

        if ($with) {
            $records->with($with);
        } else {
            $records->with('entityData', 'entityDataLang');
        }

        return self::getEntity($records, true);
    }

    public static  function countMultiple($filters = array(), $with = false)
    {
        $records = \App\PanelModels\Entity::query();
        $records->where('entity_visible = ', 1);

        foreach($filters as $field=>$value)
        {
            if (is_array($value)) {
                if ($field == PanelEntity::OR_WHERE) {
                    foreach ($value as $relation => $data) {
                        if (is_array($data)) {
                            $records->orWhereHas($relation, function($q) use ($data){
                                foreach ($data as $key => $data) {
                                    if (is_array($data)) {
                                        if ($data[0] == PanelEntity::OR_WHERE) {
                                            if (isset($data[2])) {
                                                $q->orWhere($key, $data[1], $data[2]);
                                            } else {
                                                $q->orWhere($key, $data[1]);
                                            }
                                        } else {
                                            $q->where($key, $data[0], $data[1]);
                                        }
                                    } else {
                                        $q->where($key, $data);
                                    }
                                }
                            });
                        } else {
                            $records->orWhere($relation, $data);
                        }
                    }
                } elseif (self::isArrayAssoc($value)) {
                    $records->whereHas($field, function ($q) use ($value) {
                        foreach ($value as $key => $data) {
                            if (is_array($data)) {
                                if ($data[0] == PanelEntity::OR_WHERE) {
                                    if (isset($data[2])) {
                                        $q->orWhere($key, $data[1], $data[2]);
                                    } else {
                                        $q->orWhere($key, $data[1]);
                                    }
                                } else {
                                    $q->where($key, $data[0], $data[1]);
                                }
                            } else {
                                $q->where($key, $data);
                            }
                        }

                    });
                } else {
                    $records->whereIn($field, $value);
                }

            } else {
                $records->where($field, $value);
            }

        }

        if ($with) {
            $records->with(implode(',', $with));
        } else {
            $records->with('entityData', 'entityDataLang', 'entityGallery', 'entityGallery.entityGalleryLang');
        }

        $records->get()->count();
    }

    public static function getOne($filters = array(), $with = false)
    {
        $records = \App\PanelModels\Entity::query();
        $records->where('entity_visible', 1);

        foreach($filters as $field=>$value)
        {
            if (is_array($value)) {
                if ($field == PanelEntity::OR_WHERE) {
                    foreach ($value as $relation => $data) {
                        if (is_array($data)) {
                            $records->orWhereHas($relation, function($q) use ($data){
                                foreach ($data as $key => $data) {
                                    if (is_array($data)) {
                                        if ($data[0] == PanelEntity::OR_WHERE) {
                                            if (isset($data[2])) {
                                                $q->orWhere($key, $data[1], $data[2]);
                                            } else {
                                                $q->orWhere($key, $data[1]);
                                            }
                                        } else {
                                            $q->where($key, $data[0], $data[1]);
                                        }
                                    } else {
                                        $q->where($key, $data);
                                    }
                                }
                            });
                        } else {
                            $records->orWhere($relation, $data);
                        }
                    }
                } elseif (self::isArrayAssoc($value)) {
                    $records->whereHas($field, function ($q) use ($value) {
                        foreach ($value as $key => $data) {
                            if (is_array($data)) {
                                if ($data[0] == PanelEntity::OR_WHERE) {
                                    if (isset($data[2])) {
                                        $q->orWhere($key, $data[1], $data[2]);
                                    } else {
                                        $q->orWhere($key, $data[1]);
                                    }
                                } else {
                                    $q->where($key, $data[0], $data[1]);
                                }
                            } else {
                                $q->where($key, $data);
                            }
                        }

                    });
                } else {
                    $records->whereIn($field, $value);
                }

            } else {
                $records->where($field, $value);
            }

        }
        if ($with) {
            $records->with($with);
        } else {
            $records->with('entityData', 'entityDataLang', 'entityGallery', 'entityGallery.entityGalleryLang');
        }

        return self::getEntity($records, false);
    }

    protected static function isArrayAssoc(array $array) {
        if (array() === $array) return false;
        return array_keys($array) !== range(0, count($array) - 1);
    }

    public static function getPaginate($filters = array(), $limit, $with = false, $sortings = array())
    {
        $records = \App\PanelModels\Entity::query();
        $records->where('entity_visible', 1);

        foreach($filters as $field=>$value)
        {
            if (is_array($value)) {
                if ($field == PanelEntity::OR_WHERE) {
                    foreach ($value as $relation => $data) {
                        if (is_array($data)) {
                            $records->orWhereHas($relation, function($q) use ($data){
                                foreach ($data as $key => $data) {
                                    if (is_array($data)) {
                                        $q->where($key, $data[0], $data[1]);
                                    } else {
                                        $q->where($key, $data);
                                    }
                                }
                            });
                        } else {
                            $records->orWhere($relation, $data);
                        }
                    }
                } elseif (self::isArrayAssoc($value)) {
                    $records->whereHas($field, function($q) use ($value){
                        foreach ($value as $key => $data) {
                            if (is_array($data)) {
                                $q->where($key, $data[0], $data[1]);
                            } else {
                                $q->where($key, $data);
                            }
                        }

                    });
                } else {
                    $records->whereIn($field, $value);
                }

            } else {
                $records->where($field, $value);
            }

        }

        foreach($sortings as $column => $sort)
        {
            $records->orderBy($column, $sort);
        }

        if ($with) {
            $records->with($with);
        } else {
            $records->with('entityData', 'entityDataLang');
        }

        return $records->paginate($limit);
    }

    public static function getOptions($conditions = []) {
        $records =  EntityOption::query();

        foreach($conditions as $field=>$value)
        {
            $records->where($field, $value);
        }
        return self::getEntity($records);
    }

    protected static function getEntity($qollection, $is_multiple = true) {
        if ($is_multiple) {
            return $qollection->get();
        }

        return $qollection->first();
    }

    public static function getEntityImage($image_url, $width, $height) {
        return (self::image($image_url)) ? self::thumbnail($image_url, $width, $height, 6) : null;
    }

    public static function getImage($image_url, $width, $height) {
        return (self::image($image_url)) ? self::thumbnail($image_url, $width, $height, 6) : null;
    }

    public static function getDefaultImage() {
        return '';
    }

    public static function image($path)
    {
        $relativePath = str_replace("../", "", $path);

        $fullPath = getcwd()."/".$relativePath;
        if( is_file($fullPath) )
        {
            return $relativePath;
        }
        else
        {
            return false;
        }
    }

    public static function thumbnail($path, $width, $height, $method, $extension = "original")
    {
        $targetPath  = $path;

        if (str_contains($path, '../media')) {
            $targetPath = str_replace("../media", "thumbs/".$width."x".$height, $path);
        } elseif (str_contains($path, 'media')) {
            $targetPath = str_replace("media", "thumbs/".$width."x".$height, $path);
        }

        if($extension!=="original")
        {
            $targetPath = str_replace( ".".pathinfo($path, PATHINFO_EXTENSION), ".".$extension, $targetPath );
        }

        if( is_file($targetPath) )
        {
            return asset($targetPath);
        }
        else
        {
            $sourcePath = self::image($path);
            if($sourcePath)
            {
                $targetDir = getcwd()."/". pathinfo($targetPath, PATHINFO_DIRNAME);

                if( !is_dir($targetDir) )
                {
                    mkdir($targetDir, 0777, true);
                }

                if( is_dir($targetDir) )
                {
                    $imageInfo = getimagesize($sourcePath);

                    if( is_array($imageInfo) && isset($imageInfo[0]) && isset($imageInfo[1]) )
                    {
                        $thumbnailer =  new \Zebra_Image();

                        $thumbnailer->auto_handle_exif_orientation = true;

                        $thumbnailer->source_path = $sourcePath;

                        $thumbnailer->target_path = $targetPath;

                        if( $imageInfo[0] > $width || $imageInfo[1] > $height )
                        {
                            if($thumbnailer->resize($width, $height, $method, -1) === true)
                            {
                                return asset($sourcePath);
                            }
                            else
                            {
                                return asset($sourcePath);
                            }
                        }
                        else
                        {
                            if($extension!=="original")
                            {
                                if($thumbnailer->resize($imageInfo[0], $imageInfo[1], $method, -1) === true)
                                {
                                    return asset($sourcePath);
                                }
                                else
                                {
                                    return asset($sourcePath);
                                }
                            }
                            else
                            {
                                return asset($sourcePath);
                            }
                        }
                    }
                    else
                    {
                        return asset($sourcePath);
                    }
                }
                else
                {
                    return asset($sourcePath);
                }
            }
            else
            {
                return false;
            }
        }
    }

    public static function findWord($entity, $index)
    {
        if( isset($entity->entityWords) )
        {
            foreach($entity->entityWords as $word)
            {
                if( (int)$word->ew_index === $index )
                {
                    return $word->ew_value;
                }
            }
        }

        return false;
    }

    public static function prettyDate($str, $format = 'short', $as_string=true)
    {

        if (empty($str)) {
            return false;
        }

        $date = date('Y-m-d', strtotime($str));
        $chunks = explode("-", substr($date, 0, 10));

        if($format === 'long') {
            $month = self::getMonthString($chunks[1]);
        } else {
            $month = self::getShortMonthString($chunks[1]);
        }
        if($as_string) {
            return $chunks[2]." ".$month.", ".$chunks[0];
        } else {
            return array(
                'day'   =>  $chunks[2],
                'month' =>  $month,
                'year'  =>  $chunks[0]
            );
        }
    }

    protected static function getMonthString($number)
    {
        $voc = [
            "hy" => ["Հունվարի", "Փետրվարի", "Մարտի", "Ապրիլի", "Մայիսի", "Հունիսի", "Հուլիսի", "Օգոստոսի", "Սեպտեմբերի", "Հոկտեմբերի", "Նոյեմբերի", "Դեկտեմբերի"],
            "en" => ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            "ru" => ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
            "fr" => ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
            "es" => ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        ];

        if(defined("LANG_URL") && isset($voc[LANG_URL])) {
            return $voc[LANG_URL][$number - 1];
        } else {
            return '';
        }
    }

    protected static function getShortMonthString($number)
    {
        $voc = [
            "hy" => ["Հնվ", "Փտվ", "Մար", "Ապր", "Մայ", "Հուն", "Հուլ", "Օգս", "Սեպ", "Հոկ", "Նոյ", "Դեկ"],
            "en" => ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            "ru" => ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сен", "Окт", "Ноя", "Дек"],
            "fr" => ["Jan", "Fév", "Mar", "Avr", "Mai", "Jun", "Jul", "Août", "Sep", "Oct", "Nov", "Déc"],
            "es" => ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ags", "Sep", "Oct", "Nov", "Dic"],
        ];

        if(defined("LANG_URL") && isset($voc[LANG_URL])) {
            return $voc[LANG_URL][$number - 1];
        } else {
            return $voc['en'][$number - 1];
        }
    }

    public  static  function getOptionsByName($options, $list_name) {
        $options_list = [];

        foreach ($options as $option) {
            if ($list_name == $option['eo_key']) {
                $options_list[] = self::getOne(['entity_id' => $option['eo_value']]);
            }
        }

        return $options_list;
    }

    public  static  function getFiltredOptions($options, $option_name) {
        $options_list = [];

        foreach ($options as $option) {
            if ($option_name == $option['eo_key']) {
                $options_list[] = $option;
            }
        }

        return $options_list;
    }

    public static function sortedGallery($entity)
    {
        $images = array();

        $files = array();

        if( isset($entity["entityGallery"]) )
        {
            foreach($entity["entityGallery"] as $galleryItem)
            {
                if( self::isValidImage($galleryItem["eg_path"]) )
                {
                    $images[] = $galleryItem;
                }
                else
                {
                    $files[] = $galleryItem;
                }
            }
        }

        usort($images, function($a, $b){
            if ($a["eg_order"] == $b["eg_order"])
            {
                return 0;
            }

            return ($a["eg_order"] < $b["eg_order"]) ? 1 : -1;
        });

        usort($files, function($a, $b){
            if ($a["eg_order"] == $b["eg_order"])
            {
                return 0;
            }

            return ($a["eg_order"] < $b["eg_order"]) ? 1 : -1;
        });

        return array(
            "images"=>$images,
            "files"=>$files,
        );
    }

    protected static function isValidImage($img)
    {
        $validExtensions = array("jpg", "jpeg", "png", "gif");

        $extension = pathinfo($img, PATHINFO_EXTENSION);

        foreach($validExtensions as $validExtension)
        {
            if($extension===$validExtension || $extension===strtoupper($validExtension))
            {
                return TRUE;
            }
        }

        return FALSE;
    }
}
