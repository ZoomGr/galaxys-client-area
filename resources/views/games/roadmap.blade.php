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
                <div class="content__heading flex align-between">
                    <h1 class="content__title h1-font">
                        Roadmap
                    </h1>
                    <a href="{{route('games.export-csv')}}"  class="export-roadmap-games btn btn_sm btn_main">
                        <i class="icon icon-download"></i>
                        <span>Download List</span>
                    </a>
                </div>
            </div>
            <div class="column sm-8">
                <div class="content__body">
                    <div class="upcoming-games shadow-xs radius-md">
                        <table class="upcoming-games__table">
                            <thead>
                            <tr>
                                <th>
                                    <div class="upcoming-games__title caption-sm">Upcoming Games</div>
                                </th>
                                <th>
                                    <div class="upcoming-games__title caption-sm">Media Files</div>
                                </th>
                                <th>
                                    <div class="upcoming-games__title caption-sm">Available For Operations</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $today = new DateTime('today'); @endphp
                            @foreach($all_releases as $release)
                                <tr>
                                    <td>
                                        <div class="upcoming-games__info">
                                            <div class="upcoming-games__img">
                                                <img src="{{ \App\Helpers\PanelEntity::getEntityImage($release->entityData->ed_image, 168, 112, 6) }}" alt="{{$release->entityDataLang->edl_title}}">
                                            </div>
                                            <div class="upcoming-games__name text-18 font-bold">{{$release->entityDataLang->edl_title}}</div>
                                        </div>
                                    </td>
                                    <td>
                                        @if(new DateTime($release->entityData->ed_datetime_3) < $today)
                                            <a href="{{route('games.show', ['game' => $release->entity_id])}}?type=files" class="link">{{\Carbon\Carbon::parse($release->entityData->ed_datetime_3)->format('d.m.Y')}}</a>
                                        @else
                                            <div class="text-14 font-medium">{{\Carbon\Carbon::parse($release->entityData->ed_datetime_3)->format('d.m.Y')}}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if(new DateTime($release->entityData->ed_datetime_2) < $today)
                                            <a href="{{route('games.show', ['game' => $release->entity_id])}}" class="link">{{\Carbon\Carbon::parse($release->entityData->ed_datetime_2)->format('d.m.Y')}}</a>
                                        @else
                                            <div class="text-14 font-medium">{{\Carbon\Carbon::parse($release->entityData->ed_datetime_2)->format('d.m.Y')}}</div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="column sm-12 md-4">
                <div class="content-aside">
                    <div class="content-aside__thumb">
                        <div class="events-show single-datepicker">
                            <div class="events-show__calendar">
                                <div class="event-datepicker"></div>
                            </div>
                            <div class="events-show__info">
                                @php $tomorrow = new DateTime('tomorrow'); @endphp
                                <div class="events-block radius-md">
                                    <div class="events-block__title text-20 font-medium">
                                        {{$tomorrow->format('M')}} {{$tomorrow->format('jS')}}
                                    </div>
                                    <div class="events-block__list">
                                        @foreach($near_releases as $near_release)
                                        <div class="events-block__item">
                                            <div class="events-block__type type-pair">
                                                @if(new DateTime($near_release->entityData->ed_datetime_2) == $tomorrow)
                                                    <div class="type-dot type-dot_operators">
                                                        <span></span>
                                                    </div>
                                                    <span class="type-pair__name">For operators</span>
                                                @else
                                                    <div class="type-dot type-dot_testing">
                                                        <span></span>
                                                    </div>
                                                    <span class="type-pair__name">For testing</span>
                                                @endif
                                            </div>
                                            <div class="events-block__name font-semibold">{{$near_release->entityDataLang->edl_title}}</div>
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
    </div>
@endsection
