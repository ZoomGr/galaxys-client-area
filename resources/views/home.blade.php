@extends('layouts.app')

@section('title') Dashboard @endsection

@section('keywords') home, imeginelive @endsection

@section('description') Imeginelive description @endsection

@section('styles')
<!-- Page Css -->
<link rel="stylesheet" href="{{asset('assets/css/pages/home.css?'). filemtime('assets/css/pages/home.css')}}">
<!-- ========================== -->
@endsection

@section('content')

<div class="content">
    <div class="row">
        <div class="column sm-12">
            <div class="main-slider">
                <div class="main-slider__swiper swiper">
                    <div class="main-slider__controls">
                        <div class="main-slider__control main-slider__control_prev round-badge">
                            <i class="icon icon-arrow-left"></i>
                        </div>
                        <div class="main-slider__pagination"></div>
                        <div class="main-slider__control main-slider__control_next round-badge">
                            <i class="icon icon-arrow-right"></i>
                        </div>
                    </div>
                    <div class="swiper-wrapper">
                        @foreach($slider as $item)
                            <div class="swiper-slide">
                                <div class="main-slider__slide">
                                    <div class="main-slider__body {{empty($item->entityDataLang->edl_title) ? 'main-slider__body_single' : ''}}">
                                        @if(!empty($item->entityDataLang->edl_title))
                                            <div class="main-slider__title">
                                                {{$item->entityDataLang->edl_title}}
                                            </div>
                                        @endif
                                        <a href="{{$item->entityDataLang->edl_char_1}}" class="btn btn_gradient btn_sm">
                                            <span>See more</span>
                                            <i class="icon icon-arrow-right"></i>
                                        </a>
                                    </div>
                                    <div class="main-slider__img">
                                        <img src="{{\App\Helpers\PanelEntity::thumbnail($item->entityData->ed_image, 1495, 490, 6)}}" alt="{{$item->entityDataLang->edl_title}}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="column sm-12">
            <div class="content__body">
                <div class="latest-news shadow-xs radius-md list-block">
                    <div class="list-block__heading align-between">
                        <div class="list-block__title h2-font">
                            <i class="icon icon-doc"></i>
                            <span>Latest News</span>
                        </div>
                        <a href="{{route('news.index')}}" class="btn btn_main-light btn_sm">
                            <span>All news</span>
                        </a>
                    </div>
                    <div class="list-block__body latest-news__body">
                        @php $main_news = array_shift($latest_news); @endphp
                        @if($main_news)
                        <div class="latest-news__main">
                            <a href="{{route('news.show', ['news' => $main_news['entity_id']])}}" class="news-card news-card_single radius-xs">
                                <div class="news-card__img radius-xs">
                                    <img src="{{ \App\Helpers\PanelEntity::getEntityImage($main_news['entity_data']['ed_image'], 751, 383, 6) }}" alt="{{ $main_news['entity_data_lang']['edl_title'] }}">
                                </div>
                                <div class="news-card__body">
                                    <div class="news-card__date">
                                        <div class="date date_grey">
                                            <i class="icon icon-clock"></i>
                                            <span>{{\Carbon\Carbon::parse($main_news['entity_data']['ed_datetime_1'])->format('d.m.Y')}}</span>
                                        </div>
                                    </div>
                                    <div class="news-card__title text-36 font-bold">
                                        {{ $main_news['entity_data_lang']['edl_title'] }}
                                    </div>
                                    <div class="news-card__desc color-black-50">
                                        {{$main_news['entity_data_lang']['edl_char_1']}}
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endif
                        <div class="latest-news__list radius-xs bg-black-25">
                            @foreach($latest_news as $news)
                            <div class="latest-news__item">
                                <a href="{{route('news.show', ['news' => $news['entity_id']])}}" class="news-card news-card_landscape">
                                    <div class="news-card__body">
                                        <div class="news-card__date color-black-50">
                                            <div class="date">
                                                <i class="icon icon-clock"></i>
                                                <span>{{\Carbon\Carbon::parse($news['entity_data']['ed_datetime_1'])->format('d.m.Y')}}</span>
                                            </div>
                                        </div>
                                        <div class="news-card__title text-20 font-bold">
                                            {{ $news['entity_data_lang']['edl_title'] }}
                                        </div>
                                        <div class="news-card__desc color-black-50">
                                            {{ $news['entity_data_lang']['edl_char_1'] }}
                                        </div>
                                    </div>
                                    <div class="news-card__img">
                                        <img src="{{ \App\Helpers\PanelEntity::getEntityImage($news['entity_data']['ed_image'], 751, 383, 6) }}" alt="{{ $news['entity_data_lang']['edl_title'] }}">
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
{{--                <div class="promos-show shadow-xs radius-md list-block">--}}
{{--                    <div class="list-block__heading align-between">--}}
{{--                        <div class="list-block__title h2-font">--}}
{{--                            <i class="icon icon-star"></i>--}}
{{--                            <span>Promos</span>--}}
{{--                        </div>--}}
{{--                        <a href="{{route('promos.index')}}" class="btn btn_main-light btn_sm">--}}
{{--                            <span>All promos</span>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="list-block__body row md-cols-3">--}}
{{--                        @foreach($promos as $promo)--}}
{{--                        <div class="column sm-12">--}}
{{--                            <a href="{{route('promos.show', ['promo' => $promo->entity_id])}}" class="game-card">--}}
{{--                                <div class="game-card__img radius-xxs">--}}
{{--                                    <img src="{{ \App\Helpers\PanelEntity::getEntityImage($promo->entityData->ed_image, 292, 292, 6) }}" alt="{{ $promo->entityDataLang->edl_title }}">--}}
{{--                                </div>--}}
{{--                                <div class="game-card__body">--}}
{{--                                    <div class="game-card__title text-20 font-bold">{{ $promo->entityDataLang->edl_title }}</div>--}}
{{--                                    <div class="game-card__date color-black-50">--}}
{{--                                        <div class="date">--}}
{{--                                            <i class="icon icon-clock"></i>--}}
{{--                                            <span>{{\Carbon\Carbon::parse($promo->entityData->ed_datetime_1)->format('jS M Y')}} - {{\Carbon\Carbon::parse($promo->entityData->ed_datetime_2)->format('d M Y')}}</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="game-card__tags">--}}
{{--                                        <div class="tags">--}}
{{--                                            <div class="tags__wrap">--}}
{{--                                                @foreach($promo->tags as $tag)--}}
{{--                                                <div class="tag">{{$tag->entityDataLang->edl_title}}</div>--}}
{{--                                                @endforeach--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="games-show shadow-xs radius-md list-block">
                    <div class="list-block__heading align-between">
                        <div class="list-block__title h2-font">
                            <i class="icon icon-list"></i>
                            <span>Games</span>
                        </div>
                        <a href="{{ route('games.index') }}" class="btn btn_main-light btn_sm">
                            <span>All games</span>
                        </a>
                    </div>
                    <div class="list-block__body row md-cols-4">
                        @foreach($games as $game)
                        <div class="column sm-12">
                            <a href="{{ route('games.show', ['game' => $game->entity_id]) }}" class="game-card">
                                <div class="game-card__img radius-xxs">
                                    <img src="{{ \App\Helpers\PanelEntity::image($game->entityData->ed_image) }}" alt="{{ $game->entityDataLang->edl_title }}">

                                    <div class="game-card__action game-card__action_fav update-favorites {{$game->favorite ? 'active' : ''}}" data-favorite="{{$game->entity_id}}">
                                        <i class="icon icon-heart"></i>
                                    </div>
                                    @if(!empty($game->entityData->ed_char_1))
                                        <div data-link="{{$game->entityData->ed_char_1}} class="game-card__action game-card__action_video">
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
            </div>
        </div>
{{--        <div class="column sm-12 md-4">--}}
{{--            <div class="content-aside">--}}
{{--                <div class="content-aside__thumb">--}}
{{--                    <div class="upcoming-releases shadow-xs radius-md list-block">--}}
{{--                        <div class="list-block__title h2-font">--}}
{{--                            <i class="icon icon-calendar"></i>--}}
{{--                            <span>Upcoming Releases</span>--}}
{{--                        </div>--}}
{{--                        <div class="upcoming-releases__list">--}}
{{--                            @php $tomorrow = new DateTime('tomorrow'); @endphp--}}
{{--                            @foreach($releases as $release)--}}
{{--                            <div class="upcoming-release">--}}
{{--                                <div class="upcoming-release__date">--}}
{{--                                    <span class="text-12 font-semibold uppercase">{{$tomorrow->format('M')}}</span>--}}
{{--                                    <span class="text-27 font-extrabold">{{$tomorrow->format('d')}}</span>--}}
{{--                                </div>--}}
{{--                                <div class="upcoming-release__body">--}}
{{--                                    <div class="upcoming-release__type type-pair">--}}
{{--                                        @if(new DateTime($release->entityData->ed_datetime_2) == $tomorrow)--}}
{{--                                        <div class="type-dot type-dot_operators">--}}
{{--                                            <span></span>--}}
{{--                                        </div>--}}
{{--                                        <span class="type-pair__name">For operators</span>--}}
{{--                                        @else--}}
{{--                                        <div class="type-dot type-dot_testing">--}}
{{--                                            <span></span>--}}
{{--                                        </div>--}}
{{--                                        <span class="type-pair__name">For testing</span>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                    <div class="upcoming-release__name text-20 font-semibold">{{$release->entityDataLang->edl_title}}</div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                        <div class="upcoming-releases__btn">--}}
{{--                            <a href="{{route('games.roadmap')}}" class="btn btn_main-light btn_sm fit">--}}
{{--                                <span>See all</span>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>
@endsection
