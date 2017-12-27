@extends('front-end.layout.master')
@section('pageTitle','BKSTORE:Checkout')
@section('content')

    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Sản phẩm</h2>
                        @foreach($cart as $row)
                        <div class="thubmnail-recent">
                            <img src="/images/phone/{{$row->options['img']}}" class="recent-thumb" alt="">
                            <h2><a href="/detail/{{$row->id}}" style="color: #5bc0de;">{{strtoupper($row->name)}}</a></h2>
                            <div class="product-sidebar-price">
                                <ins>{{$row->prime}}</ins>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <table cellspacing="0">
                        <tbody>
                            <tr class="cart-subtotal">
                                <th>Tổng số tiền</th>
                                <td><span class="amount">{{$subtotal}}$</span></td>
                            </tr>
                            <tr class="order-total">
                                <th>Tổng giá trị đơn hàng     : </th>
                                <td><strong><span class="amount"> {{$total}}$ </span></strong> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="woocommerce">


                            <form enctype="multipart/form-data" action="{{url('dat-hang')}}" class="checkout" method="POST" name="checkout">
                                 {{ csrf_field() }}
                                <div id="customer_details" class="col2-set">
                                    <div class="col-1">
                                        <div class="woocommerce-billing-fields">
                                            <h3>Chi tiết hóa đơn</h3>
                                            <p id="billing_country_field" class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                            </p>
                                            <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                                <label class="" for="billing_last_name">Fullname <abbr title="required" class="required" style="color: red;" >*</abbr>
                                                </label>
                                                <input type="text" value="" placeholder="" id="billing_last_name" name="billing_last_name" class="input-text " required="required">
                                            </p>
                                            <div class="clear"></div>

                                            <p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
                                                <label class="" for="billing_address_1">Address <abbr title="required" class="required" style="color: red;">*</abbr>
                                                </label>
                                                <input type="text" value="" placeholder="Ha Noi" id="billing_address_1" name="billing_address_1" class="input-text " required="required">
                                            </p>

                                            <div class="clear"></div>

                                            <p id="billing_email_field" class="form-row form-row-first validate-required validate-email">
                                                <label class="" for="billing_email">Email Address <abbr title="required" class="required" style="color: red;">*</abbr>
                                                </label>
                                                <input type="text" value="" placeholder="" id="billing_email" name="billing_email" class="input-text " required="required">
                                            </p>

                                            <p id="billing_phone_field" class="form-row form-row-last validate-required validate-phone">
                                                <label class="" for="billing_phone">Phone <abbr title="required" class="required" style="color: red;">*</abbr>
                                                </label>
                                                <input type="text" value="" placeholder="" id="billing_phone" name="billing_phone" class="input-text " required="required">
                                            </p>
                                            <div class="clear"></div>
                                            <div id="payment">
                                                <ul class="payment_methods methods">
                                                    <li class="payment_method_bacs">
                                                        <input type="radio" data-order_button_text="" checked="checked" value="bacs" name="payment_method" class="input-radio" id="payment_method_bacs">
                                                        <label for="payment_method_bacs">Trả bằng tài khoản ngân hàng của bạn </label>
                                                        <div class="payment_box payment_method_bacs">
                                                            <p>Thanh toán hóa đơn bằng tài khoản ngân hàng. Sản phẩm sẽ được giao cho đến khi bạn thanh toán x</p>
                                                        </div>
                                                    </li>
                                                    <li class="payment_method_paypal">
                                                        <input type="radio" data-order_button_text="Proceed to PayPal" value="paypal" name="payment_method" class="input-radio" id="payment_method_paypal">
                                                        <label for="payment_method_paypal">PayPal <img alt="PayPal Acceptance Mark" src="https://www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png"><a title="What is PayPal?" onclick="javascript:window.open('https://www.paypal.com/gb/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;" class="about_paypal" href="https://www.paypal.com/gb/webapps/mpp/paypal-popup">What is PayPal?</a>
                                                        </label>
                                                        <div style="display:none;" class="payongment_box payment_method_paypal">
                                                            <p>Trả phí thông qua Paypal -- bạn có thể trả phí qua credits card nếu như bạn không có tài khoản Paypal</p>
                                                        </div>
                                                    </li>
                                                </ul>



                                                <div class="clear"></div>

                                            </div>
                                            <div class="form-row place-order">
                                                <input type="submit" data-value="Place order" value="Place order" id="place_order" name="woocommerce_checkout_place_order" class="button alt">
                                            </div>
                                            <div class="clear"></div>
                                        </div>

                                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection('content')
