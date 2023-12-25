@extends('layouts.app')

@section('title') {{ $promo->entitySeo->es_title ?? $promo->entityDataLang->edl_title }} @endsection

@section('keywords') {{ $promo->entitySeo->es_keywords ?? ''}} @endsection

@section('description') {{ $promo->entitySeo->es_description ?? ''}} @endsection

@section('styles')
    <!-- Page Css -->
    <link rel="stylesheet" href="{{asset('assets/css/pages/inner.css')}}">
    <!-- ========================== -->
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="column sm-12">
                <div class="content__body">
                    <div class="content__heading">
                        <div class="inner-heading">
                            <div class="inner-heading__icon">
                                <i class="icon icon-arrow-left"></i>
                            </div>
                            <div class="inner-heading__text">
                                <a href="{{route('promos.index')}}" class="inner-heading__title title">
                                    {{$promo->entityDataLang->edl_title}}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tabs compliance">
                        <div class="action-bar tabs__control shadow-xs radius-xxs">
                            <div class="action-bar__tabs">
                                <div class="btn btn_sm tab active" data-tab="promo-main-info">
                                    <span>Main info</span>
                                </div>
                                <div class="btn btn_sm tab" data-tab="promo-timeline">
                                    <span>Timeline</span>
                                </div>
                            </div>
                        </div>
                        <div class="compliance__content">
                            <div class="shadow-xs radius-md">
                                <div class="inner-block shadow-xs radius-md">
                                    <div class="inner-block__body">
                                        <div class="tabs__content">
                                            <div id="promo-main-info" class="tab-content active">
                                                <div class="inner-block__img radius-xs">
                                                    <img src="{{ \App\Helpers\PanelEntity::getEntityImage($promo->entityData->ed_image, 751, 383, 6) }}" alt="{{$promo->entityDataLang->edl_title}}">
                                                </div>
                                                <div class="inner-block__info">
                                                    <div class="date date_md">
                                                        <i class="icon icon-clock"></i>
                                                        <span>{{\Carbon\Carbon::parse($promo->entityData->ed_datetime_1)->format('jS M Y')}} - {{\Carbon\Carbon::parse($promo->entityData->ed_datetime_2)->format('d M Y')}}</span>
                                                    </div>
                                                    <div class="tags">
                                                        <div class="tags__wrap">
                                                            @foreach($tags as $tag)
                                                                <div class="tag">{{$tag->entityDataLang->edl_title}}</div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="inner-block__details">
                                                    <div class="inner-block__details-item">
                                                        {!! $promo->entityDataLang->edl_text_1 !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="promo-timeline" class="tab-content">
                                                <div class="timeline">
                                                    <div class="timeline__wrap accordion">
                                                        <div class="accordion__item timeline__item">
                                                            <div class="accordion__header timeline__trigger">
                                                                <div class="timeline__heading">
                                                                    <div class="accordion__title timeline__title">
                                                                        Weeks 1-4 (from January 2 18:00 CET to January 30 18:00 CET)
                                                                    </div>
                                                                    <div class="timeline__subtitle">
                                                                        Including weekly tournaments, multiplayer and daily drop prizes
                                                                    </div>
                                                                </div>
                                                                <div class="timeline__info">
                                                                    <div class="timeline__status">
                                                                        <i class="icon icon-clock"></i>
                                                                        <span>Ended</span>
                                                                    </div>
                                                                    <div class="accordion__arrow timeline__arrow">
                                                                        <i class="icon icon-chevron-down"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion__body" style="display: none;">
                                                                <div class="timeline__desc">
                                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime,
                                                                    quidem q uos culpa nulla consequatur doloremque! Animi labore ullam
                                                                    sequi ipsam error, soluta nam unde voluptate ex, vero architecto ipsa quisquam.
                                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime,
                                                                    quidem quos culpa nulla consequatur doloremque! Animi labore ullam
                                                                    sequi ipsam error, soluta nam unde voluptate ex, vero architecto ipsa quisquam.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="accordion__item timeline__item">
                                                            <div class="accordion__header timeline__trigger">
                                                                <div class="timeline__heading">
                                                                    <div class="accordion__title timeline__title">
                                                                        Weeks 1-4 (from January 2 18:00 CET to January 30 18:00 CET)
                                                                    </div>
                                                                    <div class="timeline__subtitle">
                                                                        Including weekly tournaments, multiplayer and daily drop prizes
                                                                    </div>
                                                                </div>
                                                                <div class="timeline__info">
                                                                    <div class="timeline__status">
                                                                        <i class="icon icon-clock"></i>
                                                                        <span>Ended</span>
                                                                    </div>
                                                                    <div class="accordion__arrow timeline__arrow">
                                                                        <i class="icon icon-chevron-down"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion__body" style="display: none;">
                                                                <div class="timeline__desc">
                                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime,
                                                                    quidem q uos culpa nulla consequatur doloremque! Animi labore ullam
                                                                    sequi ipsam error, soluta nam unde voluptate ex, vero architecto ipsa quisquam.
                                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime,
                                                                    quidem quos culpa nulla consequatur doloremque! Animi labore ullam
                                                                    sequi ipsam error, soluta nam unde voluptate ex, vero architecto ipsa quisquam.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="accordion__item timeline__item ongoing">
                                                            <div class="accordion__header timeline__trigger">
                                                                <div class="timeline__heading">
                                                                    <div class="accordion__title timeline__title">
                                                                        Weeks 1-4 (from January 2 18:00 CET to January 30 18:00 CET)
                                                                    </div>
                                                                    <div class="timeline__subtitle">
                                                                        Including weekly tournaments, multiplayer and daily drop prizes
                                                                    </div>
                                                                </div>
                                                                <div class="timeline__info">
                                                                    <div class="timeline__status">
                                                                        <i class="icon icon-clock"></i>
                                                                        <span>Ongoing</span>
                                                                    </div>
                                                                    <div class="accordion__arrow timeline__arrow">
                                                                        <i class="icon icon-chevron-down"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion__body" style="display: none;">
                                                                <div class="timeline__desc">
                                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime,
                                                                    quidem q uos culpa nulla consequatur doloremque! Animi labore ullam
                                                                    sequi ipsam error, soluta nam unde voluptate ex, vero architecto ipsa quisquam.
                                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime,
                                                                    quidem quos culpa nulla consequatur doloremque! Animi labore ullam
                                                                    sequi ipsam error, soluta nam unde voluptate ex, vero architecto ipsa quisquam.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="accordion__item timeline__item">
                                                            <div class="accordion__header timeline__trigger">
                                                                <div class="timeline__heading">
                                                                    <div class="accordion__title timeline__title">
                                                                        Weeks 1-4 (from January 2 18:00 CET to January 30 18:00 CET)
                                                                    </div>
                                                                    <div class="timeline__subtitle">
                                                                        Including weekly tournaments, multiplayer and daily drop prizes
                                                                    </div>
                                                                </div>
                                                                <div class="timeline__info">
                                                                    <div class="timeline__status">
                                                                        <i class="icon icon-clock"></i>
                                                                        <span>Ended</span>
                                                                    </div>
                                                                    <div class="accordion__arrow timeline__arrow">
                                                                        <i class="icon icon-chevron-down"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="accordion__body" style="display: none;">
                                                                <div class="timeline__desc">
                                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime,
                                                                    quidem q uos culpa nulla consequatur doloremque! Animi labore ullam
                                                                    sequi ipsam error, soluta nam unde voluptate ex, vero architecto ipsa quisquam.
                                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime,
                                                                    quidem quos culpa nulla consequatur doloremque! Animi labore ullam
                                                                    sequi ipsam error, soluta nam unde voluptate ex, vero architecto ipsa quisquam.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inner-block__action">
                                        <div class="countdown" data-date="{{\Carbon\Carbon::parse($promo->entityData->ed_datetime_1)->format('M d, Y H:i:s')}}">
                                            <div class="countdown__title">
                                                <i class="icon icon-stopwatch"></i>
                                                <span>Promo running</span>
                                            </div>
                                            <div class="countdown__wrap loading">
                                                <div class="countdown__item">
                                                    <div class="countdown__counter" id="promo-days">0</div>
                                                    <div class="countdown__text">Days</div>
                                                </div>
                                                <div class="countdown__item">
                                                    <div class="countdown__counter" id="promo-hours">0</div>
                                                    <div class="countdown__text">Hours</div>
                                                </div>
                                                <div class="countdown__item">
                                                    <div class="countdown__counter" id="promo-minutes">0</div>
                                                    <div class="countdown__text">Minutes</div>
                                                </div>
                                                <div class="countdown__item">
                                                    <div class="countdown__counter" id="promo-seconds">0</div>
                                                    <div class="countdown__text">Seconds</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="info-list info-list_md">
                                            <div class="info-list__title">
                                                <i class="icon icon-library-filled"></i>
                                                <span>Assets</span>
                                            </div>
                                            <div class="info-list__items">
                                                <div class="info-list__item selectable-download">
                                                    <div class="info-list__subtitle">Banners</div>
                                                    <div class="info-list__label">
                                                        <div class="custom-select custom-select_md">
                                                            <div class="combo-box" data-combo-name="banners" data-combo-selected="all">
                                                                <div class="combo-box-selected">
                                                                    <div class="combo-box-selected-wrap"></div>
                                                                </div>
                                                                <div class="combo-box-dropdown">
                                                                    <div class="combo-box-options">
                                                                        <div class="combo-option selected" data-option-value="all" data-link="#all-counties">
                                                                            <span>All Countries</span>
                                                                        </div>
                                                                        <div class="combo-option" data-option-value="baccarat" data-link="#romania">
                                                                            <span>Romania</span>
                                                                        </div>
                                                                        <div class="combo-option" data-option-value="blackjack" data-link="#malta">
                                                                            <span>Malta</span>
                                                                        </div>
                                                                        <div class="combo-option" data-option-value="roulette" data-link="#argentina">
                                                                            <span>Argentina</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="info-list__value">
                                                        <a href="#all-countries" download="" class="btn btn_md btn_badge btn_main-light selectable-download__trigger">
                                                            <i class="icon icon-download"></i>
                                                        </a>
                                                    </div>
                                                    <div class="info-list__subtitle">Generic banners</div>
                                                    <div class="info-list__label">
                                                        <div class="custom-select custom-select_md">
                                                            <div class="combo-box" data-combo-name="generic-banners" data-combo-selected="all">
                                                                <div class="combo-box-selected">
                                                                    <div class="combo-box-selected-wrap"></div>
                                                                </div>
                                                                <div class="combo-box-dropdown">
                                                                    <div class="combo-box-options">
                                                                        <div class="combo-option selected" data-option-value="all" data-link="#all-counties">
                                                                            <span>All Countries</span>
                                                                        </div>
                                                                        <div class="combo-option" data-option-value="baccarat" data-link="#romania">
                                                                            <span>Romania</span>
                                                                        </div>
                                                                        <div class="combo-option" data-option-value="blackjack" data-link="#malta">
                                                                            <span>Malta</span>
                                                                        </div>
                                                                        <div class="combo-option" data-option-value="roulette" data-link="#argentina">
                                                                            <span>Argentina</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="info-list__value">
                                                        <a href="#all-countries" download="" class="btn btn_md btn_badge btn_main-light selectable-download__trigger">
                                                            <i class="icon icon-download"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
