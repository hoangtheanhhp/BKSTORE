@extends('front-end.layout.master')
@section('pageTitle', 'BKSTORE:Shop')
@section('content')

	<section>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
                        <div> 
                            <form method="POST" action='/products/search' >
                              {{ csrf_field() }}
                                <input type="text" name="searchItem" id="input_search" placeholder="Search Products">
                                <button class="button_search" id="search">Search</button>
                            </form>
                        </div>
                        <hr>
						<div class="brands_products">
							<h2>Thương hiệu</h2>
							<div class="brands-name">
                                @foreach($cat as $row) 
								<ul class="nav nav-pills nav-stacked">
									<li>
										<a href="/products/{{$row->id}}">
											{{$row->name}}</a>
									</li>
								</ul>
                                @endforeach
							</div>
						</div>

					</div>
					</div>
				<div class="col-sm-9 padding-right">
                    <div class="row latest-product">
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
                            <div class="row">   
                            @foreach($products as $phone)
                               <div class="col-md-3 element">
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
                                    </div>
                                </div>
                                </a>
                               </div>
                            @endforeach
                            </div>
                        </div>

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
