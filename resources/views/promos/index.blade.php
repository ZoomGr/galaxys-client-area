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
    $asideDisabled = false;

    $gridBodyClasses = "column sm-12 md-9";

    if (empty($entity->entityData->ed_number_1) || $entity->entityData->ed_number_1 != 1) {
        $gridBodyClasses =  "column sm-12";
    }
?>

@section('content')
    <div class="content tabs">
        <div class="row">
            <div class="column sm-12">
                <div class="content__heading">
                    <h1 class="content__title h1-font">
                        Promo
                    </h1>
                </div>
                <div class="action-bar tabs__control shadow-xs radius-xxs">
                    <div class="action-bar__tabs">
                        <div class="btn btn_sm tab active" data-tab="ongoing-promos">
                            <span>Ongoing</span>
                        </div>
                        <div class="btn btn_sm tab" data-tab="upcoming-promos">
                            <span>Upcoming</span>
                        </div>
                        <div class="btn btn_sm tab" data-tab="ended-promos">
                            <span>Ended</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="{{$gridBodyClasses}}">
                <div class="content__body tabs__content">
                    <div id="ongoing-promos" class="tab-content active">
                        @include('promos/partials/ongoing')
                    </div>
                    <div id="upcoming-promos" class="tab-content">
                        @include('promos/partials/upcoming')
                    </div>
                    <div id="ended-promos" class="tab-content">
                        @include('promos/partials/ended')
                    </div>
                </div>
            </div>
            @if(!empty($entity->entityData->ed_number_1) && $entity->entityData->ed_number_1 == 1)
                @include('components/promo', ['content' => $entity])
            @endif
        </div>
    </div>
@endsection
