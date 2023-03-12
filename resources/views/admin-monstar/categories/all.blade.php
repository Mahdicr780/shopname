@extends('admin-monstar.layouts.master')
@section('title', 'مدیریت دسته بندی')
@section('content')
    <div class="main-content">
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">لیست دسته بندی</h4>
                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>آیدی</th>
                                            <th>نام دسته بندی</th>
                                            {{-- <th>دسته بندی مادر</th> --}}
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->name }}</td>
                                                {{-- <td>{{ $category->child->name }}</td> --}}
                                                <td class="d-flex">
                                                    <form action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('آیا از حذف کاربر مورد نظر مطمعن هستید؟')"
                                                            class="btn btn-danger">حذف</button>
                                                    </form>
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
