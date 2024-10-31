<?php

namespace App\Http\Controllers;

use App\Helpers\PanelEntity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $slider = PanelEntity::getMultiple(['entity_parent' => ID_SLIDER], false, ['entity_order' => 'DESC']);
        $latest_news = PanelEntity::getMultiple(['entity_parent' => ID_NEWS, 'entityData' => ['ed_number_1' => null]], false, ['ed_datetime_1' => 'DESC'], false, 4)->toArray();
        $games = PanelEntity::getMultiple(['entity_parent' => ID_GAMES], false, ['entity_order' => 'DESC'], false, 4);
        $promos = PanelEntity::getMultiple(['entity_parent' => ID_PROMOS], false, ['entity_update_date' => 'DESC'], false, 3);
        $releases = PanelEntity::getMultiple(['entity_parent' => ID_GAMES, 'entityData' => ['ed_datetime_2' => Carbon::tomorrow(), 'ed_datetime_3' => [PanelEntity::OR_WHERE, Carbon::tomorrow()]]], false, ['entity_update_date' => 'DESC'], false, 4);

        foreach ($promos as &$promo) {
            $promo->tags = PanelEntity::getOptionsByName($promo->entityOptions, 'eo_tags');
        }

        return view('home')->with(compact('latest_news', 'games', 'promos', 'releases', 'slider'));
    }
}
