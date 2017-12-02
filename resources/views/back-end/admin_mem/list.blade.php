@extends('back-end.layouts.master')
@section('content')
<!-- main content - noi dung chinh trong chu -->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Nhân Viên</li>
			</ol>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<div class="row">
				<div class="col-md-4 panel-heading">
					Danh sách nhân viên
				</div>
				@if(Auth::guard('admin')->user()->level == 1)
                        <div class="col-md-offset-2 col-md-3">
						<a type="submit" class="btn btn-success" href="{{url('admin/getRegister')}}">
						Đăng ký nhân viên mới
				        </a>
						</div>
				</div>
				@endif
				@if ($message = Session::get('success'))
			        <div class="alert alert-success">
			            <p>{{ $message }}</p>
			        </div>
			    @endif
			    	@if ($message = Session::get('danger'))
			        <div class="alert alert-danger">
			            <p>{{ $message }}</p>
			        </div>
			    @endif
				<div class="panel panel-default">
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
					<div class="panel-body" style="font-size: 13px;">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Tên nhân viên</th>
										<th>Email</th>
										<th>Quyền</th>
										<th>Ngày đăng ký</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $row)
										<tr>
											<td>{!!$row->name!!}</td>
											<td>{!!$row->email!!}</td>
											<td>
												@if($row->level ==1)
													<span style="color:#d35400;">Quản trị hệ thống</span>
												@else
													<span style="color:#27ae60;">Quản trị viên</span>
												@endif
											</td>
											<td>{!!$row->created_at!!}</td>
											<td>
											    @if ($row->level !=1 && $row->name != Auth::guard('admin')->user()->name)
                                                    <a href="{!!url('admin/nhanvien/edit/'.$row->id)!!}" title="Chi tiết"> Cập nhật</a>
                                                    <a href="{!!url('admin/nhanvien/del/'.$row->id)!!}"  title="Xóa" onclick="return xacnhan('Xóa danh mục này ?')">Xóa bỏ</a>
											    @endif
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						{!! $data->render() !!}
					</div>
				</div>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
<!-- =====================================main content - noi dung chinh trong chu -->
@endsection
