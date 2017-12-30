@extends('front-end.layout.master')
@section('pageTitle', 'BKSTORE:Home')
@section('content')
    <div class='row'>
    <div class='col-md-8'>
        <div class="slider-area">
        	<!-- Slider -->
			<div class="block-slider block-slider4">

				<ul class="" id="bxslider-home4">
          @foreach($slides as $slide)
					<li><img src="/images/slide/{{ $slide->image }}" class='img img-responsive' width="100%" alt="Slide">

					</li>
          @endforeach
				</ul>
			</div>

			<!-- ./Slider -->
        </div> <!-- End slider area -->
    </div>
    <div class="col-md-4">
			<div class="title">
                <a href="/blog">
				<div class="col-sm-5">
					<p>TIN CÔNG NGHỆ</p>
				</div>
                </a>
			</div>
			<div>
                @foreach($news as $key => $new)
                    <div class = "row">
                        <div class="col-sm-4 image-news">
                            <img src="/uploads/news/{{$new->images}}" class="img-responsive">
                        </div>
                        <div class="col-sm-offset-0 col-sm-7">
                            <a href='/blog_detail/{{$new->id}}'>
                                <div class="element">
                                    <div class="centent col-xs-12">
                                        <p>{{$new->title}}</p>
                                        <p class="text-muted">{{$new->created_at->diffForHumans()}}</p>
                                    </div>

                                <hr>
                                </div>
                            </a>
                        </div>
                    </div>
                    @if($key == 1)
                        @break
                    @endif
                @endforeach
				
			</div>
		</div>
    </div>
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
                        <h2 class="section-title">Sản phẩm mới nhất</h2>
                        <div class="product-carousel">
                            @foreach($phones as $phone)
                                <a href='/detail/{{$phone->id}}'>
                                 <div class="element">
                                    <div>
                                        <img src="/images/phone/{{$phone->images}}" class="img-responsive">
                                        <hr>
                                        <p class="name">
                                            <strong class="text-primary">{{$phone->name}}</strong>
                                        </p>
                                        <p class="price">
                                            <strong class="text-danger">{{number_format($phone->price)}}
                                                <sup>
                                                    <u>đ</u>
                                                </sup>
                                            </strong>
                                        </p>
                                        <p class="promotion text-muted">
                                            @if($phone->promo1!='')
                                            <p>Khuyến mãi:</p>
                                            <ul>
                                                <li>{{$phone->promo1}}</li>
                                                @if($phone->promo2!='')
                                                <li>{{$phone->promo2}}</li>
                                                @endif
                                                @if($phone->promo3!='')
                                                <li>{{$phone->promo3}}</li>
                                                @endif
                                            </ul>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="info">
                                        <p class="name"><strong class="text-primary">{{$phone->name}}</strong></p>
                                        <p class="price"><strong class="text-danger">{{number_format($phone->price)}}<sup><u>đ</u></sup></strong></p>
                                        <p>Màn hình: {{$phone->screen}}</p>
                                        <p>HĐH: {{$phone->os}}</p>
                                        <p>CPU: {{$phone->cpu}}</p>
                                        <p>RAM: {{$phone->ram}}, ROM: {{$phone->rom}}</p>
                                        <p>Camera: {{$phone->cam1}}, Selfie: {{$phone->cam2}}</p>
                                        <p>PIN: {{$phone->pin}}, SIM: {{$phone->sim}}</p>
                                        @if($phone->number >= 1)
                                        <p>Còn: <span style="color: red;">{{$phone->number}}</span> sản phẩm</p>
                                            @else <p style="color: red;">Hết hàng</p>
                                            @endif
                                    </div>
                                </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h4 class="section-title">Sản phẩm bán chạy nhất</h4>
                        <div class="product-carousel">
                            @foreach($phone_sells as $phone)
                                <a href='/detail/{{$phone->id}}'>
                                 <div class="element">
                                    <div>
                                        <img src="/images/phone/{{$phone->images}}" class="img-responsive">
                                        <hr>
                                        <p class="name">
                                            <strong class="text-primary">{{$phone->name}}</strong>
                                        </p>
                                        <p class="price">
                                            <strong class="text-danger">{{number_format($phone->price)}}
                                                <sup>
                                                    <u>đ</u>
                                                </sup>
                                            </strong>
                                        </p>
                                        <p class="promotion text-muted">
                                            @if($phone->promo1!='')
                                            <p>Khuyến mãi:</p>
                                            <ul>
                                                <li>{{$phone->promo1}}</li>
                                                @if($phone->promo2!='')
                                                <li>{{$phone->promo2}}</li>
                                                @endif
                                                @if($phone->promo3!='')
                                                <li>{{$phone->promo3}}</li>
                                                @endif
                                            </ul>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="info">
                                        <p class="name"><strong class="text-primary">{{$phone->name}}</strong></p>
                                        <p class="price"><strong class="text-danger">{{number_format($phone->price)}}<sup><u>đ</u></sup></strong></p>
                                        <p>Màn hình: {{$phone->screen}}</p>
                                        <p>HĐH: {{$phone->os}}</p>
                                        <p>CPU: {{$phone->cpu}}</p>
                                        <p>RAM: {{$phone->ram}}, ROM: {{$phone->rom}}</p>
                                        <p>Camera: {{$phone->cam1}}, Selfie: {{$phone->cam2}}</p>
                                        <p>PIN: {{$phone->pin}}, SIM: {{$phone->sim}}</p>
                                        @if($phone->number >= 1)
                                            <p>Còn: <span style="color: red;">{{$phone->number}}</span> sản phẩm</p>
                                        @else <p style="color: red;">Hết hàng</p>
                                        @endif                                    </div>
                                </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

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
                            <img src="{!!url('images/category/'.$row->image)!!}" alt="" >
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End brands area -->

    <div class="product-widget-area">
        <div class="container">
            <div class="col-md-12 ">
            <div class="row" style="justify-content: space-between; margin-left:20px;">
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Bán chạy</h2>
                        @foreach($phone_sells as $key => $phone_sell)
                            @if($key == 3)
                                @break
                            @endif
                        <div class="single-wid-product">
                            <a href="{{ url('/detail/'.$phone_sell->id) }}"><img src="/images/phone/{{$phone_sell->images}}" alt="" class="product-thumb"></a>
                            <h2><a href="{{ url('/detail/'.$phone_sell->id) }}">{{$phone_sell->name}}</a></h2>
                            <div class="product-wid-price">
                                    <ins>{{ number_format($phone_sell->price)}}</ins>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Nhiều lượt xem</h2>
                        @foreach($phone_views as $key => $phone_view)
                            @if($key == 3)
                                @break
                            @endif
                        <div class="single-wid-product">
                            <a href="{{ url('/detail/'.$phone_view->id) }}"><img src="/images/phone/{{$phone_view->images}}" alt="" class="product-thumb"></a>
                            <h2><a href="{{ url('/detail/'.$phone_view->id) }}">{{$phone_view->name}}</a></h2>
                          
                            <div class="product-wid-price">
                                    <ins>{{ number_format($phone_view->price) }}</ins>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Sản phẩm mới </h2>
                        @foreach($phones as $key => $phone)
                        <div class="single-wid-product">
                            @if($key == 3)
                                @break
                            @endif
                            <a href="{{ url('/detail/'.$phone->id) }}"><img src="images/phone/{{$phone->images}}" alt="" class="product-thumb"></a>
                            <h2><a href="{{ url('/detail/'.$phone->id) }}">{{$phone->name}}</a></h2>
                            <div class="product-wid-price">
                                <ins>{{ number_format($phone->price) }}</ins>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        </div>
    </div> <!-- End product widget area -->

@endsection('content')
