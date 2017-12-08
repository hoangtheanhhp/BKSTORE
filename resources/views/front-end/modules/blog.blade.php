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
    @foreach($news as $new)

        <div class="container">
        <div class="col-sm-10">
        <div class="element">
            <div class="imgs col-sm-5" style="overflow: hidden;">
                <img src="/uploads/news/{{$new->images}}" class="img-responsive zoom">
            </div>
            <div class="inf col-sm-7">
                <a href="#"><h2>{{$new->title}}</h2></a>
                <div>
                    <span class="glyphicon glyphicon-user"><p>{{$new->author}}<p></span>
                    <span class="glyphicon glyphicon-calendar">{{$new->created_at->format('d-m-Y')}}</span>
                    <span>Intro: {{$new->intro}}</span>
                </div>
                <p>{{$new->full}}<p>
                <span>Source: {{$new->source}}</span>
            </div>

        </div>
        </div>
        </div>
    @endforeach

@endsection('content')
