@extends('front-end.layout.master')
@section('pageTitle','handsome')
@section('content')
<div class="container">
		<legend>
		<h3>Điện thoại {{$phone->name}}</h3>
		</legend>
		<h3><strong>{{$phone->intro}}</strong></h3>
		<div>
			<div class="col-md-6 col-sm-7">
				<div class="imgs col-sm-offset-2 col-sm-8">
					<img src="/images/phone/{{$phone->images}}" class="img-responsive">
					<div class="mili_imgs">
                        @foreach($img_detail as $img)
						<div>
							<img src="/images/phone/details/{{$img->images_url}}" class="img-responsive">
						</div>
                        @endforeach
					</div>
				</div>
				<hr/>
				
			</div>
			<div class="col-md-4 col-sm-5">
				<p class="price">Giá: <span class="text-danger" style="font-size: 30px;">{{number_format($phone->price)}}₫</span></p>
				<p class="tinh_trang"><h3 class="text-success">{{(intval($phone->number)==0)?'Hết hàng':'Còn hàng'}}</h3></p>
				<table>
				
                    @if ($phone->promo3!='')
                    <tr>
						<td><span class="fa fa-check-circle-o text-success"></span>{{$phone->promo3}}</td>
                    </tr>
                    @endif
                              @if ($phone->promo2!='')
                    <tr>
						<td><span class="fa fa-check-circle-o text-success"></span>{{$phone->promo2}}</td>
                    </tr>
                    @endif
                              @if ($phone->promo1!='')
                    <tr>
						<td><span class="fa fa-check-circle-o text-success"></span>{{$phone->promo1}}</td>
                    </tr>
                    @endif
				</table>
				<a href="/gio-hang/addcart/{{$phone->id}}"><button type="button" class="btn btn-warning">
					MUA NGAY<br>
					Giao tận nơi hoặc đén siêu thị xem hàng
				<hr>
				<p>Bộ bán hàng chuẩn: <b>{{$phone->packet}}</b></p>
				<p>Bảo hành chính hãng: <b>thân máy 1 năm, pin 1 năm, sạc 6 tháng, tai nghe 6 tháng</b><a href="#" class="text-primary"></p>
			</div>
			<div class="col-md-2"></div>
		</div>
		<div>
			<div class="col-sm-8 detail">
                <div><?=$phone->r_intro?></div>
				<p class='text-primary hide-button text-center'>Đọc thêm <span class='fa fa-caret-down'><span></p>
                <div class"hide"><?=$phone->review?></div>
			</div>
			<div class="col-sm-4">
				<table class="table table-striped table-hover">
					<legend>Thông số kỹ thuật</legend>
					<tbody>
						<tr>
							<td>Màn hình</td>
							<td>{{$phone_info->screen}}</td>
						</tr>
						<tr>
							<td>Hệ điều hành</td>
							<td>{{$phone_info->os}}</td>
						</tr>
						<tr>
							<td>Camera sau</td>
							<td>{{$phone_info->cam1}}</td>
						</tr>
						<tr>
							<td>Camera trước</td>
							<td>{{$phone_info->cam2}}</td>
						</tr>
						<tr>
							<td>CPU</td>
							<td>{{$phone_info->cpu}}</td>
						</tr>
						<tr>
							<td>RAM</td>
							<td>{{$phone_info->ram}}</td>
						</tr>
						<tr>
							<td>Bộ nhớ trong</td>
							<td>{{$phone_info->storage}}</td>
						</tr>
						<tr>
							<td>Thẻ nhớ</td>
							<td>{{$phone_info->exten_memmory}}</td>
						</tr>
						<tr>
							<td>Thẻ SIM</td>
							<td>{{$phone_info->sim}}</td>
						</tr>
						<tr>
							<td>Dung lượng PIN</td>
							<td>{{$phone_info->pin}}</td>
						</tr>
					</tbody>
				</table>

				<div>
					<h3>Các sản phẩm cùng hãng</h3>
					
					@foreach($phone_relate as $row)
					<div>
						<div class="col-xs-3">
							<img src="/images/phone/{{$row->images}}" class="img-responsive">
						</div>
						<div class="col-xs-9">
							<p><b class="text-primary">Điện thoại {{$row->name}}</b></p>
							<p class="price"><span class="text-danger">{{number_format($row->price)}}<sup><u>đ</u></sup></span></p>
							<div class="text-muted">
								<p>Màn hình: {{$row->screen}}</p>
								<p>HĐH: {{$row->os}}</p>
								<p>CPU: {{$row->cpu}}</p>
							</div>
						</div>
					</div>
					@endforeach
		
				</div>
			</div>
		</div>
    </div>
@endsection('content')
