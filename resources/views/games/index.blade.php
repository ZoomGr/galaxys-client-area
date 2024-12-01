@extends('layouts.app')

@section('title') {{ $entity->entitySeo->es_title ?? $entity->entityDataLang->edl_title }} @endsection

@section('keywords') {{ $entity->entitySeo->es_keywords ?? ''}} @endsection

@section('description') {{ $entity->entitySeo->es_description ?? ''}} @endsection

@section('styles')
    <!-- Page Css -->
    <link rel="stylesheet" href="{{asset('assets/css/pages/games.css?') . filemtime('assets/css/pages/games.css')}}">
    <!-- ========================== -->
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="column sm-12">
                <div class="content__body">
                    <div class="content__heading">
                        <h1 class="content__title h1-font">
                            Game Library
                        </h1>
                    </div>
                    <div class="game-library shadow-xs radius-md">
                        <div class="game-library__heading">
                            <form action="{{ route('games.index') }}" method="GET" class="games-filter-form">
                                <div class="filters">
                                    <div class="filters__action">
                                        <div class="filters__title text-20 font-medium">Filters</div>
                                        <div class="filters__list">
                                            <div class="filters__item">
                                                <div class="custom-select custom-select_md custom-select_border">
                                                    <div class="combo-box" data-combo-name="games_filter" data-combo-value="{{Request::input('games_filter')}}">
                                                        <div class="combo-box-selected">
                                                            <div class="combo-box-selected-wrap">
                                                                <span class="combo-box-placeholder">Filter</span>
                                                            </div>
                                                        </div>
                                                        <div class="combo-box-dropdown">
                                                            <div class="combo-box-options">
                                                                <div class="combo-option {{ Request::input('games_filter') == 'all' ? "selected" : "" }}"  data-option-value="all">
                                                                    <span>All</span>
                                                                </div>
                                                                @foreach($filters as $filter)
                                                                    <div class="combo-option {{ Request::input('games_filter') ==  $filter->entity_id ? "selected" : "" }}"
                                                                    data-option-value="{{$filter->entity_id}}">
                                                                        <span>{{$filter->entityDataLang->edl_title}}</span>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                <div class="filters__tags">--}}
                                    {{--                                    <div class="filters__tags-wrap">--}}
                                    {{--                                        <div class="filter-tag">--}}
                                    {{--                                            <span>All features</span>--}}
                                    {{--                                            <div class="filter-tag__remove">--}}
                                    {{--                                                <i class="icon icon-close"></i>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="filter-tag">--}}
                                    {{--                                            <span>Feature 1</span>--}}
                                    {{--                                            <div class="filter-tag__remove">--}}
                                    {{--                                                <i class="icon icon-close"></i>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                </div>--}}
                                </div>
                            </form>
                        </div>
                        <div class="game-library__body row md-cols-4">
                            @foreach($games as $game)
                                <div class="column sm-12" data-parent-id="{{$game->entityData->ed_number_1 ?? ''}}">
                                    <a href="{{ route('games.show', ['game' => $game->entity_id]) }}" class="game-card">
                                        <div class="game-card__img radius-xs">
                                            <img src="{{ \App\Helpers\PanelEntity::getEntityImage($game->entityData->ed_image, 340, 229, 6) }}" alt="{{ $game->entityDataLang->edl_title }}">

                                            <div class="game-card__action game-card__action_fav update-favorites {{$game->favorite ? 'active' : ''}}" data-favorite="{{$game->entity_id}}">
                                                <i class="icon icon-heart"></i>
                                            </div>
                                            @if(!empty($game->entityData->ed_char_1))
                                                <div data-link="{{$game->entityData->ed_char_1}}" target="_blank" class="game-card__action game-card__action_video">
                                                    <div class="btn btn_gradient btn_sm">
                                                        <i class="icon icon-play"></i>
                                                        <span>Video record</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="game-card__body">
                                            <div class="game-card__title text-20 font-semibold text-center">{{ $game->entityDataLang->edl_title }}</div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="article-listing-paging text-center">
                        {{ $games->appends($_GET)->links('vendor.pagination.default') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
