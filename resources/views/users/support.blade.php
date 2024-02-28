@extends('layouts.app')

@section('title')
    Supports
@endsection

@section('keywords')
    supports, user, chat
@endsection

@section('description')
    User supports
@endsection

@section('styles')
    <!-- Page Css -->
    <link rel="stylesheet" href="{{asset('assets/css/pages/support.css?') . filemtime('assets/css/pages/support.css')}}">
    <!-- ========================== -->
@endsection
@section('content')
    <div class="content">
        @php
            $chat_notification_helper = new \App\Helpers\NotificationHelper(new \App\Services\ChatNotificationsService());
        @endphp
        <div class="row">
            <div class="column sm-12">
                <div class="content__body">
                    <div class="content__heading">
                        @php $new_messages_count = $chat_notification_helper->getNewMessagesCount(); @endphp
                        <h1 class="content__title h1-font">
                            Support Inbox
                            <span class="new-messages-count round-badge {{$new_messages_count['messages'] == 0 ? 'dn' : ''}}">{{$new_messages_count['messages']}}</span>                        </h1>
                        </h1>
                    </div>
                    <div class="support shadow-xs radius-md">
                        <div class="support__action">
                            <div class="support__btn">
                                <div class="btn btn_main btn_lg fit support-new-conversation">
                                    <i class="icon icon-dialog"></i>
                                    <span>New Conversation</span>
                                </div>
                            </div>
                            <div class="support__list support-list">
                                <div class="support-list__wrap">
                                    @foreach($userChats as $chat)
                                        <div class="support-item active {{$chat['unseen_messages'] > 0 ? 'has-new-messages' : '' }}" data-id="{{$chat['entity_id']}}">
                                            <div class="support-item__avatar">
                                                <div class="avatar">
                                                    <img src="{{asset('assets/img/draft/profile.jpg')}}" alt="avatar">
                                                </div>
                                            </div>
                                            <div class="support-item__date">{{\Carbon\Carbon::parse($chat['entity_update_date'] ?? $chat['entity_creation_date'])->format('M d Y')}} at
                                                    {{\Carbon\Carbon::parse($chat['entity_update_date'] ?? $chat['entity_creation_date'])->format('H:i')}}</div>
                                            <div class="support-item__body">
                                                <div class="support-item__title">{{ $chat['entity_data']['ed_title'] }}
                                                </div>
                                                <div class="support-item__desc">{{ $chat['entity_data']['ed_text_1'] }}</div>
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
                                    <div class="chat__body-wrap"></div>
                                </div>
                                <form action="{{route('users.add-chat-message')}}" class="chat__form" method="POST">
                                    @csrf
                                    <input type="hidden" name="chat_id" value="{{$userChats[0]['entity_id']}}" autocomplete="off">
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
                            <div class="new-conversation hide">
                                <div class="new-conversation__icon round-badge">
                                    <i class="icon icon-message"></i>
                                </div>
                                <div class="new-conversation__title">
                                    New Conversation
                                </div>
                                <div class="new-conversation__desc">
                                    Dear customer, please note that response
                                    to your request may take up to three buisness days.
                                </div>
                                <form action="{{route('users.add-conversation')}}" method="POST" class="new-conversation__form shadow-xs radius-xxs">
                                    @csrf
                                    <div class="form-fields row">
                                        <div class="column sm-12">
                                            <div class="form-field form-field_sm">
                                                <div class="form-field__target form-field__target_prefix">
                                                    <div class="form-field__icon color-black-20">
                                                        <i class="icon icon-notebook"></i>
                                                    </div>
                                                    <input type="text" name="subject" class="form-field__input" required="required" placeholder="Subject...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="column sm-12">
                                            <div class="form-field form-field_textarea form-field_sm">
                                                <div class="form-field__target">
                                                    <textarea name="message" class="form-field__input" required="required" placeholder="Write a message..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="new-conversation__submit text-right">
                                        <button type="submit" class="btn btn_main btn_sm">
                                            <i class="icon icon-send"></i>
                                            <span>Send</span>
                                        </button>
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
    <script defer src="{{asset('assets/js/support.js?') . filemtime('assets/js/support.js')}}"></script>
@endsection
