@extends('admin-monstar.layouts.master')
@section('title', 'مدیریت سفارشات')
@section('content')
    <div class="main-content">
        <div class="data-table-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-2">لیست سفارشات</h4>
                                <a href="{{ route('products.create') }}" class="btn btn-success">افزودن محصول</a>
                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>آیدی سفارش</th>
                                            <th>نام کاربری</th>
                                            <th>وضعیت پرداخت</th>
                                            <th>وضعیت ارسال</th>
                                            <th>مبلغ سفارش</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->user->name }}</td>
                                                <td>
                                                    @if ($order->status == 'paid')
                                                       <span class="badge badge-success">پرداخت شده</span>
                                                    @else
                                                       <span class="badge badge-danger">پرداخت نشده</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($order->delivery == '0')
                                                       <span class="badge badge-danger">درحال پردازش</span>
                                                    @else
                                                       <span class="badge badge-success">تحویل شده</span>
                                                    @endif
                                                </td>
                                                <td>{{ $order->price }}</td>
                                                <td class="d-flex">
                                                    <form action="{{ route('orders.destroy', ['order' => $order->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('آیا از حذف سفارش مورد نظر مطمعن هستید؟')"
                                                            class="btn btn-danger">حذف</button>
                                                    </form>
                                                    <a href="{{ route('invoice.index' , $order->basket_id) }}"
                                                        class="btn btn-primary">نمایش فاکتور</a>
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
