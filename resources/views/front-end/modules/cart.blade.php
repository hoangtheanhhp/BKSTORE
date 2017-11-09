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
                          <img src="images/phone/$row->img" class="recent-thumb" alt="">
                          <h2><a href="single-product.html">{{$row->name}}</a></h2>
                          <div class="product-sidebar-price">
                              <ins>{{$row->prime}}</ins>
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
                                            <th class="product-remove">&nbsp;</th>
                                            <th class="product-thumbnail">&nbsp;</th>
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
                                                <a title="Remove this item" class="remove" href="gio-hang/delete/{{$row->id}}">×</a>
                                            </td>

                                            <td class="product-thumbnail">
                                                <a href="detail/{{$row->id}}"><img width="150" height="400" alt="none" class="shop_thumbnail" src="images/phone/{{$row->img}}"></a>
                                            </td>

                                            <td class="product-name">
                                                <a href="single-product.html">{{$row->name}}</a>
                                            </td>

                                            <td class="product-price">
                                                <span class="amount">{{$row->prime}}</span>
                                            </td>

                                            <td class="product-quantity">
                                                <div class="quantity buttons_added">
                                                    <input type="number" size="4" class="input-text qty text" title="Qty" value="{{$row->qty}}" min="0" step="1">
                                                </div>
                                            </td>

                                            <td class="product-subtotal">
                                                <span class="amount">{{$row->qty*$row->prime}}</span>
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
                            <div class="cross-sells">
                                <h2>You may be interested in...</h2>
                                <ul class="products">
                                    <li class="product">
                                        <a href="single-product.html">
                                            <img width="325" height="325" alt="T_4_front" class="attachment-shop_catalog wp-post-image" src="img/product-2.jpg">
                                            <h3>Ship Your Idea</h3>
                                            <span class="price"><span class="amount">£20.00</span></span>
                                        </a>

                                        <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="22" rel="nofollow" href="single-product.html">Select options</a>
                                    </li>

                                    <li class="product">
                                        <a href="single-product.html">
                                            <img width="325" height="325" alt="T_4_front" class="attachment-shop_catalog wp-post-image" src="img/product-4.jpg">
                                            <h3>Ship Your Idea</h3>
                                            <span class="price"><span class="amount">£20.00</span></span>
                                        </a>

                                        <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="22" rel="nofollow" href="single-product.html">Select options</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="cart_totals ">
                                <h2>Cart Totals</h2>

                                <table cellspacing="0">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td><span class="amount">£15.00</span></td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Order Total(    +10% VAT)</th>
                                            <td><strong><span class="amount">£15.00</span></strong> </td>
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
