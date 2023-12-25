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
    <link rel="stylesheet" href="{{asset('assets/css/pages/support.css')}}">
    <!-- ========================== -->
@endsection

@section('content')
    @php
        $chat_notification_helper = new \App\Helpers\NotificationHelper(new \App\Services\ChatNotificationsService());
    @endphp
    <div class="content">
        <div class="row">
            <div class="column sm-12">
                <div class="content__body">
                    <div class="content__heading">
                        @php $new_messages_count = $chat_notification_helper->getNewMessagesCount(); @endphp
                        <h1 class="content__title h1-font">
                            Support Inbox
                            <span class="round-badge">{{$new_messages_count['messages']}}</span>
                        </h1>
                    </div>
                    <div class="support shadow-xs radius-md">
                        <div class="support__action">
                            <div class="support__btn">
                                <div class="btn btn_main btn_lg fit support-new-conversation"
                                     data-template='{{route('users.new-conversation')}}'>
                                    <i class="icon icon-dialog"></i>
                                    <span>New Conversation</span>
                                </div>
                            </div>
                            <div class="support__list support-list">
                                <div class="support-list__wrap">
                                    @php $loopQueue = 1; @endphp
                                    @foreach($chatsNotifications as $item)
                                        <div
                                        class="support-item {{($item['entity_type'] == 'chat' && $item['unseen_messages'] > 0) ? 'has-new-messages' : '' }} {{$item['entity_type'] != 'chat' ? 'support-item_notify' : '' }}"
                                            @if($item['entity_type'] == 'chat')data-id="{{$item['entity_id']}}" @endif>
                                            <div class="support-item__avatar">
                                                <div class="avatar">
                                                    @if($item['entity_type'] == 'notification')
                                                        <img src="{{asset('assets/img/draft/admin.jpg')}}" alt="avatar">
                                                    @else
                                                        <img src="{{asset('assets/img/draft/profile.jpg')}}" alt="avatar">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="support-item__date">
                                                {{\Carbon\Carbon::parse($item['entity_update_date'] ?? $item['entity_creation_date'])->format('M d Y')}} at
                                                {{\Carbon\Carbon::parse($item['entity_update_date'] ?? $item['entity_creation_date'])->format('H:i')}}
                                            </div>
                                            <div class="support-item__body">
                                                <!-- <div class="support-item__name">{{$item['entity_type'] == 'notification' ? 'Imagine live' : Auth::user()->name}}</div> -->
                                                <div class="support-item__title">
                                                    @if($item['entity_type'] == 'notification')
                                                        {{ $item['entity_data_lang']['edl_title'] }}
                                                    @else
                                                        {{ $item['entity_data']['ed_title'] }}
                                                    @endif
                                                </div>
                                                <div class="support-item__desc">
                                                    @if($item['entity_type'] == 'notification')
                                                        {{ $item['entity_data_lang']['edl_text_1'] }}
                                                    @else
                                                        {{ $item['entity_data']['ed_text_1'] }}
                                                    @endif
                                                </div>
                                                @if($item['entity_type'] == 'chat' && $item['unseen_messages'] > 0)
                                                    <span class="round-badge">{{$item['unseen_messages']}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        @php $loopQueue++; @endphp
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
                                    <div class="chat__body-wrap">
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
                                <form action="#" class="chat__form">
                                    <div class="shadow-xs radius-xxs">
                                        <div class="form-field form-field_textarea form-field_sm">
                                            <div class="form-field__target">
                                                <textarea name="message" class="form-field__input bg-transparent"
                                                          required="required"
                                                          placeholder="Write a message..."></textarea>
                                            </div>
                                        </div>
                                        <div class="chat__submit text-right">
                                            <button type="submit" class="btn btn_main btn_sm">
                                                <i class="icon icon-send"></i>
                                                <span>Send</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
    <script defer src="{{asset('assets/js/support.js')}}"></script>
@endsection
