<?php

namespace App\Http\Controllers;

use App\Helpers\PanelEntity;
use App\Models\Promo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PromosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ongoing_promos = PanelEntity::getPaginate(['entity_parent' => ID_PROMOS, 'entityData' => ['ed_datetime_1' => [ '<', Carbon::now()], 'ed_datetime_2' => ['>', Carbon::now()]],
            ], 6, ['entityData', 'entityDataLang', 'entityWords', 'entitySeo'],
        ['entity_order' => 'DESC']);

        $ongoing_promos->setPath(route('promos.ongoing'));

        foreach ($ongoing_promos as &$ongoing_promo) {
            $ongoing_promo->tags = PanelEntity::getOptionsByName($ongoing_promo->entityOptions, 'eo_tags');
        }

        $upcoming_promos = PanelEntity::getPaginate(['entity_parent' => ID_PROMOS, 'entityData' => ['ed_datetime_1' => ['>', Carbon::now()] ]],
            6, ['entityData', 'entityDataLang', 'entityWords', 'entitySeo'], ['entity_order' => 'DESC']);

        $upcoming_promos->setPath(route('promos.upcoming'));

        foreach ($upcoming_promos as &$upcoming_promo) {
            $upcoming_promo->tags = PanelEntity::getOptionsByName($upcoming_promo->entityOptions, 'eo_tags');
        }

        $ended_promos = PanelEntity::getPaginate(['entity_parent' => ID_PROMOS, 'entityData' => ['ed_datetime_2' => ['<', Carbon::now()] ]],
            6, ['entityData', 'entityDataLang', 'entityWords', 'entitySeo'], ['entity_order' => 'DESC']);

        $ongoing_promos->setPath(route('promos.ended'));

        foreach ($ended_promos as &$ended_promo) {
            $ended_promo->tags = PanelEntity::getOptionsByName($ended_promo->entityOptions, 'eo_tags');
        }
        $entity = PanelEntity::getOne(['entity_id' => ID_PROMOS], ['entityData', 'entityDataLang', 'entityWords', 'entitySeo']);
        return view('promos.index')->with(compact( 'entity', 'ongoing_promos', 'upcoming_promos', 'ended_promos'));
    }

    public function ongoing(Request $request)
    {

        $ongoing_promos = PanelEntity::getPaginate(['entity_parent' => ID_PROMOS, 'entityData' => ['ed_datetime_1' => [ '<', Carbon::now()], 'ed_datetime_2' => ['>', Carbon::now()]],
        ], 6, ['entityData', 'entityDataLang', 'entityWords', 'entitySeo'],
            ['entity_order' => 'DESC']);

        foreach ($ongoing_promos as &$ongoing_promo) {
            $ongoing_promo->tags = PanelEntity::getOptionsByName($ongoing_promo->entityOptions, 'eo_tags');
        }

        return view('promos.partials.ongoing')->with(compact( 'ongoing_promos', ));
    }

    public function upcoming()
    {
        $ongoing_promos = PanelEntity::getOne(['entity_id' => ID_PROMOS, 'entityData' => [Carbon::now() > 'ed_datetime_1'],
            'entityData' => [Carbon::now() < 'ed_datetime_2']],
            ['entityData', 'entityDataLang', 'entityWords', 'entitySeo']);

        $tags = PanelEntity::getOptionsByName($ongoing_promos->entityOptions, 'eo_tags');
        return view('promos.partials.ongoing')->with(compact( 'ongoing_promos', 'tags'));
    }

    public function ended()
    {
        $ongoing_promos = PanelEntity::getOne(['entity_id' => ID_PROMOS, 'entityData' => [Carbon::now() > 'ed_datetime_1'],
            'entityData' => [Carbon::now() < 'ed_datetime_2']],
            ['entityData', 'entityDataLang', 'entityWords', 'entitySeo']);

        $tags = PanelEntity::getOptionsByName($ongoing_promos->entityOptions, 'eo_tags');
        return view('promos.partials.ongoing')->with(compact( 'ongoing_promos', 'tags'));
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
        $promo = PanelEntity::getOne(['entity_id' => $id], ['entityData', 'entityDataLang', 'entityOptions', 'entitySeo']);

        if($promo == null) {
            abort(404);
        }

        $tags = PanelEntity::getOptionsByName($promo->entityOptions, 'eo_tags');
        return view('promos.show')->with(compact('promo', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promo $promo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promo $promo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promo $promo)
    {
        //
    }
}
