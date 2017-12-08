@extends('front-end.layout.master')
@section('pageTitle','handsome')
@section('content')
<div class="single-product-area">
      <div class="zigzag-bottom"></div>
      <div class="container">
          <div class="row">
              <div class="col-md-4">
                  <div class="single-sidebar">
                      <h2 class="sidebar-title">Products</h2>
                      @foreach($phoneIphone as $ip)

                      <div class="thubmnail-recent">
                          <img src="/images/phone/{{$ip->images}}" class="recent-thumb" alt="" width="50px" height="50px">
                          <h2><a href="{{url('detail/'.$ip->id)}}">{{$ip->name}}</a></h2>
                          <div class="product-sidebar-price">
                              @if($ip->promo1 == '')
                                  <ins>{{ $ip->price }}</ins>
                              @else
                                  <ins>{{ $ip->price - $ip->promo1/100 * $ip->price }}$</ins> <del>{{$ip->price}}$</del>
                              @endif
                          </div>
                      </div>
                      @endforeach

                  </div>

                  <div class="single-sidebar">
                      <h2 class="sidebar-title">Recent Posts</h2>
                      <ul>
                          @foreach($phone_recently as $key => $p_r)
                              @if($key == 5)
                                  @break
                              @endif
                              <li><a href="{{url('detail/'.$p_r->id)}}">{{strtoupper($p_r->name)}}</a></li>
                              @endforeach
                      </ul>
                  </div>
              </div>

              <div class="col-md-8">
                  <div class="product-content-right">
                      <div class="product-breadcroumb">
                          <a href="">Home</a>
                          <a href="">{{strtoupper($phone->category->name)}}</a>
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
                                      <img src="/images/phone/details/{{$detail->images_url}}" alt="">
                                  </div>
                                  @endforeach
                              </div>
                          </div>

                          <div class="col-sm-6">
                              <div class="product-inner">
                                  <h2 class="product-name" style="color: #0088bb;">{{$phone->name}}</h2>
                                  <div class="product-inner-price">
                                      @if($phone->promo1 == '')
                                          <ins>{{ $phone->price }}</ins>
                                      @else
                                          <ins>{{ $phone->price - $phone->promo1/100 * $phone->price }}$</ins> <del>{{$phone->price}}$</del>
                                      @endif
                                  </div>

                                  <form action="/gio-hang/addcart/{{$phone->id}}" class="cart">
                                      {{ csrf_field() }}
                                      <div class="quantity">
                                          <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="qty" min="1" step="1">
                                      </div>
                                      <button class="add_to_cart_button" type="submit">Add to cart</button>
                                  </form>

                                  <div role="tabpanel">
                                      <ul class="product-tab" role="tablist">

                                          <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
{{--
                                          <li role="presentation" ><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
--}}
                                      </ul>
                                      <div class="tab-content clearfix">
                                          <div class="tab-pane fade in active" id="home">
                                             <h2>Thông số kĩ thuật</h2>
                                             <table>
                                                 <tr>
                                                     <td><span class="text-muted">Màn hình:</span></td>
                                                     <td>
                                                         {{$phone_info->screen == null? 'Không có thông tin' : $phone_info->screen}}
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td><span class="text-muted">Hệ điều hành:</span></td>
                                                     <td>{{$phone_info->os == null? 'Không có thông tin' : $phone_info->os}}</td>
                                                 </tr>
                                                 <tr>
                                                     <td><span class="text-muted">Camera sau:</span></td>
                                                     <td>{{$phone_info->cam1 == null? 'Không có thông tin' : $phone_info->cam1}}</td>
                                                 </tr>
                                                 <tr>
                                                     <td><span class="text-muted">Camera trước:</span></td>
                                                     <td>{{$phone_info->cam2 == null? 'Không có thông tin' : $phone_info->cam2}}</td>
                                                 </tr>
                                                 <tr>
                                                     <td><span class="text-muted">CPU:</span></td>
                                                     <td>{{$phone_info->cpu == null? 'Không có thông tin' : $phone_info->cpu}}</td>
                                                 </tr>
                                                 <tr>
                                                     <td><span class="text-muted">RAM:</span></td>
                                                     <td>{{$phone_info->ram == null? 'Không có thông tin' : $phone_info->ram}}</td>
                                                 </tr>
                                                 <tr>
                                                     <td><span class="text-muted">Bộ nhớ trong:</span></td>
                                                     <td>{{$phone_info->storage == null? 'Không có thông tin' : $phone_info->storage}}</td>
                                                 </tr>
                                                 <tr>
                                                     <td><span class="text-muted">Thẻ nhớ:</span></td>
                                                     <td>{{$phone_info->exten_memmory == null? 'Không có thông tin' : $phone_info->exten_memmory}}</td>
                                                 </tr>
                                                 <tr>
                                                     <td><span class="text-muted">Thẻ SIM:</span></td>
                                                     <td>{{$phone_info->sim == null? 'Không có thông tin' : $phone_info->sim}}</td>
                                                 </tr>
                                                 <tr>
                                                     <td><span class="text-muted">Dung lượng pin:</span></td>
                                                     <td>{{$phone_info->pin == null? 'Không có thông tin' : $phone_info->pin}} </td>
                                                 </tr>
                                             </table>
                                          </div>
                                      </div>
                                  </div>

                              </div>

                          </div>
                      </div>
                      <h2>Reviews</h2>
                      @foreach($reviews as $review)
                      <div class="row">
                          <div class="col-sm-11">
                              <p><span style="font-size: 20px; color: black;">{{strtoupper($review->customer_name)}}</span> {{$review->created_at}}</p>
                              <div class="product-wid-rating" style="width: 100px; float:left;">
                                  @for($i = 0; $i < 5; $i++)
                                      @if($i < $review->customer_rating)
                                      <i class="fa fa-star"></i>
                                      @else
                                          <i class="fa fa-star" style="color: #b3b3b3;"></i>
                                      @endif
                                  @endfor
                              </div>
                              <div class="review">
                                  <span>
                                      {{$review->review}}
                                  </span>
                              </div>
                          </div>
                      </div>
                      @endforeach
                      {{$reviews->links()}}
                      <div class="row" style="margin-top: 100px;">
                          <div class="col-sm-12">
                              <div class="submit-review">
                                  <h2>Please Input Your Review Here</h2>
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
                                      @if (session('success'))
                                          <div class="alert alert-success">
                                              {{ session('success') }}
                                          </div>
                                      @endif
                                  <form action="{{url('detail/'.$phone->id.'/message')}}" method="POST">
                                      {{csrf_field()}}
                                      <p><label for="name">Name</label> <input name="name" type="text" required="required"></p>
                                      <p><label for="email">Email</label> <input name="email" type="email" required="required"></p>
                                      <div class="rating-chooser">
                                          <p>Your rating</p>

                                          <div class="rating rating-wrap-post">
                                              <label>
                                                  <input type="radio" name="rating" value="5" title="5 stars" > 5
                                              </label>
                                              <label>
                                                  <input type="radio" name="rating" value="4" title="4 stars"> 4
                                              </label>
                                              <label>
                                                  <input type="radio" name="rating" value="3" title="3 stars"> 3
                                              </label>
                                              <label>
                                                  <input type="radio" name="rating" value="2" title="2 stars"> 2
                                              </label>
                                              <label>
                                                  <input type="radio" name="rating" value="1" title="1 star"> 1
                                              </label>
                                          </div>
                                      </div>
                                      <p><label for="review">Your review</label> <textarea name="review" id="" cols="30" rows="10" required="required"></textarea></p>
                                      <p><input type="submit" value="Submit"></p>
                                  </form>
                              </div>
                          </div>
                      </div>


                      <div class="related-products-wrapper">
                          <h2 class="related-products-title">Related Products</h2>
                          <div class="related-products-carousel">
                              @foreach($phone_recently as $p_r)
                              <div class="single-product">
                                  <div class="product-f-image">
                                      <img src="/images/phone/{{$p_r->images}}" alt="{{$p_r->images}}" style="height: 250px;">
                                      <div class="product-hover">
                                          <a href="{{url('/gio-hang/addcart/'.$p_r->id)}}" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                          <a href="{{url('detail/'.$p_r->id)}}" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                      </div>
                                  </div>

                                  <h2><a href="">{{$p_r->name}}</a></h2>

                                  <div class="product-carousel-price">
                                      @if($p_r->promo1 == '')
                                          <ins>{{ $p_r->price }}</ins>
                                      @else
                                          <ins>{{ $p_r->price - $p_r->promo1/100 * $p_r->price }}$</ins> <del>{{$p_r->price}}$</del>
                                      @endif
                                  </div>
                              </div>
                                  @endforeach
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
<script>
    $(document).ready(function () {
        $('.rating input').change(function () {
            var $radio = $(this);
            $('.rating .selected').removeClass('selected');
            $radio.closest('label').addClass('selected');
        });
    })
    /*$(document).ready(function(){

        /!* 1. Visualizing things on Hover - See next part for action on click *!/
        $('#stars.li').on('mouseover', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li star').each(function(e){
                if (e < onStar) {
                    $(this).addClass('hover');
                }
                else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function(){
            $(this).parent().children('li star').each(function(e){
                $(this).removeClass('hover');
            });
        });


        /!* 2. Action to perform on click *!/
        $('#stars li').on('click', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            var msg = "";
            if (ratingValue > 1) {
                msg = "Thanks! You rated this " + ratingValue + " stars.";
            }
            else {
                msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
            }
            responseMessage(msg);

        });


    });

    function responseMessage(msg) {
        $('.success-box').fadeIn(200);
        $('.success-box div.text-message').html("<span>" + msg + "</span>");
    }*/

</script>
@endsection('content')
