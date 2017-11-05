<!-- left menu - menu ben  trai	 -->
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Tìm kiếm ...">
			</div>
		</form>
		<ul class="nav menu">
			<li class="active"><a href="{!!url('admin/home/')!!}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Trang chủ</a></li>
			<li id="danhmuc"><a href="{!!url('admin/danhmuc')!!}"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Danh mục</a></li>

			<li id="sanpham"><a href="{!!url('admin/sanpham/all')!!}"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Sản phẩm </a></li>
			<li><a href="{!!url('admin/news')!!}"><span class="glyphicon glyphicon-file"></span> Tin tức</a></li>

			{{-- <li><a href="{!!url('admin/nhaphang')!!}"><svg class="glyph stroked download"><use xlink:href="#stroked-download"/></svg> Nhập hàng</a></li> --}}

			<li><a href="{!!url('admin/donhang')!!}"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Đơn đặt hàng</a></li>

			<li><a href="{!!url('admin/khachhang')!!}"><svg class="glyph stroked app-window"><use xlink:href="#stroked-line-graph"></use></svg>  Khách hàng</a></li>

			<li><a href="{!!url('admin/nhanvien')!!}"><svg class="glyph stroked female user"><use xlink:href="#stroked-female-user"/></svg> Nhân Viên</a></li>			
			
			<li role="presentation" class="divider"></li>
			<li><a href="{!!url('admin/khohang')!!}"><svg class="glyph stroked notepad "><use xlink:href="#stroked-notepad"/></svg>  Thông tin kho hàng</a></li>

			<li><a href="{!!url('admin/lichsu')!!}"><svg class="glyph stroked table"><use xlink:href="#stroked-table"/></svg> Lịch sử mua hàng</a></li>
		</ul>

	</div><!--/.sidebar-->
<!-- /left menu - menu ben  trai	 -->