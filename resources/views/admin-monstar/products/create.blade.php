@extends('admin-monstar.layouts.master')
@section('title', 'ایجاد محصول جدید')
@section('content')
    <div class="main-content">
        <!-- Basic Form area Start -->
        <div class="container-fluid">
            <!-- Form row -->
            <div class="row">
                <div class="col-xl-6 box-margin height-card">
                    <div class="card card-body">
                        <h4 class="card-title">فرم ایجاد محصول</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <label for="exampleInputEmail111">نام محصول</label>
                                        <input type="text" class="form-control" id="exampleInputEmail111" value="{{ old('title') }}" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail111">متن محصول</label>
                                        <textarea type="text" class="form-control" id="exampleInputEmail111" name="text"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail111">دسته بندی محصول</label>
                                        <select name="categories[]" class="form-control" id="categories" multiple>
                                        @foreach ($categories as $category)
                                           <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail111">قیمت محصول</label>
                                        <input type="text" class="form-control" id="exampleInputEmail111" value="{{ old('price') }}" name="price">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail111">موجودی محصول</label>
                                        <input type="text" class="form-control" id="exampleInputEmail111" value="{{ old('amount') }}" name="amount">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail111">متا تایتل</label>
                                        <input type="text" class="form-control" id="exampleInputEmail111" value="{{ old('metaTitle') }}" name="metaTitle">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail111">متا دیسکریپشن</label>
                                        <input type="text" class="form-control" id="exampleInputEmail111" value="{{ old('metaDescription') }}" name="metaDescription">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail111">تصویر محصول</label>
                                        <input type="file" class="form-control" id="exampleInputEmail111" name="image">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">ثبت محصول جدید</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
