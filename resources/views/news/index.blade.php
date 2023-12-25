@extends('layouts.app')

@section('title') {{ $entity->entitySeo->es_title ?? $entity->entityDataLang->edl_title }} @endsection

@section('keywords') {{ $entity->entitySeo->es_keywords ?? ''}} @endsection

@section('description') {{ $entity->entitySeo->es_description ?? ''}} @endsection

@section('styles')
    <!-- Page Css -->
    <link rel="stylesheet" href="{{asset('assets/css/pages/article-listing.css')}}">
    <!-- ========================== -->
@endsection

<?php
    $gridBodyClasses = "column sm-12 md-9";
    $gridElementClasses = "column sm-12 md-6";

    if (empty($entity->entityData->ed_number_1) || $entity->entityData->ed_number_1 != 1) {
        $gridBodyClasses =  "column sm-12";
        $gridElementClasses =  "column sm-12 md-4";
    }
?>

@section('content')
    <div class="content">
        <div class="row">
            <div class="column sm-12">
                <div class="content__heading">
                    <h1 class="content__title h1-font">
                        {{$entity->entityDataLang->edl_title}}
                    </h1>
                </div>
            </div>
            <div class="{{$gridBodyClasses}}">
                <div class="content__body">
                    <div class="article-listing">
                        <div class="row">
                            @foreach($allNews as $news)
                                <div class="{{$gridElementClasses}}">
                                    <a href="{{route('news.show', ['news' => $news->entity_id])}}" class="article-card shadow-xs radius-xs">
                                        <div class="article-card__img radius-xxs">
                                            <img src="{{ \App\Helpers\PanelEntity::getEntityImage($news->entityData->ed_image, 498, 284, 6) }}" alt="{{$news->entityDataLang->edl_title}}">
                                        </div>
                                        <div class="article-card__body">
                                            <div class="article-card__date color-black-50">
                                                <div class="date">
                                                    <i class="icon icon-clock"></i>
                                                    <span>{{\Carbon\Carbon::parse($news->entityData->ed_datetime_1)->format('d.m.Y')}}</span>
                                                </div>
                                            </div>
                                            <div class="article-card__title text-20 font-semibold">
                                                {{$news->entityDataLang->edl_title}}
                                            </div>
                                            <div class="article-card__desc">
                                                {{$news->entityDataLang->edl_char_1}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="article-listing-paging text-center">
                        {{ $allNews->links('vendor.pagination.default') }}
                    </div>
                </div>
            </div>
            @if(!empty($entity->entityData->ed_number_1) && $entity->entityData->ed_number_1 == 1)
                @include('components/promo', ['content' => $entity])
            @endif
        </div>
    </div>
@endsection
