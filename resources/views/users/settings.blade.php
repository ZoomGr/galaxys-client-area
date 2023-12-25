@extends('layouts.app')

@section('title') Account settings @endsection

@section('keywords') Account, settings @endsection

@section('description') Account settings for imaginelive @endsection

@section('styles')
    <!-- Page Css -->
    <link rel="stylesheet" href="{{asset('assets/css/pages/settings.css')}}">
    <!-- ========================== -->
@endsection

@section('content')
    <div class="content tabs">
        <div class="row">
            <div class="column sm-12">
                <div class="content__heading">
                    <h1 class="content__title h1-font">
                        Account settings
                    </h1>
                </div>
                <div class="action-bar tabs__control shadow-xs radius-xxs">
                    <div class="action-bar__tabs">
                        <div class="btn btn_sm tab active" data-tab="personal-details">
                            <span>Personal details</span>
                        </div>
                        <div class="btn btn_sm tab" data-tab="password-settings">
                            <span>Password settings</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column sm-12 md-9">
                <div class="content__body tabs__content">
                    <div id="personal-details" class="tab-content active">
                        <form action="{{route('users.change-settings')}}" method="post" class="form-wrap shadow-xs radius-xs" name="personal_details">
                            @csrf
                            @method('PUT')
                            <div class="form-wrap__title text-24 font-semibold color-black-80">
                                Personal Details
                            </div>
                            <div class="form-fields row">
                                <div class="column sm-12 md-6">
                                    <div class="form-field form-field_sm">
                                        <div class="form-field__label color-black-50">
                                            First Name
                                        </div>
                                        <div class="form-field__target">
                                            <input type="text" name="first_name" class="form-field__input"  value="{{ old('first_name') ?? Auth::user()->name }}" required="required">
                                        </div>
                                        @error('first_name')
                                            <span class="form-field__message error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column sm-12 md-6">
                                    <div class="form-field form-field_sm">
                                        <div class="form-field__label color-black-50">
                                            Last Name
                                        </div>
                                        <div class="form-field__target">
                                            <input type="text" name="last_name" class="form-field__input" required="required" value="{{ old('last_name') ?? Auth::user()->last_name }}">
                                        </div>
                                        @error('last_name')
                                            <span class="form-field__message error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-wrap__submit text-center">
                                <button type="submit" class="btn btn_main btn_sm">
                                    <span>Update details</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div id="password-settings" class="tab-content">
                        <form action="{{route('users.change-password')}}" method="post" class="form-wrap shadow-xs radius-xs with-validation" name="personal_details">
                            @csrf
                            @method('PUT')
                            <div class="form-wrap__title text-24 font-semibold color-black-80">
                                Change Password
                            </div>
                            <div class="form-fields row">
                                <div class="column sm-12">
                                    <div class="form-field form-field_sm">
                                        <div class="form-field__label color-black-50">
                                            Current Password
                                        </div>
                                        <div class="form-field__target form-field__target_suffix form-field__target_password">
                                            <div class="form-field__icon color-black-20 pass-visibility">
                                                <i class="icon icon-hidden"></i>
                                                <i class="icon icon-show"></i>
                                            </div>
                                            <input type="password" name="current_password" class="form-field__input" required="required">
                                        </div>
                                        @error('current_password')
                                            <span class="form-field__message error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column sm-12">
                                    <div class="form-field form-field_sm">
                                        <div class="form-field__label color-black-50">
                                            New Password
                                        </div>
                                        <div class="form-field__target form-field__target_suffix form-field__target_password">
                                            <div class="form-field__icon color-black-20 pass-visibility">
                                                <i class="icon icon-hidden"></i>
                                                <i class="icon icon-show"></i>
                                            </div>
                                            <input type="password" name="new_password" class="form-field__input" id="new-password" required="required">
                                        </div>
                                        @error('new_password')
                                            <span class="form-field__message error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column sm-12">
                                    <div class="form-field form-field_sm">
                                        <div class="form-field__label color-black-50">
                                            Retype New Password
                                        </div>
                                        <div class="form-field__target form-field__target_suffix form-field__target_password">
                                            <div class="form-field__icon color-black-20 pass-visibility">
                                                <i class="icon icon-hidden"></i>
                                                <i class="icon icon-show"></i>
                                            </div>
                                            <input type="password" name="repeat_password" class="form-field__input" id="retype-new-password" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-wrap__submit text-center">
                                <button type="submit" class="btn btn_main btn_sm">
                                    <span>Save changes</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="column sm-12 md-3">
                <div class="content-aside">
                    <div class="content-aside__thumb">
                        <div class="discover-block radius-xs">
                            <div class="discover-block__img">
                                <img src="{{asset('assets/img/draft/discover.jpg')}}" alt="discover">
                            </div>
                            <div class="discover-block__content">
                                <div class="discover-block__title text-24 font-bold color-white">
                                    Wild West Heat
                                </div>
                                <div class="discover-block__desc text-14 color-black-10">
                                    Following a previous collaboration with Armenia-based Peter & Sons and the
                                    Following a previous collaboration with Armenia-based Peter & Sons and the
                                </div>
                                <div class="discover-block__btn">
                                    <a href="#" class="btn btn_gradient btn_sm fit">
                                        <span>Discover</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
