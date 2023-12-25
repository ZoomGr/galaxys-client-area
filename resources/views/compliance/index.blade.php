@extends('layouts.app')

@section('title') {{ $compliance->entitySeo->es_title ?? $compliance->entityDataLang->edl_title }} @endsection

@section('keywords') {{ $compliance->entitySeo->es_keywords ?? ''}} @endsection

@section('description') {{ $compliance->entitySeo->es_description ?? ''}} @endsection

@section('styles')
    <!-- Page Css -->
    <link rel="stylesheet" href="{{asset('assets/css/pages/games.css')}}">
    <!-- ========================== -->
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="column sm-12">
                <div class="content__body">
                    <div class="content__heading">
                        <h1 class="content__title h1-font">
                            Compliance
                        </h1>
                    </div>
                    <div class="tabs compliance">
                        <div class="action-bar tabs__control shadow-xs radius-xxs">
                            <div class="action-bar__tabs">
                                <div class="btn btn_sm tab active" data-tab="licenses">
                                    <span>Licenses</span>
                                </div>
                                <div class="btn btn_sm tab" data-tab="game-certificates">
                                    <span>Game certificates</span>
                                </div>
                            </div>
                            <div class="action-bar__btn">
                                <a href="#" download="All Licenses" class="btn btn_sm color-main tab__action download-all-licenses" data-tab-action="licenses">
                                    <i class="icon icon-download"></i>
                                    <span>Download All</span>
                                </a>
                                @if(!empty($compliance->entityData->ed_char_1))
                                    <a href="{{\App\Helpers\PanelEntity::image($compliance->entityData->ed_char_1)}}" download="Game Jurisdiction List" class="btn btn_sm color-main tab__action hide" data-tab-action="game-certificates">
                                        <i class="icon icon-download"></i>
                                        <span>Game Jurisdiction List</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="compliance__content tabs__content">
                            <div id="licenses" class="shadow-xs radius-md tab-content active">
                                <div class="row md-cols-4">
                                    @foreach($compliance_licenses as $compliance_license)
                                        @php $pathInfo = pathinfo($compliance_license->entityData->ed_char_1); @endphp
                                        @if($pathInfo['extension'] == 'png' || $pathInfo['extension'] == 'jpg' || $pathInfo['extension'] == 'webp')
                                            @php $path = 'assets/img/png.png'; @endphp
                                        @elseif($pathInfo['extension'] == 'xlsx')
                                            @php $path = 'assets/img/exel.svg'; @endphp
                                        @elseif($pathInfo['extension'] == 'pdf')
                                            @php $path = "assets/img/pdf.svg"; @endphp
                                        @endif
                                        <div class="column sm-12">
                                            <div class="license-block">
                                                <div class="license-block__file">
                                                    <div class="file-info file-info_md">
                                                        <div class="file-info__icon">
                                                            <img src="{{asset($path)}}" alt="{{$pathInfo['basename']}}">
                                                        </div>
                                                        <div class="file-info__body">
                                                            <div class="file-info__name text-20 font-semibold">{{$compliance_license->entityDataLang->edl_title ?? $pathInfo['basename']}}</div>
                                                            <div class="file-info__size text-14 font-medium color-black-50">
                                                                {{\App\Helpers\Helper::formatSizeUnits(File::size(public_path(\App\Helpers\PanelEntity::image($compliance_license->entityData->ed_char_1))))}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="license-block__btn">
                                                    <a href="{{asset(\App\Helpers\PanelEntity::image($compliance_license->entityData->ed_char_1))}}" download="{{$compliance_license->entityDataLang->edl_title ?? $pathInfo['basename']}}" class="btn btn_sm btn_badge btn_main-light">
                                                        <i class="icon icon-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div id="game-certificates" class="shadow-xs radius-md tab-content">
                                <div class="row md-cols-4">
                                    @foreach($licenses_games as $licenses_game)
                                        <div class="column sm-12">
                                            <div class="certificate-block selectable-download">
                                                <div class="certificate-block__heading">
                                                    <div class="certificate-block__img radius-xs">
                                                        <img src="{{asset(\App\Helpers\PanelEntity::image($licenses_game->entityData->ed_image))}}" alt="{{$licenses_game->entityDataLang->edl_title}}">
                                                    </div>
                                                    <div class="text-20 font-semibold">
                                                        {{$licenses_game->entityDataLang->edl_title}}
                                                    </div>
                                                </div>
                                                <div class="certificate-block__body">
                                                    <div class="custom-select custom-select_sm">
                                                        <div class="combo-box" data-combo-name="{{$licenses_game->entity_id}}" data-combo-selected="all">
                                                            <div class="combo-box-selected">
                                                                <div class="combo-box-selected-wrap"></div>
                                                            </div>
                                                            <div class="combo-box-dropdown">
                                                                <div class="combo-box-options flex flex-column-reverse">
                                                                    @php $all_files_links = []; @endphp
                                                                    @foreach($licenses_game->licenses as $country_license)
                                                                        @php
                                                                            $image = asset(\App\Helpers\PanelEntity::image($country_license->entityData->ed_char_1));
                                                                            $all_files_links[] = $image;
                                                                        @endphp
                                                                        <div class="combo-option" data-option-value="{{$country_license->entityDataLang->edl_title}}" data-link="{{$image}}">
                                                                            <span>{{\App\Helpers\Helper::getCountry($country_license->entityData->ed_number_1)}}</span>
                                                                        </div>
                                                                    @endforeach
                                                                    <div class="combo-option selected" data-option-value="All Certificates" data-link="{{ implode(',', $all_files_links) }}">
                                                                        <span>All Games</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="{{ implode(',', $all_files_links) }}" download="All Certificates" class="btn btn_sm btn_badge btn_main-light selectable-download__trigger download-all">
                                                        <i class="icon icon-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
