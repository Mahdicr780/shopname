@extends('admin-monstar.layouts.master')
@section('title', 'افزودن مقدار برای ویژگی')
@section('content')
    <div class="main-content">
        <!-- Basic Form area Start -->
        <div class="container-fluid">
            <!-- Form row -->
            <div class="row">
                <div class="col-xl-6 box-margin height-card">
                    <div class="card card-body">
                        <h4 class="card-title"> افزودن مقدار برای ویژگی{{ $attribute->name }}</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="{{ route('attribute.post.values') }}" method="POST">
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
                                        <label for="exampleInputEmail111">نام مقدار</label>
                                        <input type="text" class="form-control" id="exampleInputEmail111" value="{{ old('value') }}" name="value">
                                    </div>
                                    <input type="hidden" name="attribute_id" value="{{ $attribute->id }}">
                                    <button type="submit" class="btn btn-primary mr-2">ثبت مقدار جدید</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 box-margin height-card">
                    <div class="card card-body">
                        <h4 class="card-title"> لیست مقدار برای ویژگی{{ $attribute->name }}</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>آیدی مقدار</th>
                                            <th>نام مقدار</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($values as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->value }}</td>
                                                <td class="d-flex">
                                                    <form
                                                        action="{{ route('attributes.destroy', ['attribute' => $value->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('آیا از حذف کاربر مورد نظر مطمعن هستید؟')"
                                                            class="btn btn-danger">حذف</button>
                                                    </form>
                                                    <a href="{{ route('', ['value' => $value->id]) }}"
                                                        class="btn btn-primary">ویرایش</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
