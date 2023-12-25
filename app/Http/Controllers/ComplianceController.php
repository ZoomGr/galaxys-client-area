<?php

namespace App\Http\Controllers;

use App\Helpers\PanelEntity;
use Illuminate\Http\Request;

class ComplianceController extends Controller
{
    public function index() {
        $compliance = PanelEntity::getOne(['entity_id' => ID_COMPILIANCE_LICENSES], ['entityData', 'entityDataLang', 'entityOptions', 'entitySeo']);

        $compliance_licenses = PanelEntity::getMultiple(['entity_parent' => ID_COMPILIANCE_LICENSES], ['entityData', 'entityDataLang', 'entityOptions', 'entitySeo']);

        $all_games = PanelEntity::getMultiple(['entity_parent' => ID_GAMES], ['entityData', 'entityDataLang']);

        $licenses_games = $this->getGamesWithLicenses($all_games);

        return view('compliance.index')->with(compact('compliance', 'compliance_licenses', 'licenses_games'));
    }

    protected function getGamesWithLicenses($games) {

        foreach ($games as $key=> &$game) {
            $country_licenses = PanelEntity::getMultiple(['entity_parent' => $game->entity_id, 'entity_type' => 'game_country_licenses'], ['entityData', 'entityDataLang']);
            if ($country_licenses->count()) {
                $game->licenses = $country_licenses;
            } else {
                $games->forget($key);
            }
        }

        return $games;
    }
}
