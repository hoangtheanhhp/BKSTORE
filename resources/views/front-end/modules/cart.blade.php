@extends('front-end.layout.master')
@section('pageTitle','BKSTORE:Cart')
@section('content')

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
       <div id='update-alert'></div>
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                  <div class="single-sidebar">
                        <h2 class="sidebar-title">Giỏ hàng</h2>
                        <div>
                            @foreach($phone as $row)
                            <div id='phone{{$row->id}}'>
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
                <div class="col-md-9">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <form action="/cart-dat-hang" method="POST">
                                {{csrf_field()}}
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th>Xóa sản phẩm</th>
                                            <th>Hình ảnh</th>
                                            <th class="product-name">Tên sản phẩm</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product-quantity">Số lượng</th>
                                            <th class="product-subtotal">Giá</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($cart as $row)
                                        <tr class="cart_item">
                                            <td class="product-remove">
                                                <a title="Remove this item" class="remove" data-id="{{$row->id}}"  >×</a>
                                            </td>
                                            <td class="product-thumbnail">
                                                <a href="/detail/{{$row->id}}"><img width="145" height="300" alt="poster_1_up" class="shop_thumbnail" src="images/phone/{{$row->options['img']}}"></a>
                                            </td>

                                            <td class="product-name">
                                                <a href="/detail/{{$row->id}}">{{$row->name}}</a>
                                            </td>

                                            <td class="product-price">
                                                <span class="amount">{{number_format($row->price)}}VND</span>
                                            </td>

                                            <td class="product-quantity">
                                                <div class="quantity buttons_added">
                                                    <input type="number" data-id='{{$row->id}}' name="{{$row->id}}" size="200" class="input-text qty text" title="Qty" value="{{$row->qty}}" min="0" step="1">
                                                </div>
                                            </td>

                                            <td class="product-subtotal">
                                                <span class="amount" data-price='{{$row->price}}' id='price{{$row->id}}'>{{number_format($row->qty*$row->price)}}VND</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="6">
                                                <div class="btn btn-info" id='update'>Cập nhật giỏ hàng</div>
                                            </td>
                                        </tr>
                                        <tr>
                                        <div class="cart-collaterals col-md-offset-3 c">
                                            <div class="cart_totals ">
                                                <table cellspacing="0">
                                                    <h2>Tổng số</h2>

                                                    <tbody>
                                                    <tr class="cart-subtotal">
                                                        <th>Tổng số tiền</th>
                                                        <td><span class="amount subtotal">{{$subtotal}}VND</span></td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Tổng giá trị đơn hàng Total (+ 0%VAT)</th>
                                                        <td><strong><span class="amount subtotal">{{$total}}VND</span></strong> </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        </tr>
                                        <tr>
                                            <td class="actions" colspan="6">
                                                <input type="submit" value="Thanh Toán" class="checkout-button button alt wc-forward">
                                            </td>
                                        </tr>
                                        </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
	var items = [ 
	@foreach($cart as $item)
		{id: "{{$item->id}}", quantity: "{{$item->qty}}"},
	@endforeach
	];
	console.log(items);
	$(document).ready(function () {
		$('.remove').click(function () {
			var id = $(this).data("id");
            $(this).closest('tr').remove();
            $('#phone'+id).remove();
			removeItem(id); // remove tren server
			updateItems(id); // update mang items
		});
		// cap nhat quantity khi click input tang so luong
		$("input[type='number']").bind('change paste keyup',function () {
			console.log("okokok");
            var quantity = $(this).val();
			var id = $(this).data("id");
            if (quantity=='') quantity=0;
            console.log(id+' '+quantity);
			updateQuantity(id, quantity); // update den server
			updateProductTotal(); // update gia tung mat hang
		});
		// update item trong cart
		$('#update').click(function () {
			updateCart();
		});
	});
	// update so luong trong mang items
	function updateQuantity(id, quantity) {
		items.forEach(function (m) {
			if(m.id == id){
				m.quantity = quantity;
			}
		});
	}
	function updateItems(id) {
		items.forEach(function (m) {
			if(parseInt(m.id) == id){
				var index = items.indexOf(m);
				items.splice(index,1);
			}
		});
		updateProductTotal()
	}
	function updateCart() {
		jsonItems = JSON.stringify(items);
        console.log(jsonItems);
		$.ajax({
            data : {items : jsonItems},
            url : '/gio-hang/update',
            success: function (data) {
                $('#update-alert').html(' <div  class="alert alert-success"><p>Cập nhật thành công</></div>');
            }
        });
	}	
	function removeItem(id) {
        $.ajax({
            data : {id : id},
            url : '/gio-hang/xoa',
            success: function (data) {
            }
        });
    }
    // update total tren html detail
    function updateProductTotal() {
        var total = 0;
        var qty = 0;
    	items.forEach(function (m) {
    		var price = $('#price'+m.id).data("price");
            var price = price*m.quantity;
            $('#price'+m.id).html(price.toLocaleString('en')+"VND");
            total+=price;
            qty+=m.quantity;
    	});
        $('#subtotal').html("Giỏ hàng - "+total.toLocaleString('en')+"VND<span class='cart-amunt'></span> <i class='fa fa-shopping-cart'></i> <span class='product-count'>"+ parseInt(qty) +"</span>");
        $('.subtotal').html(total.toLocaleString('en')+"VND");
    }
</script>



    
  @endsection('content')
