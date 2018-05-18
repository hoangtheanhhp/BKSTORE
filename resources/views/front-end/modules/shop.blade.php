@extends('front-end.layout.master')
@section('pageTitle', 'BKSTORE:Shop')
@section('content')

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
                        <div> 
                            <form method="POST" action='{{url('/products/search')}}' >
                              {{ csrf_field() }}
                                <input type="text" name="searchItem" id="input_search" placeholder="Search Products" required="required" value="{{old('searchItem')}}">
                                <button class="button_search" id="search">Search</button>
                            </form>
                        </div>
                        <hr>
						<div class="brands_products">
							<h2>Thương hiệu</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
                                    <li><a href='/products/all'>All</a></li>
                                    @foreach($cat as $row) 
    									<li>
    										<a href="/products/{{$row->id}}">
    											{{$row->name}}</a>
    									</li>
                                    @endforeach
								</ul>
							</div>
						</div>

					</div>
					</div>
				<div class="col-sm-9 padding-right">
                    <div class="latest-product">
                        <div class="errors">
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
                        </div>
                            @foreach($products as $key=>$phone)
                            <!-- @if($key%4==0)  -->
                                <!-- <div class='row'> -->
                            <!-- @endif -->
                               <div class="col-md-3" style="margin-bottom: 10px;">
                                    <a href='/detail/{{$phone->id}}'>
                                        <div class="element" >
                                            <div>
                                                <img src="/images/phone/{{$phone->images}}" class="img-responsive">
                                                <hr>
                                                <p class="name" style="height: 30px;">
                                                    <strong class="text-primary">{{$phone->name}}</strong>
                                                </p>
                                                <p class="price">
                                                    <strong class="text-danger">{{number_format($phone->price)}}
                                                        <sup>
                                                            <u>đ</u>
                                                        </sup>
                                                    </strong>
                                                </p>
                                                <!-- <p class="promotion text-muted"> -->
                                                   <!--  @if($phone->promo1!='')
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

                                                    @endif -->
                                                <!-- </p> -->
                                                @if($phone->number >= 1)
                                                    <p>Còn: <span style="color: red;">{{$phone->number}}</span> sản phẩm</p>
                                                @else <p style="color: red;">Hết hàng</p>
                                                @endif
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

                                            </div>
                                        </div>
                                    </a>
                               </div>
                            <!-- @if($key%4==0)  -->
                                <!-- </div> -->
                            <!-- @endif -->
                            @endforeach
                    </div>
			    </div>
		</div>
	</section>
    <script>
        $(document).ready(funtion(){
            $("#ex2").slider({});
        });
    </script>

@endsection('content')
