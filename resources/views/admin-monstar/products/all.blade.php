@extends('admin-monstar.layouts.master')
@section('title', 'مدیریت محصولات')
@section('content')
    <div class="main-content">
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">لیست محصولات</h4>
                                <a href="{{ route('products.create') }}" class="btn btn-success">افزودن محصول</a>
                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>آیدی محصول</th>
                                            <th>نام محصول</th>
                                            <th>موجودی</th>
                                            <th>تعداد بازدید</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($product as $pro)
                                            <tr>
                                                <td>{{ $pro->id }}</td>
                                                <td>{{ $pro->title }}</td>
                                                <td>{{ $pro->amount }}</td>
                                                <td>{{ $pro->view }}</td>
                                                <td class="d-flex">
                                                    <form action="{{ route('products.destroy', ['product' => $pro->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('آیا از حذف کاربر مورد نظر مطمعن هستید؟')"
                                                            class="btn btn-danger">حذف</button>
                                                    </form>
                                                    <a href="{{ route('products.edit', ['product' => $pro->id]) }}"
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
                <!-- end row-->
            </div>
        </div>
    </div>
@endsection
