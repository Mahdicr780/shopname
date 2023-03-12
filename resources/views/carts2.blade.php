@extends('layouts.master')
@section('title', 'سبد خرید')
@section('content')
    <main class="cart default">
        <div class="container text-center">
            <div class="cart-empty">
                <div class="cart-empty-icon">
                    <i class="now-ui-icons shopping_basket"></i>
                </div>
                <div class="cart-empty-title">سبد خرید شما خالیست!</div>
                @auth
                    <div class="parent-btn">
                        <a href="#" class="dk-btn dk-btn-success">
                            ورود به صفحه اصلی
                            <i class="fa fa-sign-in"></i>
                        </a>
                    </div>
                @else
                    <div class="parent-btn">
                        <a href="#" class="dk-btn dk-btn-success">
                            به حساب کاربری خود وارد شوید
                            <i class="fa fa-sign-in"></i>
                        </a>
                    </div>
                    <div class="cart-empty-url">
                        <span>کاربر جدید هستید؟</span>
                        <a href="#">ثبت‌نام در تاپ کالا</a>
                    </div>
                @endauth
            </div>
        </div>
    </main>
    <!-- main -->
@endsection
