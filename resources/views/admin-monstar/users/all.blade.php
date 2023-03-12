@extends('admin-monstar.layouts.master')
@section('title', 'مدریت کاربران')
@section('content')
    <div class="main-content">
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">لیست کاربران</h4>
                                <a href="{{ route('users.create') }}" class="btn btn-success">افزودن کاربر</a>
                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>نام</th>
                                            <th>ایمیل</th>
                                            <th>وضعیت ایمیل</th>
                                            <th>نقش کاربری</th>
                                            <th>شماره موبایل</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($user as $us)
                                            <tr>
                                                <td>{{$us->name}}</td>
                                                <td>{{$us->email}}</td>
                                                <td>
                                                    @if ($us->email_verified_at)
                                                    <span class="badge badge-success">فعال</span>
                                                    @else
                                                    <span class="badge badge-danger">غیرفعال</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($us->is_admin)
                                                    <span>مدیر</span>
                                                    @elseif ($us->is_operator)
                                                    <span>اپراتور</span>
                                                    @else
                                                    <span>کاربر عادی</span>
                                                    @endif
                                                </td>
                                                <td>{{$us->phone_number}}</td>
                                                <td class="d-flex">
                                                    <form action="{{ route('users.destroy',['user' => $us->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('آیا از حذف کاربر مورد نظر مطمعن هستید؟')" class="btn btn-danger">حذف</button>
                                                    </form>
                                                    <a href="{{ route('users.edit',['user' => $us->id]) }}" class="btn btn-primary">ویرایش</a>
                                                    <a href="{{ route('users.role',['user' => $us->id]) }}" class="btn btn-success">دسترسی</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->
            </div>
        </div>
    </div>
@endsection
