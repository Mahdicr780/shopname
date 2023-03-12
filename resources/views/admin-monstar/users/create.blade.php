@extends('admin-monstar.layouts.master')
@section('title', 'ایجاد کاربر')
@section('content')
    <div class="main-content">
        <!-- Basic Form area Start -->
        <div class="container-fluid">
            <!-- Form row -->
            <div class="row">
                <div class="col-xl-6 box-margin height-card">
                    <div class="card card-body">
                        <h4 class="card-title">فرم ایجاد کاربر</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="{{ route('users.store') }}" method="POST">
                                    @csrf
                                    @if ($errors->any())
                                        <div class="col-md-12">
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="exampleInputEmail111">نام</label>
                                        <input type="text" class="form-control" id="exampleInputEmail111" name="name"
                                            placeholder="نام">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail12">آدرس ایمیل</label>
                                        <input type="email" class="form-control" name="email" id="exampleInputEmail12"
                                            placeholder="ایمیل">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword11">کلمه عبور</label>
                                        <input type="password" class="form-control" name="password" id="exampleInputPassword11"
                                            placeholder="رمز عبور">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword12">تکرار کلمه عبور</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="exampleInputPassword12"
                                            placeholder="تکرار رمز عبور">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">ثبت کاربر</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
