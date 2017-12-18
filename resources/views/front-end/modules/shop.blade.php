@extends('front-end.layout.master')
@section('pageTitle', 'Quang pro')
@section('content')

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
                               <div class="col-md-2 element">
                                    <a href='/detail/{{$phone->id}}'>
                                 <div class="element">
                                    <div>
                                        <img src="/images/phone/{{$phone->images}}" class="img-responsive">
                                        <hr>
                                        <p class="name">
                                            <strong class="text-primary">{{$phone->name}}</strong>
                                        </p>
                                        <p class="price">
                                            <strong class="text-danger">{{number_format($phone->price)}}
                                                <sup>
                                                    <u>đ</u>
                                                </sup>
                                            </strong>
                                        </p>
                                        <p class="promotion text-muted">
                                            @if($phone->promo1!='')
                                            <p>Khuyến mãi:</p>
                                            <ul>
                                                <li>{{$phone->promo1}}</li>
                                                @if($phone->promo2!='')
                                                <li>{{$phone->promo2}}</li>
                                                @endif
                                                @if($phone->promo3!='')
                                                <li>{{$phone->promo3}}</li>
                                                @endif
                                            </ul>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="info">
                                        <p class="name"><strong class="text-primary">{{$phone->name}}</strong></p>
                                        <p class="price"><strong class="text-danger">{{number_format($phone->price)}}<sup><u>đ</u></sup></strong></p>
                                        <p>Màn hình: {{$phone->screen}}</p>
                                        <p>HĐH: {{$phone->os}}</p>
                                        <p>CPU: {{$phone->cpu}}</p>
                                        <p>RAM: {{$phone->ram}}, ROM: {{$phone->rom}}</p>
                                        <p>Camera: {{$phone->cam1}}, Selfie: {{$phone->cam2}}</p>
                                        <p>PIN: {{$phone->pin}}, SIM: {{$phone->sim}}</p>
                                    </div>
                                </div>
                                </a>
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
