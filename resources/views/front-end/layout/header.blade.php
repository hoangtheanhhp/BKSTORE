<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="logo">
                    <h1><a href="/"><img src="/images/logo.png" class="img-reponsive" style="width:100px; height: 100px;"></a></h1>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="shopping-item">
                    <a href="{{url('gio-hang')}}" id='subtotal'>Giỏ hàng - {{$cartTotal}}VND<span class="cart-amunt"></span> <i class="fa fa-shopping-cart"></i> <span class="product-count" id='countCart'>{{$cartTotalItems}}</span></a>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End site branding area -->

<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse hmenu">
                <ul class="nav navbar-nav ">
                    <li id="homepage123"><a href="/">Trang chủ</a></li>
                    <li id="shop"><a href="{{url('products/all')}}">Cửa hàng</a></li>
                    <li id="cart"><a href="/gio-hang">Giỏ hàng</a></li>
                    <li id="payment"><a href="/dat-hang">Thanh toán</a></li>
                    <li id="blog"><a href="/blog">Tin tức</a></li>
                </ul>
            </div>
        </div>
    </div>
</div> <!-- End mainmenu area -->