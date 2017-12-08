@extends('front-end.layout.master')
@section('pageTitle', 'Quang pro')
@section('content')

    {{--<div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>BK STORE</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
--}}

    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <div class="w3-sidebar w3-bar-block w3-border-right" style="display:none; background-color: #006dcc; height: 300px;" id="mySidebar">
                            <button onclick="w3_close()" class="w3-bar-item w3-large">Close &times;</button>
                            <a href="{{url('products/all')}}" class="w3-bar-item w3-button" style="color: #FFFFFF;">---- All</a>
                        @foreach($cat as $c)
                            <a href="{{url('products/'.$c->id)}}" class="w3-bar-item w3-button" style="color: #FFFFFF;">---- {{$c->name}}</a>
                            @endforeach
                        </div>
                        <h2 class="section-title">
                            @if($loai == 'all')
                            <button class="w3-button w3-teal w3-xlarge pull-left" onclick="w3_open()">☰</button> All Products
                            @else
                            <button class="w3-button w3-teal w3-xlarge pull-left" onclick="w3_open()">☰</button> {{App\Category::where('id','=',$loai)->first()->name}} Products
                            @endif
                                <form class="form-inline pull-right" method="POST" action="{{url('products/search')}}" style="margin-top: -10px;">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="search-products"></label>
                                        <input type="text" class="form-control" id="search" placeholder="Products Name" name="search" value="{{old('search')}}">
                                        <button type="submit" class="btn btn-success">Search Products</button>
                                    </div>
                                </form>
                                </h2>
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
                            <div class="row">
                            @foreach($products as $phone)
                                <div class="col-md-3" style="margin-top: 30px;">
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="/images/phone/{{$phone->images}}" alt="" style="max-width: 70%;">
                                        <div class="product-hover">
                                            <a href="{{url('/gio-hang/addcart/'.$phone->id)}}" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="/detail/{{$phone->id}}" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>

                                    <h2><a href="{{ url('/detail/'.$phone->id) }}">{{strtoupper($phone->name)}}</a></h2>

                                    <div class="product-carousel-price">
                                        @if($phone->promo1 == '')
                                            <ins>{{ $phone->price }}</ins>
                                        @else
                                            <ins>{{ $phone->price - $phone->promo1/100 * $phone->price }}$</ins> <del>{{$phone->price}}$</del>
                                        @endif
                                    </div>
                                </div>
                                </div>
                            @endforeach
                        </div>
                        </div>

                </div>
            </div>
        </div>
    </div> <!-- End main content area -->
    <script>
        function w3_open() {
            document.getElementById("mySidebar").style.display = "block";
        }
        function w3_close() {
            document.getElementById("mySidebar").style.display = "none";
        }
    </script>

@endsection('content')
