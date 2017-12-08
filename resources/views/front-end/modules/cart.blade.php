@extends('front-end.layout.master')
@section('pageTitle','handsome')
@section('content')
    {{--<div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Page title area -->--}}
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @elseif (Session()->has('flash_level'))
        <div class="alert alert-success">
            <ul>
                {!! Session::get('flash_massage') !!}
            </ul>
        </div>
    @endif
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                  <div class="single-sidebar">
                      <h2 class="sidebar-title">Products</h2>
                      @foreach($cart as $row)
                      <div class="thubmnail-recent">
                          <img src="/images/phone/{{$row->options->img}}" class="recent-thumb" alt="">
                          <h2><a href="detal/{{$row->id}}">{{strtoupper($row->name)}}</a></h2>
                          <div class="product-sidebar-price">
                              @if($row->promo1 == '')
                                  <ins>{{ $row->price }}$</ins>
                              @else
                                  <ins>{{ $row->price - $row->promo1/100 * $row->price }}$</ins> <del>{{$row->price}}$</del>
                              @endif
                          </div>
                      </div>
                      @endforeach
                  </div>
                </div>
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <form action="/cart-dat-hang" method="POST">
                                {{csrf_field()}}
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th>Actions</th>
                                            <th>Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($cart as $row)
                                        <tr class="cart_item">
                                            <td class="product-remove">
                                                <a title="Remove this item" class="remove" href="/gio-hang/delete/{{$row->rowId}}">×</a>
                                            </td>
                                            <td class="product-thumbnail">
                                                <a href="/detail/{{$row->id}}"><img width="145" height="300" alt="poster_1_up" class="shop_thumbnail" src="images/phone/{{$row->options['img']}}"></a>
                                            </td>

                                            <td class="product-name">
                                                <a href="single-product.html">{{$row->name}}</a>
                                            </td>

                                            <td class="product-price">
                                                <span class="amount">{{$row->price}}$</span>
                                            </td>

                                            <td class="product-quantity">
                                                <div class="quantity buttons_added">
                                                    <input type="number" name="{{$row->id}}" size="4" class="input-text qty text" title="Qty" value="{{$row->qty}}" min="0" step="1">
                                                </div>
                                            </td>

                                            <td class="product-subtotal">
                                                <span class="amount">{{$row->qty*$row->price}}$</span>
                                            </td>
                                        </tr>
                                        @endforeach

                                        <div class="cart-collaterals col-md-offset-3 c">

                                            <div class="cart_totals ">
                                                <table cellspacing="0">
                                                    <h2>Cart Totals</h2>

                                                    <tbody>
                                                    <tr class="cart-subtotal">
                                                        <th>Cart Subtotal</th>
                                                        <td><span class="amount">{{$subtotal}}$</span></td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Order Total     (+12.1%VAT)</th>
                                                        <td><strong><span class="amount">{{$total}}$</span></strong> </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <tr>
                                            <td class="actions" colspan="6">
                                                <input type="submit" value="Checkout" class="checkout-button button alt wc-forward">
                                            </td>
                                        </tr>

                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



  @endsection('content')
