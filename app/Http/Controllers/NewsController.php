<?php

namespace App\Http\Controllers;

use App\Helpers\Common;
use App\Helpers\PanelEntity;
use App\Models\news;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entity = PanelEntity::getOne(['entity_id' => ID_NEWS], ['entityData', 'entityDataLang', 'entityWords', 'entitySeo']);
        $allNews = PanelEntity::getPaginate(['entity_parent' => ID_NEWS], 6, false, ['ed_datetime_1' => 'DESC'] );

        return view('news.index')->with(compact('allNews', 'entity'));
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
        $news = PanelEntity::getOne(['entity_id' => $id], ['entityData', 'entityDataLang', 'entityOptions', 'entitySeo']);

        if($news == null) {
            abort(404);
        }

        $tags = PanelEntity::getOptionsByName($news->entityOptions, 'eo_tags');
        return view('news.show')->with(compact('news', 'tags'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(news $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, news $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(news $news)
    {
        //
    }
}
