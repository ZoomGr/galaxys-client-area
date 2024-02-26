@extends('layouts.app')

@section('title')
    Notifications
@endsection

@section('keywords')
    notifications, user, information
@endsection

@section('description')
    User notifications
@endsection

@section('styles')
    <!-- Page Css -->
    <link rel="stylesheet" href="{{asset('assets/css/pages/support.css?') . filemtime('assets/css/pages/support.css')}}">
    <!-- ========================== -->
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="column sm-12">
                <div class="content__body">
                    <div class="content__heading">
                        <h1 class="content__title h1-font">
                            Notifications
                        </h1>
                    </div>
                    <div class="support shadow-xs radius-md">
                        <div class="support__action">
                            <div class="support__list support-list">
                                <div class="support-list__wrap">
                                    @foreach($notifications as $notification)
                                    <div class="support-item notifications active" data-id="{{$notification->entity_id}}">
                                        <div class="support-item__avatar">
                                            <div class="avatar">
                                                @if(isset($notification->entityData->ed_number_1) && $notification->entityData->ed_number_1 == 1)
                                                    <img src="{{asset('assets/img/info.svg')}}" alt="info">
                                                @else
                                                    <img src="{{asset('assets/img/warning.svg')}}" alt="warning">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="support-item__date">{{\Carbon\Carbon::parse($notification->entity_update_date ?? $notification->entity_creation_date)->format('M d Y')}} at
                                            {{\Carbon\Carbon::parse($notification->entity_update_date ?? $notification->entity_creation_date)->format('H:i')}}</div>
                                        <div class="support-item__body">
                                            <div class="support-item__title">{{ $notification->entityDataLang->edl_title }}</div>
                                            <div class="support-item__desc">{{ $notification->entityDataLang->edl_text_1 }}</div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="support__body">
                            <div class="chat">
                                <div class="chat__heading">
                                    <span>Subject: </span>
                                    <span class="chat__subject font-semibold"></span>
                                </div>
                                <div class="chat__body">
                                    <div class="chat__body-wrap notification-content">
                                        <!-- <div class="chat__message">
                                            <div class="message message_reply">
                                                <div class="message__info">
                                                    <div class="avatar avatar_sm">
                                                        <img src="assets/img/draft/profile.jpg" alt="avatar">
                                                    </div>
                                                </div>
                                                <div class="message__body">
                                                    <div class="message__item">
                                                        <div class="message__date">May 15 2023 at 11:26</div>
                                                        <div class="message__text">
                                                            Hello dear customer. We would like to inform you that live
                                                            gaming area will be
                                                            closed on May 16 .We’ll restart the very next day. For more
                                                            information please
                                                            visit support.imaginelive.com
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat__message text-right">
                                            <div class="message message_author">
                                                <div class="message__body">
                                                    <div class="message__item">
                                                        <div class="message__date">May 15 2023 at 11:26</div>
                                                        <div class="message__text">
                                                            Hello I would like to know the reason for the new Baccarat
                                                            game release delay?
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="message__info">
                                                    <div class="avatar avatar_sm">
                                                        <img src="assets/img/draft/profile.jpg" alt="avatar">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat__message">
                                            <div class="message message_reply">
                                                <div class="message__info">
                                                    <div class="avatar avatar_sm">
                                                        <img src="assets/img/draft/profile.jpg" alt="avatar">
                                                    </div>
                                                </div>
                                                <div class="message__body">
                                                    <div class="message__item">
                                                        <div class="message__date">May 15 2023 at 11:26</div>
                                                        <div class="message__text">
                                                            Hello dear customer. We would like to inform you that live
                                                            gaming area will be
                                                            closed on May 16 .We’ll restart the very next day. For more
                                                            information please
                                                            visit support.imaginelive.com
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat__message text-right">
                                            <div class="message message_author">
                                                <div class="message__body">
                                                    <div class="message__item">
                                                        <div class="message__date">May 15 2023 at 11:26</div>
                                                        <div class="message__text">
                                                            Hello I would like to know the reason for the new Baccarat
                                                            game release delay?
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="message__info">
                                                    <div class="avatar avatar_sm">
                                                        <img src="assets/img/draft/profile.jpg" alt="avatar">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat__message">
                                            <div class="message message_reply">
                                                <div class="message__info">
                                                    <div class="avatar avatar_sm">
                                                        <img src="assets/img/draft/profile.jpg" alt="avatar">
                                                    </div>
                                                </div>
                                                <div class="message__body">
                                                    <div class="message__item">
                                                        <div class="message__date">May 15 2023 at 11:26</div>
                                                        <div class="message__text">
                                                            Hello dear customer. We would like to inform you that live
                                                            gaming area will be
                                                            closed on May 16 .We’ll restart the very next day. For more
                                                            information please
                                                            visit support.imaginelive.com
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat__message text-right">
                                            <div class="message message_author">
                                                <div class="message__body">
                                                    <div class="message__item">
                                                        <div class="message__date">May 15 2023 at 11:26</div>
                                                        <div class="message__text">
                                                            Hello I would like to know the reason for the new Baccarat
                                                            game release delay?
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="message__info">
                                                    <div class="avatar avatar_sm">
                                                        <img src="assets/img/draft/profile.jpg" alt="avatar">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
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

@section('scripts')
    <script>
        const basePath = "{{ env('APP_URL') }}";
    </script>
    <script defer src="{{asset('assets/js/support.js?') . filemtime('assets/js/support.js')}}"></script>
@endsection
