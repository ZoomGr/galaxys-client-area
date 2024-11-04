<?php

namespace App\Helpers;

class Helper
{
    CONST ACCESS_EMAILS = ['Paruyr.harutyunyan@digitain.com', 'gegham.vardanyan.g@digitain.com', 'galina.baghdasaryan@imaginelive.com',
        'varditer.hakobyan@digitain.com', 'lchukhajyan@gmail.com','paruyr.harutyunyan.as.partner@digitain.com',
        'digitalmarketing@digitain.com'];
    public static function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    public static function getCountry($country_id, $only_title = true) {
        $countries = PanelEntity::getMultiple(['entity_parent' => ID_COUNTRIES], ['entityData', 'entityDataLang']);
        foreach ($countries as $country) {
            if($country->entity_id == $country_id) {
                if ($only_title) {
                    return $country->entityDataLang->edl_title;
                } else {
                    return $country;
                }
            }
        }

        return null;
    }
}
