@extends('frontend.layouts.master')

@section('content')
    <section class="wsus__breadcrumb" style="background: url({{ asset(config('settings.site_breadcrumb')) }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Checkout</h1>
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li>Checkout</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="payment pt_95 xs_pt_75 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7 wow fadeInUp">
                    <h3 class="payment_title text-center">Select Payment Method</h3>
                    <div class="payment_area">
                        <div class="row">
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp">
                                <a href=" {{ route('paypal.payment') }} " class="payment_mathod">
                                    <img src="{{ asset('default_files/logo_paypal.png') }}" alt="paypal"
                                        class="img-fluid w-100" style="object-fit:contain !important;">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp">
                                <a href="{{ route('stripe.payment') }}" class="payment_mathod">
                                    <img src="{{ asset('default_files/logo_stripe.png') }}" alt="stripe"
                                        class="img-fluid w-100" style="object-fit:contain !important;">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp">
                                <a href="{{ route('nordea.payment') }}" class="payment_mathod">
                                    <img src="{{ asset('default_files/logo_nordea.png') }}" alt="nordea"
                                        class="img-fluid w-100" style="object-fit:contain !important;">
                                </a>
                            </div>
                            <div class="col-xl-3 col-6 col-md-4 wow fadeInUp">
                                <a href="{{ route('razorpay.redirect') }}" class="payment_mathod">
                                    <img src="{{ asset('default_files/logo_razorpay.png') }}" alt="razorpay"
                                        class="img-fluid w-100 " style="object-fit:contain !important;">
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 wow fadeInUp">
                    <div class="total_payment_price">
                        <h4>Cart Total</h4>
                        <ul>
                            <li>Selected courses: <span>{{ cartTotalItems() }}</span></li>
                            <li>Subtotal: <span>${{ cartTotalNoDiscount() }}</span></li>
                            <li>Discount :<span>${{ totalDiscount() }}</span></li>
                        </ul>
                        <hr>
                        <h4>
                            Total: <span>${{ cartTotal() }}</span>
                        </h4>
                        {{-- <a href="#" class="common_btn">now payment</a> --}}
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. In sint laboriosam doloribus soluta
                            labore veniam enim deleniti necessitatibus modi. Velit odit sed assumenda eligendi
                            laboriosam.</p>

                        <ul class="modal_iteam">
                            <li>One popular belief, Lorem Ipsum is not simply random.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                            <li>To popular belief, Lorem Ipsum is not simply random.</li>
                        </ul>

                        <form class="modal_form">
                            <div class="single_form">
                                <label>Enter Something</label>
                                <input type="text" placeholder="Enter Something">
                            </div>
                            <div class="single_form">
                                <label>Enter Something</label>
                                <textarea rows="4" placeholder="Enter Something"></textarea>
                            </div>
                            <div class="single_form">
                                <label>select Something</label>
                                <select class="select_js">
                                    <option value="">Select Something</option>
                                    <option value="">Something 1</option>
                                    <option value="">Something 2</option>
                                    <option value="">Something 3</option>
                                </select>
                            </div>
                        </form>

                        <div class="modal-footer">
                            <button type="button" class="modal_closs_btn common_btn" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="common_btn">submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
