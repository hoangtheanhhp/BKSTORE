@extends('front-end.layout.master')
@section('pageTitle','handsome')
@section('content')
<div class="single-product-area">
      <div class="zigzag-bottom"></div>
      <div class="container">
          <div class="row">
              <div class="col-md-4">
                  <div class="single-sidebar">
                      <h2 class="sidebar-title">Search Products</h2>
                      <form action="">
                          <input type="text" placeholder="Search products...">
                          <input type="submit" value="Search">
                      </form>
                  </div>

                  <div class="single-sidebar">
                      <h2 class="sidebar-title">Products</h2>
                      <div class="thubmnail-recent">
                          <img src="images/phone/1.jpg" class="recent-thumb" alt="">
                          <h2><a href="">Iphone 8</a></h2>
                          <div class="product-sidebar-price">
                              <ins>{{$phone->price}}</ins> <del>{{$phone->promo1}}}</del>
                          </div>
                      </div>
                      <div class="thubmnail-recent">
                          <img src=src="images/phone/2.jpg" class="recent-thumb" alt="">
                          <h2><a href="">Iphone X</a></h2>
                          <div class="product-sidebar-price">
                              <ins>$700.00</ins> <del>$100.00</del>
                          </div>
                      </div>
                      <div class="thubmnail-recent">
                          <img src="src="images/phone/3.jpg"" class="recent-thumb" alt="">
                          <h2><a href="">Iphone 8+</a></h2>
                          <div class="product-sidebar-price">
                              <ins>$700.00</ins> <del>$100.00</del>
                          </div>
                      </div>
                      <div class="thubmnail-recent">
                          <img src="src="images/phone/4.jpg"" class="recent-thumb" alt="">
                          <h2><a href="">Iphone 8 plus - 2015</a></h2>
                          <div class="product-sidebar-price">
                              <ins>$700.00</ins> <del>$100.00</del>
                          </div>
                      </div>
                  </div>

                  <div class="single-sidebar">
                      <h2 class="sidebar-title">Recent Posts</h2>
                      <ul>
                          <li><a href="">Sony Smart TV - 2015</a></li>
                          <li><a href="">Sony Smart TV - 2015</a></li>
                          <li><a href="">Sony Smart TV - 2015</a></li>
                          <li><a href="">Sony Smart TV - 2015</a></li>
                          <li><a href="">Sony Smart TV - 2015</a></li>
                      </ul>
                  </div>
              </div>

              <div class="col-md-8">
                  <div class="product-content-right">
                      <div class="product-breadcroumb">
                          <a href="">Home</a>
                          <a href="">Category Name</a>
                          <a href="">{{$phone->name}}</a>
                      </div>

                      <div class="row">
                          <div class="col-sm-6">
                              <div class="product-images">
                                  <div class="product-main-img">
                                      <img src="/images/phone/{{ $phone->images}}" alt="">
                                  </div>
                                  @foreach($phone_detail as $detail)
                                  <div class="product-gallery" style="float: left; ">
                                      <img src="/images/phone/{{$detail->images_url}}" alt="">
                                  </div>
                                  @endforeach
                              </div>
                          </div>

                          <div class="col-sm-6">
                              <div class="product-inner">
                                  <h2 class="product-name" style="color: #0088bb;">{{$phone->name}}</h2>
                                  <div class="product-inner-price">
                                      <ins>{{$phone->price}}$</ins> <del>{{$phone->promo1}}$</del>
                                  </div>

                                  <form action="/gio-hang/addcart/{{$phone->id}}" class="cart">
                                      <input name="_method" type="hidden" value="PATCH">
                                      {{ csrf_field() }}
                                      <div class="quantity">
                                          <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="qty" min="1" step="1">
                                      </div>
                                      <button class="add_to_cart_button" type="submit">Add to cart</button>
                                  </form>

                                  <div role="tabpanel">
                                      <ul class="product-tab" role="tablist">
                                          <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                          <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                                      </ul>
                                      <div class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade in active" id="home">
                                             <h2>Thông số kĩ thuật</h2>
                                             <table>
                                                 <tr>
                                                     <td><span class="text-muted">Màn hình:</span></td>
                                                     <td>{{$phone_info->screen}}</td>
                                                 </tr>
                                                 <tr>
                                                     <td><span class="text-muted">Hệ điều hành:</span></td>
                                                     <td>{{$phone_info->os}}</td>
                                                 </tr>
                                                 <tr>
                                                     <td><span class="text-muted">Camera sau:</span></td>
                                                     <td>{{$phone_info->cam1}}</td>
                                                 </tr>
                                                 <tr>
                                                     <td><span class="text-muted">Camera trước:</span></td>
                                                     <td>{{$phone_info->cam2}}</td>
                                                 </tr>
                                                 <tr>
                                                     <td><span class="text-muted">CPU:</span></td>
                                                     <td>{{$phone_info->cpu}}</td>
                                                 </tr>
                                                 <tr>
                                                     <td><span class="text-muted">RAM:</span></td>
                                                     <td>{{$phone_info->ram}}</td>
                                                 </tr>
                                                 <tr>
                                                     <td><span class="text-muted">Bộ nhớ trong:</span></td>
                                                     <td>{{$phone_info->storage}}</td>
                                                 </tr>
                                                 <tr>
                                                     <td><span class="text-muted">Thẻ nhớ:</span></td>
                                                     <td>{{$phone_info->exten_memmory}}</td>
                                                 </tr>
                                                 <tr>
                                                     <td><span class="text-muted">Thẻ SIM:</span></td>
                                                     <td>{{$phone_info->sim}}</td>
                                                 </tr>
                                                 <tr>
                                                     <td><span class="text-muted">Dung lượng pin:</span></td>
                                                     <td>{{$phone_info->pin}}  </td>
                                                 </tr>
                                             </table>
                                          </div>
                                          <div role="tabpanel" class="tab-pane fade" id="profile">
                                              <h2>Reviews</h2>
                                              <div class="submit-review">
                                                  <p><label for="name">Name</label> <input name="name" type="text"></p>
                                                  <p><label for="email">Email</label> <input name="email" type="email"></p>
                                                  <div class="rating-chooser">
                                                      <p>Your rating</p>

                                                      <div class="rating-wrap-post">
                                                          <i class="fa fa-star"></i>
                                                          <i class="fa fa-star"></i>
                                                          <i class="fa fa-star"></i>
                                                          <i class="fa fa-star"></i>
                                                          <i class="fa fa-star"></i>
                                                      </div>
                                                  </div>
                                                  <p><label for="review">Your review</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                                  <p><input type="submit" value="Submit"></p>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                              </div>
                          </div>
                      </div>


                      <div class="related-products-wrapper">
                          <h2 class="related-products-title">Related Products</h2>
                          <div class="related-products-carousel">
                              <div class="single-product">
                                  <div class="product-f-image">
                                      <img src="img/product-1.jpg" alt="">
                                      <div class="product-hover">
                                          <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                          <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                      </div>
                                  </div>

                                  <h2><a href="">Sony Smart TV - 2015</a></h2>

                                  <div class="product-carousel-price">
                                      <ins>$700.00</ins> <del>$100.00</del>
                                  </div>
                              </div>
                              <div class="single-product">
                                  <div class="product-f-image">
                                      <img src="img/product-2.jpg" alt="">
                                      <div class="product-hover">
                                          <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                          <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                      </div>
                                  </div>

                                  <h2><a href="">Apple new mac book 2015 March :P</a></h2>
                                  <div class="product-carousel-price">
                                      <ins>$899.00</ins> <del>$999.00</del>
                                  </div>
                              </div>
                              <div class="single-product">
                                  <div class="product-f-image">
                                      <img src="img/product-3.jpg" alt="">
                                      <div class="product-hover">
                                          <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                          <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                      </div>
                                  </div>

                                  <h2><a href="">Apple new i phone 6</a></h2>

                                  <div class="product-carousel-price">
                                      <ins>$400.00</ins> <del>$425.00</del>
                                  </div>
                              </div>
                              <div class="single-product">
                                  <div class="product-f-image">
                                      <img src="img/product-4.jpg" alt="">
                                      <div class="product-hover">
                                          <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                          <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                      </div>
                                  </div>

                                  <h2><a href="">Sony playstation microsoft</a></h2>

                                  <div class="product-carousel-price">
                                      <ins>$200.00</ins> <del>$225.00</del>
                                  </div>
                              </div>
                              <div class="single-product">
                                  <div class="product-f-image">
                                      <img src="img/product-5.jpg" alt="">
                                      <div class="product-hover">
                                          <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                          <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                      </div>
                                  </div>

                                  <h2><a href="">Sony Smart Air Condtion</a></h2>

                                  <div class="product-carousel-price">
                                      <ins>$1200.00</ins> <del>$1355.00</del>
                                  </div>
                              </div>
                              <div class="single-product">
                                  <div class="product-f-image">
                                      <img src="img/product-6.jpg" alt="">
                                      <div class="product-hover">
                                          <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                          <a href="" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                      </div>
                                  </div>

                                  <h2><a href="">Samsung gallaxy note 4</a></h2>

                                  <div class="product-carousel-price">
                                      <ins>$400.00</ins>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

@endsection('content')
