@extends('admin-monstar.layouts.master')
@section('title', 'نمایش فاکتور')
@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 box-margin">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive mb-4">
                                <table class="table m-0">
                                    @if (isset($isDelivered))
                                    <form action="{{ route('status.invoice', $basket_id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-danger">ارسال شد</button>
                                    </form>
                                    @endif
                                    <thead>
                                        <tr>
                                            <th class="py-3">
                                                نام محصول
                                            </th>
                                            <th class="py-3">
                                                تعداد
                                            </th>
                                            <th class="py-3">
                                                مبلغ محصول
                                            </th>
                                            <th class="py-3">
                                                مبلغ کل
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td class="py-3">
                                                    {{ $product->product->title }}
                                                </td>
                                                <td class="py-3">
                                                    @if ($product->quantity == null)
                                                        1
                                                    @else
                                                        {{ $product->quantity }}
                                                    @endif
                                                </td>
                                                <td class="py-3">
                                                    {{ number_format($product->product->price) }}
                                                </td>
                                                <td class="py-3">
                                                    @if ($product->quantity == null)
                                                        {{ number_format($product->product->price) }}
                                                    @else
                                                        {{ number_format($product->quantity * $product->product->price) }}
                                                    @endif
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
    </div>
@endsection
