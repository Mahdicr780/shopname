@extends('admin-monstar.layouts.master')
@section('title', 'همه دسترسی ها')
@section('content')
    <div class="main-content">
        <!-- Basic Form area Start -->
        <div class="container-fluid">
            <!-- Form row -->
            <div class="row">
                <div class="col-xl-4 col-12 box-margin height-card">
                    <div class="card card-body">
                        <h4 class="card-title"> ایجاد دسترسی جدید</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="{{ route('permissions.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <label for="exampleInputEmail111">نام دسترسی</label>
                                        <input type="text" class="form-control" id="exampleInputEmail111" value="{{ old('name') }}" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail111">توضیح دسترسی</label>
                                        <input type="text" class="form-control" id="exampleInputEmail111" value="{{ old('description') }}" name="description">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">ثبت</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-12 box-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-2">لیست دسترسی ها</h4>
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>نام دسترسی</th>
                                        <th>توضیح</th>
                                        <th>عملیات</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->description }}</td>
                                            <td class="d-flex">
                                                <form action="{{ route('permissions.destroy', ['permission' => $permission->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('آیا از حذف کاربر مورد نظر مطمعن هستید؟')"
                                                        class="btn btn-danger">حذف</button>
                                                </form>
                                                <a href="{{ route('permissions.edit', ['permission' => $permission->id]) }}"
                                                    class="btn btn-primary">ویرایش</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
        </div>
@endsection
