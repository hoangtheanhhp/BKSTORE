@extends('front-end.layout.master')
@section('pageTitle','handsome')
@section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Page title area -->
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
                          <h2><a href="single-product.html">{{$row->name}}</a></h2>
                          <div class="product-sidebar-price">
                              <ins>{{$row->price}}</ins>
                          </div>
                      </div>
                      @endforeach
                  </div>
                </div>
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <form action="/dat-hang">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
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
                                                    <input type="number" size="4" class="input-text qty text" title="Qty" value="{{$row->qty}}" min="0" step="1">
                                                </div>
                                            </td>

                                            <td class="product-subtotal">
                                                <span class="amount">{{$row->qty*$row->price}}$</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="actions" colspan="6">
                                                <input type="submit" value="Checkout" class="checkout-button button alt wc-forward">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                            <div class="cart-collaterals">
                          
                            <div class="cart_totals ">
                                <h2>Cart Totals</h2>

                                <table cellspacing="0">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



  @endsection('content')
