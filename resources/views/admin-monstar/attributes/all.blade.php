@extends('admin-monstar.layouts.master')
@section('title', 'مدیریت ویژگی ها')
@section('content')
    <div class="main-content">
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">لیست ویژگی</h4>
                                <a href="{{ route('products.create') }}" class="btn btn-success">افزودن محصول</a>
                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>آیدی ویژگی</th>
                                            <th>نام ویژگی</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($attributes as $attribute)
                                            <tr>
                                                <td>{{ $attribute->id }}</td>
                                                <td>{{ $attribute->name }}</td>
                                                <td class="d-flex">
                                                    <form
                                                        action="{{ route('attributes.destroy', ['attribute' => $attribute->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('آیا از حذف کاربر مورد نظر مطمعن هستید؟')"
                                                            class="btn btn-danger">حذف</button>
                                                    </form>
                                                    <a href="{{ route('attributes.edit', ['attribute' => $attribute->id]) }}"
                                                        class="btn btn-primary">ویرایش</a>
                                                    <a href="{{ route('attribute.get.values', ['attribute' => $attribute->id]) }}"
                                                        class="btn btn-success">افزودن مقدار</a>
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
