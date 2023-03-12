@extends('layouts.master')
@section('title', 'سبد خرید')
@section('content')
    <main class="cart-page default">
        <div class="container">
            <div class="row">
                <div class="cart-page-content col-xl-9 col-lg-8 col-md-12 order-1">
                    <div class="cart-page-title">
                        <h1>سبد خرید</h1>
                    </div>
                    <div class="table-responsive checkout-content default">
                        <table class="table">
                            <tbody>
                                @php
                                    $sumPrice = 0;
                                @endphp
                                @foreach ($products as $product)
                                    @php
                                        $productAdded = DB::table('products')
                                            ->where('id', $product->product_id)
                                            ->first();
                                            $isBasket = $product->basket_id;
                                            $isBasket = DB::table('baskets')->where('id',$isBasket)->where('isActive',1)->first();
                                    @endphp
                                    @if (isset($isBasket))
                                    <tr class="checkout-item">
                                        @php
                                            $sumPrice += $product->quantity == null || $product->quantity == 1 ? $productAdded->price : $product->quantity * $productAdded->price;
                                        @endphp
                                        <td>
                                            <img src="{{ $productAdded->image }}" alt="">
                                            <form action="{{ route('cart.destroy', $product->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="checkout-btn-remove"></button>
                                            </form>
                                        </td>
                                        <td>
                                            <h3 class="checkout-title">
                                                {{ $productAdded->title }}
                                            </h3>
                                        </td>
                                        <td>{{ $product->quantity }} عدد</td>
                                        <td>{{ $product->quantity == null || $product->quantity == 1 ? number_format($productAdded->price) : number_format($product->quantity * $productAdded->price) }}
                                            تومان</td>
                                    </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <aside class="cart-page-aside col-xl-3 col-lg-4 col-md-6 center-section order-2">
                    <div class="checkout-aside">
                        <div class="checkout-summary">
                            <div class="checkout-summary-main">
                                <ul class="checkout-summary-summary">
                                    <li><span>مبلغ کل (۱ کالا)</span><span>{{ number_format($sumPrice) }} تومان</span></li>
                                    <li>
                                        <span>هزینه ارسال</span>
                                        <span>وابسته به آدرس<span class="wiki wiki-holder"><span class="wiki-sign"></span>
                                                <div class="wiki-container js-dk-wiki is-right">
                                                    <div class="wiki-arrow"></div>
                                                    <p class="wiki-text">
                                                        هزینه ارسال مرسولات می‌تواند وابسته به شهر و آدرس گیرنده
                                                        متفاوت باشد. در
                                                        صورتی که هر
                                                        یک از مرسولات حداقل ارزشی برابر با ۱۰۰هزار تومان داشته باشد،
                                                        آن مرسوله
                                                        بصورت رایگان
                                                        ارسال می‌شود.<br>
                                                        "حداقل ارزش هر مرسوله برای ارسال رایگان، می تواند متغیر
                                                        باشد."
                                                    </p>
                                                </div>
                                            </span></span>
                                    </li>
                                </ul>
                                <div class="checkout-summary-devider">
                                    <div></div>
                                </div>
                                <div class="checkout-summary-content">
                                    <div class="checkout-summary-price-title">مبلغ قابل پرداخت:</div>
                                    <div class="checkout-summary-price-value">
                                        <span
                                            class="checkout-summary-price-value-amount">{{ number_format($sumPrice) }}</span>تومان
                                    </div>
                                    @php
                                        use Illuminate\Support\Facades\DB;
                                        $basket = DB::table('baskets')
                                            ->where('user_id', auth()->user()->id)
                                            ->where('isActive', '=', 1)
                                            ->first();
                                        if (isset($basket)){
                                    @endphp
                                    <a href="{{ route('payment.product', $basket->id) }}"
                                        class="selenium-next-step-shipping">
                                        @php
                                       }else{
                                        @endphp
                                        <a href="#"
                                        class="selenium-next-step-shipping">
                                        @php
                                        }
                                        @endphp
                                        <div class="parent-btn">
                                            <button class="dk-btn dk-btn-info">
                                                پرداخت سفارش
                                                <i class="now-ui-icons shopping_basket"></i>
                                            </button>
                                        </div>
                                    </a>
                                    <div>
                                        <span>
                                            کالاهای موجود در سبد شما ثبت و رزرو نشده‌اند، برای ثبت سفارش مراحل بعدی
                                            را تکمیل
                                            کنید.
                                        </span>
                                        <span class="wiki wiki-holder"><span class="wiki-sign"></span>
                                            <div class="wiki-container is-right">
                                                <div class="wiki-arrow"></div>
                                                <p class="wiki-text">
                                                    محصولات موجود در سبد خرید شما تنها در صورت ثبت و پرداخت سفارش
                                                    برای شما رزرو
                                                    می‌شوند. در
                                                    صورت عدم ثبت سفارش، تاپ کالا هیچگونه مسئولیتی در قبال تغییر
                                                    قیمت یا موجودی
                                                    این کالاها
                                                    ندارد.
                                                </p>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="checkout-feature-aside">
                            <ul>
                                <li class="checkout-feature-aside-item checkout-feature-aside-item-guarantee">
                                    هفت روز
                                    ضمانت تعویض
                                </li>
                                <li class="checkout-feature-aside-item checkout-feature-aside-item-cash">
                                    پرداخت در محل با
                                    کارت بانکی
                                </li>
                                <li class="checkout-feature-aside-item checkout-feature-aside-item-express">
                                    تحویل اکسپرس
                                </li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>
@endsection
