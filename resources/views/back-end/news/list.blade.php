@extends('back-end.layouts.master')
@section('content')
<!-- main content - noi dung chinh trong chu -->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="{!!(url('/admin/home'))!!}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Tin tức</li>
			</ol>
		</div><!--/.row-->
	
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Danh sách tin bản tin
						<a href="{!!url('admin/news/add')!!}" title=""><button type="button" class="btn btn-primary pull-right">Thêm tin mới</button></a>
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
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>										
										<th>ID</th>
										<th>Tác giả</th>
										<th>Người đăng</th>
										<th>Image</th>
										<th>Tiêu đề bản tin</th>										
										<th>Tóm tắt</th>
										<th>Thời gian</th>
										<th>Trạng thái</th>										
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								@foreach($data as $row)
									<tr>
										<td>{!!$row->id!!}</td>
										<td>{!! $row->author !!}</td>
										<td>{!! $row->name !!}</td>
										<td> <img src="{!!url('uploads/news/'.$row->images)!!}" alt="" width="40" height="40"> </td>
										<td>{!!$row->title!!}</td>
										<td><small>{!!$row->intro!!}</small></td>
										<td>{!! $row->created_at !!}</td>
										<td style="width: 90px;">
											@if($row->status==1)
											<span style="color: green">
											Hiển thị
											</span>
											@else
											<span style="color: #333">
											Tạm ẩn
											</span>
											@endif
										</td>
										<td style="width: 200px;">
										    <a href="{!!url('admin/news/edit/'.$row->id)!!}" title="Sửa"><span class="glyphicon glyphicon-edit">edit</span> </a>
										    <a href="{!!url('admin/news/del/'.$row->id)!!}"  title="Xóa" onclick="return xacnhan('Xóa danh mục này ?')"><span class="glyphicon glyphicon-remove">remove</span> </a>
										</td>
									</tr>	
								@endforeach								
								</tbody>
							</table>
						</div>
						{!!$data->render()!!}
					</div>
				</div>
			</div>
		</div><!--/.row-->		
	</div>	<!--/.main-->
<!-- =====================================main content - noi dung chinh trong chu -->
@endsection