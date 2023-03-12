@extends('admin-monstar.layouts.master')
@section('title', 'مدیریت نظرات')
@section('content')
    <div class="main-content">
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">لیست نظرات</h4>
                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>آیدی نظر</th>
                                            <th>مربوط به</th>
                                            <th>نام نظر دهنده</th>
                                            <th>متن نظر</th>
                                            <th>وضعیت</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($comments as $comment)
                                            <tr>
                                                <td>{{ $comment->id }}</td>
                                                <td>
                                                    @if ($comment->commenttable_type == "App\Models\Product")
                                                        محصولات
                                                    @endif
                                                </td>
                                                <td>{{ $comment->user->name }}</td>
                                                <td>{{ $comment->text }}</td>
                                                <td>
                                                    @if ($comment->approved == 1)
                                                      <span class="badge-success badge">تایید شده</span>
                                                    @else
                                                      <span class="badge-danger badge">تایید نشده</span>
                                                    @endif
                                                </td>
                                                <td class="d-flex">
                                                    <form action="{{ route('comments.destroy', ['comment' => $comment->id]) }}"
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
