@extends('frontend.layouts.master')

@section('content')
    <section class="wsus__breadcrumb" style="background: url(images/breadcrumb_bg.jpg);">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Shopping Cart</h1>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li>Shopping Cart</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="wsus__cart_view mt_120 xs_mt_100 pb_120 xs_pb_100">
        @if (count($cart) > 0)
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="cart_list">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="pro_img">Product</th>
                                            <th class="pro_name"></th>
                                            <th class="pro_tk">Price</th>
                                            <th class="pro_icon">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($cart as $item)
                                            <tr>
                                                <td class="pro_img">
                                                    <img src="{{ asset($item->course->thumbnail) }}" alt="product"
                                                        class="img-fluid w-100">
                                                </td>

                                                <td class="pro_name">
                                                    <a
                                                        href="{{ route('courses.show', $item->course->slug) }}">{{ $item->course->title }}</a>
                                                </td>
                                                <td class="pro_tk">
                                                    @if ($item->course->discount > 0)
                                                        <h6>
                                                            <del>
                                                                <h6>${{ $item->course->price }}</h6>
                                                            </del> ${{ $item->course->discount }}
                                                        </h6>
                                                    @else
                                                        <h6>${{ $item->course->price }}</h6>
                                                    @endif
                                                </td>

                                                <td class="pro_icon">
                                                    <a href="{{ route('remove-from-cart', $item->id) }}"><i
                                                            class="fal fa-times" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                            <td>
                                            @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-xxl-7 col-md-5 col-lg-6 wow fadeInUp"
                        style="visibility: visible; animation-name: fadeInUp;">
                        <div class="continue_shopping">
                            <a href="#" class="common_btn">continue shopping</a>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-7 col-lg-6 wow fadeInUp"
                        style="visibility: visible; animation-name: fadeInUp;">
                        <div class="total_price">
                            <div class="subtotal_area total_payment_price">
                                <h4>Cart</h4>
                                <ul>
                                    <li>Selected courses: <span>{{ cartTotalItems() }}</span></li>
                                    <li>Subtotal: <span>${{ cartTotalNoDiscount() }}</span></li>
                                    <li>Discount :<span>${{ totalDiscount() }}</span></li>
                                </ul>
                                <hr>
                                <h5>Total<span>${{ cartTotal() }}</span></h5>
                                <a href="{{ route('checkout.index') }}" class="common_btn">proceed checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="container text-center">
                <img src="{{ asset('default_files/empty_cart.png') }}" alt="cart is empty" class="img-fluid"
                    style="width: 180px !important">
                <h5>No items in cart.</h5>
                <div class="col-xxl-7 col-md-5 col-lg-6 wow fadeInUp"
                    style="visibility: visible; animation-name: fadeInUp;">
                    <div class="continue_shopping">
                        <a href="#" class="common_btn">continue shopping</a>
                    </div>
                </div>
            </div>
        @endif

    </section>
@endsection
