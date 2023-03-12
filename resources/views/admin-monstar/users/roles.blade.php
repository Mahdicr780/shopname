@extends('admin-monstar.layouts.master')
@section('title', 'ایجاد دسترسی برای کاربر')
@section('content')
    <div class="main-content">
        <!-- Basic Form area Start -->
        <div class="container-fluid">
            <!-- Form row -->
            <div class="row">
                <div class="col-xl-6 box-margin height-card">
                    <div class="card card-body">
                        <h4 class="card-title">ایجاد دسترسی برای کاربر</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="{{ route('users.role.update',['user' => $user->id]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
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
                                        <label for="exampleInputEmail111">انتخاب مجوز</label>
                                        <select name="roles[]" id="" class="form-control" multiple="multiple">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ in_array($role->id,$role->permissions()->pluck('id')->toArray())? 'selected': '' }}>
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">ایجاد</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 @endsection
