@extends('back-end.layouts.master')
@section('content')
<!-- main content - noi dung chinh trong chu -->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Sản phẩm</li>
			</ol>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-4">
                                <div class="form-group">
								<div class="col-md-12">
									<select name="sltCate" id="inputLoai" class="form-control">
						      			<option value="0">CHỌN MỘT THƯƠNG HIỆU</option>
										  @foreach ($cat as $key => $value) 
						      			<option value="{{$value->id}}"> {{$value->name}}</option>
										  @endforeach
									</select>
									<script>
									    document.getElementById("inputLoai").onchange = function() {
									        if (this.selectedIndex!==0) {
									            window.location.href = this.value;
									        }        
									    };
									</script>
								</div>
							</div>
                            </div>
							<div class="col-md-2">
								@if ($loai !='all')
									<a href="{!!url('admin/sanpham/'.$loai.'/getadd')!!}" title=""><button type="button" class="btn btn-primary pull-right">Thêm Mới Sản Phẩm</button></a>
								@endif
							</div>
                            <div class="col-sm-offset-0 col-sm-5 col-md-offset-0 col-md-5">
                                <form class="form-inline" method="POST" action="{{url('admin/sanpham/search-products/'.$loai)}}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="search-products"></label>
                                        <input type="text" class="form-control" id="search" placeholder="Products Name" name="search" value="{{old('search')}}" required="required">
                                        <button type="submit" class="btn btn-success">Search Products</button>
                                    </div>
                                </form>
                            </div>

						</div> 
						
					</div>
					@if (session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
					@endif
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
					<div class="panel-body" style="font-size: 12px;">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>										
										<th>Hình ảnh</th>
										<th>Tên sản phẩm</th>
										<th>Created_at</th>
                                        <th>Admin</th>
										<th>Thương hiệu</th>
										<th>Giá bán</th>
										<th>Trạng thái</th>
										<th>Last Update</th>
										<th>Số lượng</th>
										<th>Action</th>
										<th>Lịch sử</th>
										<th>Nhận xét</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $row)
										<tr>	
											<td> <img src="{!!url('images/phone/'.$row->images)!!}" alt="{{$row->name}}" width="50" height="40"></td>
											<td>{!!$row->name!!}</td>
											<td>{!!$row->created_at!!}</td>
                                            <td>{!! App\Admin_users::find(DB::table('admin_products')->Where('pro_id', '=', $row->id)
                                            ->Where('created_at','=', $row->created_at)->first()->admin_id)->first()->name !!}</td>
											<td>{!!$row->category->name!!}</td>
											<td>{!!$row->price!!} VND</td>
											<td>
												@if($row->status ==1)
													<span style="color:blue;">Còn hàng</span>
												@else
													Tạm hết hàng
												@endif
											</td>
											<td>
												{!! DB::table('admin_products')->Where('pro_id', '=',$row->id)->orderby('updated_at')->first()->updated_at !!}
											</td>
											<td>
												{{$row->number}}
											</td>
											<td>
											    <a href="{!!url('admin/sanpham/mobile/edit/'.$row->id)!!}" title="Sửa"><span class="glyphicon glyphicon-edit">edit</span> </a>
											    <a href="{!!url('admin/sanpham/del/'.$row->id)!!}"  title="Xóa" onclick="return xacnhan('Xóa danh mục này ?')"><span class="glyphicon glyphicon-remove">remove</span> </a>
											</td>
											<td>
												<a class="btn btn-info" href="{{url('admin/sanpham/history/'.$row->id)}}">Lịch sử</a>
											</td>
											<td> <a class="btn btn-primary" href="{{url('admin/sanpham/review/'.$row->id)}}">Review </a></td>
										</tr>
									@endforeach								
								</tbody>
							</table>
							{{$data->links()}}
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->		
	</div>	<!--/.main-->
<!-- =====================================main content - noi dung chinh trong chu -->
@endsection