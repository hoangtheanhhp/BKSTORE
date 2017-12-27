@extends('front-end.layout.master')
@section('pageTitle','BKSTORE:Tin tức')
@section('content')
<div class="container">
			<div class="row">
				<div class="col-sm-1">
					
				</div>
				<div class="col-sm-12 col-md-12">
					<div class="blog-post-area">
                        <h2 class="title text-center" style="margin-top: 20px;">Trang tin tức</h2>
							<div class="container-fluid">
								<div class="col-md-7 col-md-offset-1">
									<div class="row">
										@foreach($news as $new)
										<div class="single-blog-post">
											<h3>{{$new->title}}</h3>
											<div class="post-meta">
												<ul>
													<li><i class="fa fa-user"></i>{{$new->author}}</li>
													<li><i class="fa fa-clock-o"></i>{{$new->created_at->format('H:i a')}}</li>
													<li><i class="fa fa-calendar"></i>{{$new->created_at->format('M j, Y')}}</li>
												</ul>
											</div>
											<a href="/uploads/news/{{$new->images}}">
												<img src="/uploads/news/{{$new->images}}" class="img-reponsive" alt="{{$new->title}}" style="height: 300px;">
											</a>
											<div><?=$new->intro?></div>
											<a  class="btn btn-primary" href="/blog_detail/{{$new->id}}">Read More</a>
										</div>
										<hr/>
										@endforeach
									</div>
								</div>
								<div class="col-md-3 col-md-offset-1">
									<div class="row">
										@foreach($phones as $key => $phone)
											<div class="col-md-10 element col-md-offset-2">
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
											@if($key == 3)
												@break
											@endif
											<hr/>
										@endforeach
									</div>
								</div>
							</div>
					</div>
                </div>
                
			</div>
		</div>
@endsection('content')
