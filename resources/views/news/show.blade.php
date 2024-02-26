@extends('layouts.app')

@section('title') {{ $news->entitySeo->es_title ?? $news->entityDataLang->edl_title }} @endsection

@section('keywords') {{ $news->entitySeo->es_keywords ?? ''}} @endsection

@section('description') {{ $news->entitySeo->es_description ?? ''}} @endsection

@section('styles')
    <!-- Page Css -->
    <link rel="stylesheet" href="{{asset('assets/css/pages/inner.css?'). filemtime('assets/css/pages/inner.css')}}">
    <!-- ========================== -->
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="column sm-12">
                <div class="content__body">
                    <div class="content__heading">
                        <div class="inner-heading">
                            <a href="{{route('news.index')}}" class="inner-heading__icon">
                                <i class="icon icon-arrow-left"></i>
                            </a>
                            <div class="inner-heading__text">
                                <a href="{{route('news.index')}}" class="inner-heading__title title">
                                    {{$news->entityDataLang->edl_title}}
                                </a>
                                <div class="inner-heading__date font-semibold color-black-50">
                                    {{\Carbon\Carbon::parse($news->entityData->ed_datetime_1)->format('d.m.Y H:i')}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="inner-block shadow-xs radius-md">
                        <div class="inner-block__body">
                            <div class="inner-block__img radius-xs">
                                <img src="{{ \App\Helpers\PanelEntity::getEntityImage($news->entityData->ed_image, 751, 383, 6) }}" alt="{{$news->entityDataLang->edl_title}}">
                            </div>
                            <div class="inner-block__details">
                                <div class="inner-block__details-item">
                                    {!! $news->entityDataLang->edl_text_1 !!}
                                </div>
                                <div class="inner-block__details-item">
                                    <div class="tags">
                                        <div class="tags__wrap">
                                            @foreach($tags as $tag)
                                                <div class="tag">{{$tag->entityDataLang->edl_title}}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="inner-block__action">
                            <div class="explore-block">
                                <div class="explore-block__img">
                                    @if(!empty($news->entityData->ed_char_1))
                                        <img src="{{ \App\Helpers\PanelEntity::getEntityImage($news->entityData->ed_char_1, 424, 212, 6) }}" alt="explore">
                                    @endif
                                </div>
                                <div class="explore-block__title text-24 font-bold text-center">
                                    {{$news->entityDataLang->edl_char_2}}
                                </div>
                                <!-- <div class="explore-block__info">
                                    <div class="explore-block__item font-semibold">
                                        <div>RTP</div>
                                        <div>96%,95%</div>
                                    </div>
                                    <div class="explore-block__item font-semibold">
                                        <div>Category</div>
                                        <div>Slots</div>
                                    </div>
                                    <div class="explore-block__item font-semibold">
                                        <div>Advantages</div>
                                        <div class="explore-block__advantages advantages radius-xxs">
                                            <div class="advantages__item">
                                                <div class="text-14 font-medium">Bonuses</div>
                                                <div class="text-14 font-medium"><i class="icon icon-checkmark"></i></div>
                                            </div>
                                            <div class="advantages__item">
                                                <div class="text-14 font-medium">Accessibility</div>
                                                <div class="text-14 font-medium"><i class="icon icon-checkmark"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                @if(!empty($news->entityDataLang->edl_char_3))
                                    <div class="explore-block__btns">
                                        <a href="{{$news->entityDataLang->edl_char_3}}" class="btn btn_gradient btn_sm fit">
                                            <span>Explore More</span>
                                        </a>
                                    </div>
                                @endif
                                <!-- <div class="explore-block__btns">
                                    <a href="#" class="btn btn_main-border btn_sm">
                                        <span>See More</span>
                                    </a>
                                    <a href="#" class="btn btn_gradient btn_sm">
                                        <i class="icon icon-play"></i>
                                        <span>Try Demo</span>
                                    </a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
