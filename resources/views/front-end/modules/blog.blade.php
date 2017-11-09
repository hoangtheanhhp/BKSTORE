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
       <div class="col-sm-1"></div>

        <div class="col-sm-10">
        @foreach($news as $new)
        <div class="element">
            <div class="imgs col-sm-5" style="overflow: hidden;">
                <img src="images/news/{{$new->images}}" class="img-responsive zoom">
            </div>
            <div class="inf col-sm-7">
                <a href="#"><h2>{{$new->title}}</h2></a>
                <div>
                    <span class="glyphicon glyphicon-user"><p>{{$new->name}}<p></span>
                    <span class="glyphicon glyphicon-calendar">{{$new->created_at->format('d-m-Y')}}</span>
                    <span>Intro: {{$news->intro}}</span>
                </div>
                <p>{{$news->full}}<p>
                <span>Source: {{$news->source}}</span>
            </div>

        </div>
        @endforeach







    </div>
    <div class="col-sm-1">
    </div>
@endsection('content')
