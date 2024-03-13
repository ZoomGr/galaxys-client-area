<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Helpers\PanelEntity;
use App\Models\Game;
use App\Repositories\MediaRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    public $media_service;

    public function __construct(MediaRepository $media_service)
    {
        $this->media_service = $media_service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entity = PanelEntity::getOne(['entity_id' => ID_GAMES], ['entityData', 'entityDataLang', 'entitySeo']);
        $games = PanelEntity::getPaginate(['entity_parent' => ID_GAMES], 8, false, ['entity_order' => 'DESC'] );

        return view('games.index')->with(compact('games', 'entity'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $game = PanelEntity::getOne(['entity_id' => $id], ['entityData', 'entityDataLang', 'entityOptions', 'entitySeo']);

        if($game == null) {
            abort(404);
        }

        $devices = PanelEntity::getFiltredOptions($game->entityOptions->toArray(), 'eo_available_devices');
        usort($devices, function($a, $b) {
            if ($a['eo_value'] > $b['eo_value']) {
                return 1;
            } elseif ($a['eo_value'] < $b['eo_value']) {
                return -1;
            }
            return 0;
        });
        $country_licenses = PanelEntity::getMultiple(['entity_parent' => $game->entity_id, 'entity_type' => 'game_country_licenses'], ['entityData', 'entityDataLang'], ['entity_order' => 'DESC']);
        $game_licenses = PanelEntity::getMultiple(['entity_parent' => $game->entity_id, 'entity_type' => 'game_licenses'], ['entityData', 'entityDataLang'], ['entity_order' => 'DESC']);

//        foreach ($country_licenses as &$country_license) {
//            var_dump($country_license->entityData->ed_number_1);
//            $country_license->country = Helper::getCountry($country_license->entityData->ed_number_1);
//        }

        if (!empty($game->entityDataLang->edl_text_2)) {
            $s3_folder_name = $game->entityDataLang->edl_text_2 .'/'. $game->entityDataLang->edl_title;
        } else {
            $s3_folder_name = $game->entityDataLang->edl_title;
        }
//        $s3_folder_name =  strtolower(str_replace(' ', '-', $game->entity_id .'-'. $game->entityDataLang->edl_title));
        $game->devices = $devices;
        $game->all_files = $this->media_service->getDirectoryDataWithSize($s3_folder_name);
        $add_favorite = true;

        return view('games.show')->with(compact('game', 's3_folder_name', 'add_favorite', 'country_licenses', 'game_licenses'));
    }

    public function roadmap() {
        $entity = PanelEntity::getOne(['entity_id' => ID_ROADMAP], ['entityData', 'entityDataLang', 'entitySeo']);
        $near_releases = PanelEntity::getMultiple(['entity_parent' => ID_GAMES, 'entityData' => ['ed_datetime_2' => Carbon::tomorrow(), 'ed_datetime_3' => [PanelEntity::OR_WHERE, Carbon::tomorrow()]]], false, ['entity_update_date' => 'DESC'], false, false);
        $all_releases = PanelEntity::getMultiple(['entity_parent' => ID_GAMES, 'entityData' => ['ed_datetime_2' => ['>', Carbon::today()], 'ed_datetime_3' => [PanelEntity::OR_WHERE, '>', Carbon::today()]]], false, ['entity_update_date' => 'DESC'], false, false);

        return view('games.roadmap')->with(compact('entity', 'near_releases', 'all_releases'));
    }

    public function exportCSV() {
        $fileName = 'roadmap.csv';
        $all_releases = PanelEntity::getMultiple(['entity_parent' => ID_GAMES, 'entityData' => ['ed_datetime_2' => ['>', Carbon::today()], 'ed_datetime_3' => [PanelEntity::OR_WHERE, '>', Carbon::today()]]], false, ['entity_update_date' => 'DESC'], false, false);

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Name', 'Release', 'Media Files',);

        $callback = function() use($all_releases, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($all_releases as $release) {
                $row['Name']  = $release->entityDataLang->edl_title;
                $row['Available'] = Carbon::parse($release->entityData->ed_datetime_2)->format('d.m.Y');
                $row['Media Files']    = Carbon::parse($release->entityData->ed_datetime_2)->format('d.m.Y');;

                fputcsv($file, array($row['Name'], $row['Available'], $row['Media Files']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
}
