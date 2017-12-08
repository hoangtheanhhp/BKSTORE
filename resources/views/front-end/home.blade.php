@extends('front-end.layout.master')
@section('content')

    <div class="slider-area">
        	<!-- Slider -->
			<div class="block-slider block-slider4">

				<ul class="" id="bxslider-home4">
          @foreach($slides as $slide)
					<li><img src="/images/slide/{{ $slide->image }}" width="90%" alt="Slide">

					</li>
          @endforeach
				</ul>
			</div>
			<!-- ./Slider -->
    </div> <!-- End slider area -->

    <div class="promo-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo1">
                        <i class="fa fa-refresh"></i>
                        <p>30 Days return</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo2">
                        <i class="fa fa-truck"></i>
                        <p>Free shipping</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo3">
                        <i class="fa fa-lock"></i>
                        <p>Secure payments</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo4">
                        <i class="fa fa-gift"></i>
                        <p>New products</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End promo area -->

    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Latest Products</h2>
                        <div class="product-carousel">
                            @foreach($phones as $phone)
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="images/phone/{{$phone->images}}" alt="">
                                        <div class="product-hover">
                                            <a href="{{url('/gio-hang/addcart/'.$phone->id)}}" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="/detail/{{$phone->id}}" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>

                                    <h2><a href="{{ url('/detail/'.$phone->id) }}">{{strtoupper($phone->name)}}</a></h2>

                                    <div class="product-carousel-price">
                                        @if($phone->status == 0 ||$phone->number < 0)
                                            <p style="color: #c9302c;">Hết hàng</p>
                                        @endif
                                        @if($phone->promo1 == '')
                                        <ins>{{ $phone->price }}</ins>
                                        @else
                                            <ins>{{ $phone->price - $phone->promo1/100 * $phone->price }}$</ins> <del>{{$phone->price}}$</del>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {!! $phones->links() !!}

                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Top Sellers</h2>
                        <div class="product-carousel">
                            @foreach($phone_sells as $phone)
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="images/phone/{{$phone->images}}" alt="">
                                        <div class="product-hover">
                                            <a href="{{url('/gio-hang/addcart/'.$phone->id)}}" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="/detail/{{$phone->id}}" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>
                                    <h2><a href="{{ url('/detail/'.$phone->id) }}">{{strtoupper($phone->name)}}</a></h2>
                                    <div class="product-carousel-price">
                                        @if($phone->status == 0 ||$phone->number < 0)
                                            <p style="color: #c9302c;">Hết hàng</p>
                                        @endif
                                        @if($phone->promo1 == '')
                                            <ins>{{ $phone->price }}</ins>
                                        @else
                                            <ins>{{ $phone->price - $phone->promo1/100 * $phone->price }}$</ins> <del>{{$phone->price}}$</del>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {!! $phones->links() !!}

                </div>
            </div>
        </div>
    </div> <!-- End main content area -->

    <div class="brands-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <div class="brand-list">
                            @foreach($category as $row)
                            <img src="{!!url('images/category/'.$row->slug)!!}" alt="" >
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End brands area -->

    <div class="product-widget-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Top Sellers</h2>
                        <a href="" class="wid-view-more">View All</a>
                        @foreach($phone_sells as $key => $phone_sell)
                            @if($key == 3)
                                @break
                            @endif
                        <div class="single-wid-product">
                            <a href="{{ url('/detail/'.$phone_sell->id) }}"><img src="/images/phone/{{$phone_sell->images}}" alt="" class="product-thumb"></a>
                            <h2><a href="{{ url('/detail/'.$phone_sell->id) }}">{{$phone_sell->name}}</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                @if($phone_sell->promo1 == null)
                                    <ins>{{ $phone_sell->price }}</ins>
                                @else
                                    <ins>{{ $phone_sell->price - $phone_sell->promo1/100 * $phone_sell->price }}$</ins> <del>{{$phone_sell->price}}$</del>
                                @endif
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Top Viewed</h2>
                        <a href="#" class="wid-view-more">View All</a>
                        @foreach($phone_views as $key => $phone_view)
                            @if($key == 3)
                                @break
                            @endif
                        <div class="single-wid-product">
                            <a href="{{ url('/detail/'.$phone_view->id) }}"><img src="/images/phone/{{$phone_view->images}}" alt="" class="product-thumb"></a>
                            <h2><a href="{{ url('/detail/'.$phone_view->id) }}">{{$phone_view->name}}</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                @if($phone_view->promo1 == null)
                                    <ins>{{ $phone_view->price }}</ins>
                                @else
                                    <ins>{{ $phone_view->price - $phone_view->promo1/100 * $phone_view->price }}$</ins> <del>{{$phone_view->price}}$</del>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Top New</h2>
                        <a href="#" class="wid-view-more">View All</a>
                        @foreach($phones as $key => $phone)
                        <div class="single-wid-product">
                            @if($key == 3)
                                @break
                            @endif
                            <a href="{{ url('/detail/'.$phone->id) }}"><img src="images/phone/{{$phone->images}}" alt="" class="product-thumb"></a>
                            <h2><a href="{{ url('/detail/'.$phone->id) }}">{{$phone->name}}</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                @if($phone->promo1 == null)
                                    <ins>{{ $phone->price }}</ins>
                                @else
                                    <ins>{{ $phone->price - $phone->promo1/100 * $phone->price }}$</ins> <del>{{$phone->price}}$</del>
                                @endif
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End product widget area -->


@endsection('content')
