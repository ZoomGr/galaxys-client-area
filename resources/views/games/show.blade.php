@extends('layouts.app')

@section('title') {{ $game->entitySeo->es_title ?? $game->entityDataLang->edl_title }} @endsection

@section('keywords') {{ $game->entitySeo->es_keywords ?? ''}} @endsection

@section('description') {{ $game->entitySeo->es_description ?? ''}} @endsection

@section('styles')
    <!-- Page Css -->
    <link rel="stylesheet" href="{{asset('assets/css/pages/inner.css?') . filemtime('assets/css/pages/inner.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/pages/media-files.css?') . filemtime('assets/css/pages/media-files.css')}}">
    <!-- ========================== -->
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="column sm-12">
                <div class="content__body">
                    <div class="content__heading">
                        <div class="inner-heading">
                            <a href="{{ route('games.index') }}" class="inner-heading__icon">
                                <i class="icon icon-arrow-left"></i>
                            </a>
                            <div class="inner-heading__text">
                                <a href="{{ route('games.index') }}" class="inner-heading__title title">
                                    {{ $game->entityDataLang->edl_title }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tabs compliance">
                        <div class="action-bar tabs__control shadow-xs radius-xxs">
                            <div class="action-bar__tabs">
                                <div class="btn btn_sm tab {{@Request::has('type') ? '' : 'active'}}" data-tab="game-main-info">
                                    <span>Main info</span>
                                </div>
                                @if($game->all_files)
                                    <div class="btn btn_sm tab {{@Request::has('type') ? 'active' : ''}}" data-tab="game-media-files">
                                        <span>Media files</span>
                                    </div>
                                @endif
                            </div>
                            <div class="action-bar__btn">
                                <a href="#" class="btn btn_sm color-main update-favorites {{$game->favorite ? 'btn_main' : ''}}" data-favorite="{{$game->entity_id}}">
                                    <i class="icon icon-heart"></i>
                                    <span>Add to favourites</span>
                                    <span>Favourite</span>
                                </a>
                                @if(!empty($game->entityData->ed_char_1))
                                    <a href="{{$game->entityData->ed_char_1}}" target="_blank" class="btn btn_gradient btn_sm color-main">
                                        <i class="icon icon-play"></i>
                                        <span>Play demo</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="compliance__content tabs__content">
                            <div id="game-main-info" class="shadow-xs radius-md tab-content {{@Request::has('type') ? '' : 'active'}}">
                                <div class="inner-block shadow-xs radius-md">
                                    <div class="inner-block__body">
                                        <div class="inner-block__img radius-xs">
                                            <img src="{{ \App\Helpers\PanelEntity::getEntityImage($game->entityData->ed_image, 751, 383, 6) }}" alt="{{$game->entityDataLang->edl_title}}">
                                        </div>
                                        <div class="inner-block__details">
                                            <div class="inner-block__details-item">
                                                {!! $game->entityDataLang->edl_text_1 !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="inner-block__action">
                                        <div class="info-list info-list_sm">
                                            <div class="info-list__title">
                                                <i class="icon icon-info"></i>
                                                <span>Information</span>
                                            </div>
                                            <div class="info-list__items">
                                                <div class="info-list__item">
                                                    <div class="info-list__label">Operating hours</div>
                                                    <div class="info-list__value">{{ $game->entityDataLang->edl_char_2 }}</div>
                                                </div>
                                                {{--                                                <div class="info-list__item">--}}
                                                {{--                                                    <div class="info-list__label">Technology</div>--}}
                                                {{--                                                    <div class="info-list__value">{{ $game->entityDataLang->edl_char_3 }}</div>--}}
                                                {{--                                                </div>--}}
                                                <div class="info-list__item">
                                                    <div class="info-list__label">Available on</div>
                                                    <div class="info-list__value">
                                                        <div class="info-list__devices">
                                                            @foreach($game->devices as $device)
                                                                @if($device['eo_value'] == 1)
                                                                    <img width="32" height="32" src="{{asset('assets/img/desktop.svg')}}" alt="desktop">
                                                                @elseif($device['eo_value'] == 2)
                                                                    <img width="32" height="32" src="{{asset('assets/img/tablet.svg')}}" alt="tablet">
                                                                @else
                                                                    <img width="32" height="32" src="{{asset('assets/img/mobile.svg')}}" alt="mobile">
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="info-list info-list_md">
                                            <div class="info-list__title">
                                                <i class="icon icon-notebook-filled"></i>
                                                <span>Game License</span>
                                            </div>
                                            <div class="info-list__items">
                                                @if($country_licenses->count())
                                                    <div class="info-list__item selectable-download">
                                                        <div class="info-list__label">
                                                            <div class="custom-select custom-select_md">
                                                                <div class="combo-box" data-combo-name="game-license" data-combo-selected="all">
                                                                    <div class="combo-box-selected">
                                                                        <div class="combo-box-selected-wrap"></div>
                                                                    </div>
                                                                    <div class="combo-box-dropdown">
                                                                        <div class="combo-box-options flex flex-column-reverse">
                                                                            @php $all_files_links = []; @endphp
                                                                            @foreach($country_licenses as $country_license)
                                                                                @php
                                                                                    $image = asset(\App\Helpers\PanelEntity::image($country_license->entityData->ed_char_1));
                                                                                    $all_files_links[] = $image;
                                                                                @endphp
                                                                                <div class="combo-option" data-option-value="{{$country_license->entityDataLang->edl_title}}" data-link="{{$image}}">
                                                                                    <span>{{\App\Helpers\Helper::getCountry($country_license->entityData->ed_number_1)}}</span>
                                                                                </div>
                                                                            @endforeach
                                                                            <div class="combo-option selected" data-option-value="All Licenses" data-link="{{ implode(',', $all_files_links) }}">
                                                                                <span>All Countries</span>
                                                                            </div>
                                                                            {{--                                                                        <div class="combo-option" data-option-value="blackjack" data-link="#malta">--}}
                                                                            {{--                                                                            <span>Malta</span>--}}
                                                                            {{--                                                                        </div>--}}
                                                                            {{--                                                                        <div class="combo-option" data-option-value="roulette" data-link="#argentina">--}}
                                                                            {{--                                                                            <span>Argentina</span>--}}
                                                                            {{--                                                                        </div>--}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="info-list__value">
                                                            <a href="{{ implode(',', $all_files_links) }}" download="All Licenses" class="btn btn_md btn_badge btn_main-light selectable-download__trigger download-all">
                                                                <i class="icon icon-download"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                                @foreach($game_licenses as $game_license)
                                                    @php $pathInfo = null; @endphp
                                                    @if(!empty($game_license->entityData->ed_char_1))
                                                        @php $path = 'assets/img/default.png'; @endphp
                                                        @php $pathInfo = pathinfo($game_license->entityData->ed_char_1); @endphp
                                                        @if($pathInfo['extension'] == 'png' || $pathInfo['extension'] == 'jpg' || $pathInfo['extension'] == 'webp')
                                                            @php $path = 'assets/img/png.png'; @endphp
                                                        @elseif($pathInfo['extension'] == 'xlsx')
                                                            @php $path = 'assets/img/exel.svg'; @endphp
                                                        @elseif($pathInfo['extension'] == 'pdf')
                                                            @php $path = "assets/img/pdf.svg"; @endphp
                                                        @elseif($file['extension'] == 'psd')
                                                            @php $path = "assets/img/psd.svg"; @endphp
                                                        @elseif($file['extension'] == 'mp4')
                                                            @php $path = "assets/img/mp4.svg"; @endphp
                                                        @elseif($file['extension'] == 'tif')
                                                            @php $path = "assets/img/tif.svg"; @endphp
                                                        @endif
                                                    @endif
                                                    <div class="info-list__item">
                                                        <div class="info-list__label">
                                                            <div class="file-info">
                                                                @if(isset($pathInfo))
                                                                    <div class="file-info__icon">
                                                                        <img src="{{asset($path)}}" alt="{{$pathInfo['basename']}}">
                                                                    </div>
                                                                @endif
                                                                <div class="file-info__body">
                                                                    <div class="file-info__name font-semibold">{{$game_license->entityDataLang->edl_title ?? $pathInfo['basename'] }}</div>
                                                                    @if(isset($pathInfo))
                                                                        <div class="file-info__size text-14 font-medium color-black-30">
                                                                            {{\App\Helpers\Helper::formatSizeUnits(File::size(public_path(\App\Helpers\PanelEntity::image($game_license->entityData->ed_char_1))))}}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if(isset($pathInfo))
                                                            <div class="info-list__value">
                                                                <a href="{{asset(\App\Helpers\PanelEntity::image($game_license->entityData->ed_char_1))}}" download="{{$game_license->entityDataLang->edl_title ?? $pathInfo['basename']}}" class="btn btn_md btn_badge btn_main-light">
                                                                    <i class="icon icon-download"></i>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($game->all_files)
                                <div id="game-media-files" class="shadow-xs radius-md tab-content {{@Request::has('type') ? 'active' : ''}}">
                                    <div class="media-files shadow-xs radius-md tabs">
                                        <div class="media-files__heading">
                                            <div class="media-files__top">
                                                <div class="media-files__breadcrumb breadcrumb">
                                                    <div class="breadcrumb__wrap">
                                                        <div class="breadcrumb__item">
                                                            <span>{{$game->entityDataLang->edl_title}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-files__download">
                                                    <span class="media-files__selected"></span>
                                                    <div class="media-files__download-btn">
                                                        <div class="media-download-all btn btn_sm color-main">
                                                            <i class="icon icon-download"></i>
                                                            <span>Download All</span>
                                                        </div>
                                                        <div class="media-download-selected btn btn_sm color-main">
                                                            <i class="icon icon-download"></i>
                                                            <span>Download Selected</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @include('components.media-files-filters')
                                        </div>
                                        <div class="tabs__content all-medias-content">
                                            @include('components.media-files', ['path_data' => $game->all_files])
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let game_parent = '{{$game->entityDataLang->edl_text_2}}';
    </script>
@endsection
