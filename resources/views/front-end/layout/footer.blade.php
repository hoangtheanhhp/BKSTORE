<div class="footer-top-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="footer-about-us">
                    <h2>BK<span>Store</span></h2>
                    <p>BK Store Là sản phẩm của một nhóm sinh viên khoa Việt Nhật đại học Bách Khoa Hà Nội.
                        Nhóm rất mong được sự góp ý của mọi người </p>
                    <div class="footer-social">
                        <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="#"_blank"><i class="fa fa-youtube"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="footer-menu">
                    <h2 class="footer-wid-title">Truy cập nhanh </h2>
                    <ul>
                        <li><a href="/">Trang chủ</a></li>
                        <li><a href="{{url('products/all')}}">Cửa hàng</a></li>
                        <li><a href="/gio-hang">Giỏ hàng</a></li>
                        <li><a href="/dat-hang">Thanh toán</a></li>
                        <li><a href="/blog">Tin tức</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="footer-menu">
                    <h2 class="footer-wid-title">Danh mục</h2>
                    <ul>
                        @foreach($category as $row) 
                            <li><a href='/detail/{{$row->id}}'>{{$row->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div> <!-- End footer top area -->

<div class="footer-bottom-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="copyright">
                    <p>&copy;Sản phẩm được thuộc bản quyền của nhóm P714Plus. Sử dụng <a href="https://laravel.com/" target="_blank">Laravel Web</a></p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="footer-card-icon">
                    <i class="fa fa-cc-discover"></i>
                    <i class="fa fa-cc-mastercard"></i>
                    <i class="fa fa-cc-paypal"></i>
                    <i class="fa fa-cc-visa"></i>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End footer bottom area -->
