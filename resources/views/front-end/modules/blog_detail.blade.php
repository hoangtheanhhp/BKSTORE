@extends('front-end.layout.master')
@section('pageTitle','BKSTORE:Tin tức')
@section('content')
<div class="container">
			<div class="row">
				<div class="col-sm-1">
					
				</div>
				<div class="col-sm-10">
					<div class="blog-post-area">
						<h2 class="title text-center"></h2>
						<div class="single-blog-post">
							<h1>{{$new->title}}</h1>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i>{{$new->author}}</li>
									<li><i class="fa fa-clock-o"></i>{{$new->created_at->format('H:i a')}}</li>
									<li><i class="fa fa-calendar"></i>{{$new->created_at->format('M j, Y')}}</li>
								</ul>
							</div>
							<a href="">
								<img src="uploads/news/{{$new->images}}" class="img-reponsive" alt="">
							</a>
							<div><?=$new->full?></div>
							<div class="pager-area">
								<ul class="pager pull-right">
									<li><a href="/blog_detail/{{$prev}}">Pre</a></li>
									<li><a href="/blog_detail/{{$next}}">Next</a></li>
								</ul>
							</div>
						</div>
					</div><!--/blog-post-area-->
				</div>	
			</div>
		</div>
@endsection('content')
