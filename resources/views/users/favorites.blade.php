@extends('layouts.app')

@section('title') Account settings @endsection

@section('keywords') Account, settings @endsection

@section('description') Account settings for imaginelive @endsection

@section('styles')
    <!-- Page Css -->
    <link rel="stylesheet" href="{{asset('assets/css/pages/games.css?') . filemtime('assets/css/pages/games.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/pages/media-files.css?') . filemtime('assets/css/pages/media-files.css')}}">
    <!-- ========================== -->
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="column sm-12">
                <div class="content__heading">
                    <h1 class="content__title h1-font">
                        Favourites
                    </h1>
                </div>
                <div class="tabs">
                    <div class="action-bar tabs__control shadow-xs radius-xxs">
                        <div class="action-bar__tabs">
                            <div class="btn btn_sm tab active" data-tab="favourite-games">
                                <span>Games</span>
                            </div>
                            <div class="btn btn_sm tab" data-tab="favourite-files">
                                <span>Files</span>
                            </div>
                        </div>
                    </div>
                    <div class="content__body tabs__content">
                        @if(isset($favorites['Game']))
                            <div id="favourite-games" class="tab-content active">
                                <div class="game-library shadow-xs radius-md">
                                    <div class="game-library__body row md-cols-4">
                                        @foreach($favorites['Game'] as $fav_game)
                                            @php $gameEntity = $fav_game->getFavEntity(); @endphp
                                            <div class="column sm-12">
                                                <a href="{{ route('games.show', ['game' => $gameEntity->entity_id]) }}" class="game-card">
                                                    <div class="game-card__img radius-xs">
                                                        <img src="{{ \App\Helpers\PanelEntity::getEntityImage($gameEntity->entityData->ed_image, 271, 183, 6) }}" alt="{{ $gameEntity->entityDataLang->edl_title }}">

                                                        <div class="game-card__action game-card__action_fav update-favorites active" data-favorite="{{$gameEntity->entity_id}}">
                                                            <i class="icon icon-heart"></i>
                                                        </div>
                                                    </div>
                                                    <div class="game-card__body">
                                                        <div class="game-card__title text-20 font-semibold text-center">{{$gameEntity->entityDataLang->edl_title}}</div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(isset($favorites['File']))
                            <div id="favourite-files" class="tab-content">
                            <div class="media-files shadow-xs radius-md tabs">
                                <div class="media-files__heading">
                                    <div class="media-files__top">
                                        <div class="media-files__breadcrumb breadcrumb">
                                            <div class="breadcrumb__wrap">
                                            </div>
                                        </div>
                                        <div class="media-files__download">
                                            <span class="media-files__selected"></span>
                                            <div class="media-files__download-btn">
                                                <a href="#" download="" class="media-download-all btn btn_sm color-main">
                                                    <i class="icon icon-download"></i>
                                                    <span>Download All</span>
                                                </a>
                                                <div class="media-download-selected btn btn_sm color-main">
                                                    <i class="icon icon-download"></i>
                                                    <span>Download Selected</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @include('components.media-files-filters')
                                </div>
                                <div class="tabs__content all-medias-content root-files">
                                    <div id="media-files-list" class="tab-content {{ !@Request::has('media') || @Request::get('media') != 'media-files-grid' ? 'active' : '' }}">
                                        <table class="media-table">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <div class="media-select-all">
                                                        <label class="custom-check custom-check_checkbox">
                                                            <input type="checkbox" name="media-select-all">
                                                            <span class="custom-check__checkmark"></span>
                                                            <span class="payment-info__label">Name</span>
                                                        </label>
                                                    </div>
                                                </th>
                                                <th>
                                                    <div class="media-date-sort cursor inline-flex align-middle">
                                                        Date Modified
                                                        <i class="icon icon-arrow-down"></i>
                                                    </div>
                                                </th>
                                                <th>File Size</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (count($favorites->all_files))
                                                @if(isset($favorites->all_files['directories']))
                                                    @foreach($favorites->all_files['directories'] as $directory)
                                                        <tr class="media-table__file">
                                                            <td>
                                                                <div class="media-table__name">
                                                                    <a href="{{route('medias.index') .'?path='. $directory['path']}}">
                                                                        <img width="24" height="24" src="{{asset("assets/img/folder.png")}}" alt="file preview">
                                                                        <span class="file-name type-dir">{{$directory['basename']}}</span>
                                                                    </a>
                                                                    <label class="custom-check custom-check_checkbox">
                                                                        <input type="checkbox" name="file-2">
                                                                        <span class="custom-check__checkmark"></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="color-black-40">
                                                                    {{--                                                                {{\Carbon\Carbon::createFromTimestamp($directory['timestamp'])->format('d.m.Y h:m')}}--}}
                                                                    -
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="color-black-40">
                                                                    {{--                                                                {{\App\Helpers\Helper::formatSizeUnits($directory['size'])}}--}}
                                                                    -
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="media-table__action">
                                                                    {{--                                                                <div class="media-table__btn media-link">--}}
                                                                    {{--                                                                    <i class="icon icon-link"></i>--}}
                                                                    {{--                                                                </div>--}}
        {{--                                                            <a href="{{route('medias.download-folder') . '?path='.$directory['path'] }}" download="{{$directory['basename']}}" class="media-table__btn media-download">--}}
        {{--                                                                <i class="icon icon-download"></i>--}}
        {{--                                                            </a>--}}
                                                                    <div class="media-table__btn update-favorite-files {{\App\Models\Favorite::favFile($directory['path']) ? 'active' : ''}}" data-favoriteFile="{{$directory['path']}}">
                                                                        <i class="icon icon-heart"></i>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                @if(isset($favorites->all_files['files']))
                                                    @foreach($favorites->all_files['files'] as $file)
                                                    <tr class="media-table__file">
                                                        <td>
                                                            <div class="media-table__name">
                                                                @if($file['extension'] == 'png' || $file['extension'] == 'jpg' || $file['extension'] == 'webp')
                                                                    @php $path = 'assets/img/png.png'; @endphp
                                                                @elseif($file['extension'] == 'xlsx')
                                                                    @php $path = 'assets/img/exel.svg'; @endphp
                                                                @elseif($file['extension'] == 'pdf')
                                                                    @php $path = "assets/img/pdf.svg"; @endphp
                                                                    {{--                                                                @elseif($file['extension'] == 'svg')--}}
                                                                    {{--                                                                    @php $path = "assets/img/pdf.svg"; @endphp--}}
                                                                @endif
                                                                <img width="24" height="24" src="{{asset($path)}}" alt="file preview">
                                                                <span class="file-name type-{{$file['extension']}}">{{$file['basename']}}</span>

                                                                <label class="custom-check custom-check_checkbox">
                                                                    <input type="checkbox" name="file-1">
                                                                    <span class="custom-check__checkmark"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="color-black-40">{{\Carbon\Carbon::createFromTimestamp($file['timestamp'])->format('d.m.Y h:m')}}</div>
                                                        </td>
                                                        <td>
                                                            <div class="color-black-40">{{\App\Helpers\Helper::formatSizeUnits($file['size'])}}</div>
                                                        </td>
                                                        <td>
                                                            <div class="media-table__action">
                                                                <div class="media-table__btn media-link" data-file="{{$file['path']}}">
                                                                    <i class="icon icon-link"></i>
                                                                </div>
                                                                {{--                                                                <form method="POST" action="{{route('medias.download-file')}}" class="media-table__btn media-download">--}}
                                                                {{--                                                                    @csrf--}}
                                                                {{--                                                                    <input type="hidden" name="path" value="{{$file['path']}}">--}}
                                                                {{--                                                                    <button type="submit"  class="media-table__btn media-download">--}}
                                                                {{--                                                                        <i class="icon icon-download"></i>--}}
                                                                {{--                                                                    </button>--}}
                                                                {{--                                                                </form>--}}
                                                                <a href="{{route('medias.download-file'). '?path='. $file['path']}}" download="{{$file['basename']}}" class="media-table__btn media-download">
                                                                    <i class="icon icon-download"></i>
                                                                </a>
                                                                <div class="media-table__btn update-favorite-files {{\App\Models\Favorite::favFile($file['path']) ? 'active' : ''}}" data-favoriteFile="{{$file['path']}}">
                                                                    <i class="icon icon-heart"></i>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @endif
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="media-files-grid" class="tab-content {{ @Request::has('media') && @Request::get('media') == 'media-files-grid' ? 'active' : '' }}">
                                        <div class="media-list">
                                            <div class="row">
                                                @if (count($favorites->all_files))
                                                    @if(isset($favorites->all_files['directories']))
                                                        @foreach($favorites->all_files['directories'] as $directory)
                                                        <div class="column sm-12 md-3">
                                                            <div class="media-card">
                                                                <div class="media-card__heading">
                                                                    <div class="media-card__name type-dir">{{$directory['basename']}}</div>
                                                                    <div class="media-card__action">
    {{--                                                                    <a href="{{route('medias.download-folder') . '?path='.$directory['path'] }}" download="{{$directory['basename']}}" class="media-card__download">--}}
    {{--                                                                        <i class="icon icon-download"></i>--}}
    {{--                                                                    </a>--}}
                                                                        <div class="media-card__properties properties">
                                                                            <div class="properties__target">
                                                                                <i class="icon icon-properties"></i>
                                                                            </div>
                                                                            <div class="properties__dropdown">
    {{--                                                                            <div class="properties__item">--}}
    {{--                                                                                <i class="icon icon-link"></i>--}}
    {{--                                                                                <span>Link to file</span>--}}
    {{--                                                                            </div>--}}
                                                                                <div class="properties__item update-favorite-files {{\App\Models\Favorite::favFile($directory['path']) ? 'active' : ''}}" data-favoriteFile="{{$directory['path']}}">
                                                                                    <i class="icon icon-heart"></i>
                                                                                    <span>Add to favourites</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="media-card__img">
                                                                    <a href="{{route('medias.index') .'?path='. $directory['path']}}">
                                                                        <img src="{{asset('assets/img/folder-preview.svg')}}" alt="media file">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @endif
                                                    @if(isset($favorites->all_files['files']))
                                                        @foreach($favorites->all_files['files'] as $file)
                                                        <div class="column sm-12 md-3">
                                                            <div class="media-card">
                                                                <div class="media-card__heading">
                                                                    <div class="media-card__name type-{{$file['extension']}}">{{$file['basename']}}</div>
                                                                    <div class="media-card__action">
                                                                        <a href="{{route('medias.download-file'). '?path='. $file['path']}}" download="{{$file['basename']}}" class="media-card__download">
                                                                            <i class="icon icon-download"></i>
                                                                        </a>
                                                                        <div class="media-card__properties properties">
                                                                            <div class="properties__target">
                                                                                <i class="icon icon-properties"></i>
                                                                            </div>
                                                                            <div class="properties__dropdown">
                                                                                <div class="properties__item" data-file="{{$file['path']}}">
                                                                                    <i class="icon icon-link"></i>
                                                                                    <span>Link to file</span>
                                                                                </div>
                                                                                <div class="properties__item update-favorite-files {{\App\Models\Favorite::favFile($file['path']) ? 'active' : ''}}" data-favoriteFile="{{$file['path']}}">
                                                                                    <i class="icon icon-heart"></i>
                                                                                    <span>Add to favourites</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if($file['extension'] == 'png' || $file['extension'] == 'jpg' || $file['extension'] == 'webp')
                                                                    @php $path = $file['url']; @endphp
                                                                @elseif($file['extension'] == 'xlsx')
                                                                    @php $path = 'assets/img/exel.svg'; @endphp
                                                                @elseif($file['extension'] == 'pdf')
                                                                    @php $path = "assets/img/pdf.svg"; @endphp
                                                                @endif
                                                                <div class="media-card__img">
                                                                    <img src="{{asset($path)}}" alt="{{$file['basename']}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
