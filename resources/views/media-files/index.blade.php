@extends('layouts.app')

@section('title') Media Files @endsection

@section('keywords') media, files, games @endsection

@section('description') All game files @endsection

@section('styles')
    <!-- Page Css -->
    <link rel="stylesheet" href="{{asset('assets/css/pages/media-files.css?') . filemtime('assets/css/pages/media-files.css')}}">
    <!-- ========================== -->
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="column sm-12">
                <div class="content__body">
                    <div class="content__heading">
                        <h1 class="content__title h1-font">
                            Media Files
                        </h1>
                    </div>
                    <div class="media-files media-files-page shadow-xs radius-md tabs">
                        <div class="media-files__heading">
                            <div class="media-files__top">
                                <div class="media-files__breadcrumb breadcrumb">
                                    <div class="breadcrumb__wrap">
                                        <div class="breadcrumb__item">
                                            <span> Home </span>
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
                        <div class="tabs__content all-medias-content root-files">
                            @if(!@Request::has('path'))
                                @include('components.media-files', ['path_data' => $all_files])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('startScripts')
    <script defer>
        var file_path = "{{ @Request::has('path') ? @Request::get('path') : '' }}";
    </script>
@endsection
