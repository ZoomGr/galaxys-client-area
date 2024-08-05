@extends('layouts.app')

@section('title') Sign In @endsection

@section('keywords') sign in, login, digitain, client, area @endsection

@section('description') Login to client area @endsection

@section('styles')
    <!-- Page Css -->
    <link rel="stylesheet" href="{{asset('assets/css/pages/login.css')}}">
    <!-- ========================== -->
@endsection

@section('content')
    <div class="content">
        <div class="row align-center">
            <div class="column sm-12 md-10 lg-5">
                <div class="content__body">
                    <div class="sign-up-container">
                        <div class="sign-up-logo main-logo">
                            <a href="{{route('login')}}">
                                <img src="{{asset('assets/img/theme/logo-dark.svg')}}" alt="logo">
                            </a>
                        </div>
                        <form method="POST" action="{{ route('login') }}" class="sign-up shadow-xs radius-md">
                            @csrf
                            <div class="round-badge sign-up__icon">
                                <i class="icon icon-profile"></i>
                            </div>
                            <div class="sign-up__title">
                                Log In
                            </div>
                            <div class="sign-up__desc">
                                Please Log in, before using Client Area
                            </div>
                            <div class="form-fields row">
                                <div class="column sm-12">
                                    <div class="form-field form-field_sm">
                                        <div class="form-field__label color-black-50">
                                            Email
                                        </div>
                                        <div class="form-field__target">
                                            <input type="email" name="email" class="form-field__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" required="required">
                                        </div>
                                        @error('email')
                                            <span class="form-field__message error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column sm-12">
                                    <div class="form-field form-field_sm">
                                        <div class="form-field__label color-black-50">
                                            Password
                                        </div>
                                        <div class="form-field__target form-field__target_suffix form-field__target_password">
                                            <div class="form-field__icon color-black-20 pass-visibility">
                                                <i class="icon icon-hidden"></i>
                                                <i class="icon icon-show"></i>
                                            </div>
                                            <input type="password" name="password" class="form-field__input @error('password') is-invalid @enderror" name="password" required="required">
                                        </div>
                                        @error('password')
                                            <span class="form-field__message error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
{{--                                        <div class="form-field__link text-right">--}}
{{--                                            <a href="#">--}}
{{--                                                Forgot password?--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="sign-up__btn">
                                <button type="submit" class="btn btn_main btn_sm fit">
                                    <span>Log In</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
