@extends('layouts.app')
@section('title', 'ریست رمز عبور')
@section('content')
    <div class="card">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="xs-d-none mb-50-xs break-320-576-none">
                        <img src="/admin/img/bg-img/1.png" alt="">
                    </div>
                </div>

                <div class="col-md-6">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4 class="font-18 mb-30">فراموشی رمز عبور؟</h4>

                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="lock-text text-dark">ایمیل یا شماره تماس</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button class="btn btn-primary btn-block" type="submit">ارسال رمز عبور</button>
                        </div>
                        <p class="text-center mt-20">لورم ایپسوم متن ساختگی با تولید سادگی </p>
                        <div class="row mt-15">
                            <div class="col-12">
                                <p class="text-center text-dark font-weight-bold">ورود با</p>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-googleplus waves-effect waves-light mb-2 btn-block"><i
                                        class="fa fa-google mr-2"></i><span class="text-center">گوگل</span></a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-facebook waves-effect waves-light mb-2 btn-block"><i
                                        class="fa fa-facebook mr-2"></i><span class="text-center">فیسبوک</span></a>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
