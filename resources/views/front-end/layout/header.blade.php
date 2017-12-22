<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="logo">
                    <h1><a href="#"><img src="/images/logo.png" class="img-reponsive" style="width:100px; height: 100px;"></a></h1>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="shopping-item">
                    <a href="{{url('gio-hang')}}" id='subtotal'>Cart - {{$cartTotal}}VND<span class="cart-amunt"></span> <i class="fa fa-shopping-cart"></i> <span class="product-count" id='countCart'>{{$cartTotalItems}}</span></a>
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
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{url('products/all')}}">Shop</a></li>
                    <li><a href="/gio-hang">Cart</a></li>
                    <li><a href="/dat-hang">Checkout</a></li>
                    <li><a href="/blog">Blog</a></li>
                </ul>
            </div>
        </div>
    </div>
</div> <!-- End mainmenu area -->
