@extends('front-end.layout.master')
@section('pageTitle','BKSTORE:Blog')
@section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Blog</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Page title area -->


    <div class="single-product-area">
        <div class="col-sm-9">
        @foreach($news as $new)
        <div class="element">
            <div class="imgs col-sm-5" style="overflow: hidden;">
                <img src="img/product-1.jpg" class="img-responsive zoom">
            </div>
            <div class="inf col-sm-7">
                <a href="#"><h2>{{$new->title}}</h2></a>
                <div>
                    <span class="glyphicon glyphicon-user"><a href="#">ThemeFTC</a></span>
                    <span>Catregories: <a href="#">Men’s Clothing</a>,<a href="#">Uncategorized</a></span>
                    <span class="glyphicon glyphicon-calendar">July 6, 2017 </span>
                    <span>Tag: <a href="#">Sticky</a></span>
                </div>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, itaque tenetur nam consequuntur optio. Voluptas totam doloremque illo consequuntur natus, non asperiores eos laborum iste ducimus. Quas dolore, dicta? Aspernatur debitis cumque consequuntur libero error est, ab cupiditate facere maiores ipsum quod, esse vitae officia dolore ullam sequi facilis magni. Facere laudantium debitis, deleniti molestiae nostrum enim alias dolor eius, esse quaerat animi nemo quisquam, adipisci ducimus voluptates quo autem!<br>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea ipsum eveniet aspernatur dolor temporibus, voluptatibus et dignissimos magnam natus itaque pariatur tempora eum, laborum praesentium. Sapiente in provident sed unde facilis aliquam, non est cupiditate necessitatibus animi incidunt, vero alias porro ipsam, dolores odit explicabo? Obcaecati, molestias, cumque. Eum, laboriosam?<br>
                </div>
        </div>
        @endforeach







    </div>
    <div class="col-sm-3 right">
        <div class="element">
            <span class="glyphicon glyphicon-plus">  CATEGORIES</span>
            <ul>
                <li><a href="#">Audio (1)</a></li>
                <li><a href="#">Fashion’s Star (2)</a></li>
                <li><a href="#">Gallery (1)</a></li>
                <li><a href="#">Men’s Clothing (2)</a></li>
                <li><a href="#">Uncategorized (6)</a></li>
                <li><a href="#">Video (1)</a></li>
                <li><a href="#">What’s New (2)</a></li>
            </ul>
        </div>
      </div>
    </div>
@endsection('content')
