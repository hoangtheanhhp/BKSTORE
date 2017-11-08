<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('pageTitle')</title>

  <!-- Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

  <!-- Bootstrap -->
<<<<<<< HEAD:resources/views/layout/master.blade.php
  <link rel="stylesheet" href="../css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../ustora/css/font-awesome.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="../ustora/css/owl.carousel.css">
  <link rel="stylesheet" href="../ustora/style.css">
  <link rel="stylesheet" href="../ustora/css/responsive.css">
=======
  <link rel="stylesheet" href="/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/css/font-awesome.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="/css/owl.carousel.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/responsive.css">
>>>>>>> 69da456c624063295269b99badef9a6e62179748:resources/views/front-end/layout/master.blade.php

  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
</head>
<body>

		@include('front-end.layout.header')
	<div class="rev-slider">
		@yield('content')
	</div> <!-- .container -->
		@include('front-end.layout.footer')



	<!-- include js files -->
  <!-- Latest jQuery form server -->
  <script src="https://code.jquery.com/jquery.min.js"></script>

  <!-- Bootstrap JS form CDN -->
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

  <!-- jQuery sticky menu -->
  <script src="/js/owl.carousel.min.js"></script>
  <script src="/js/jquery.sticky.js"></script>

  <!-- jQuery easing -->
  <script src="/js/jquery.easing.1.3.min.js"></script>

  <!-- Main Script -->
  <script src="/js/main.js"></script>

  <!-- Slider -->
  <script type="text/javascript" src={{ asset('js/bxslider.min.js') }}></script>
  <script type="text/javascript" src="/js/script.slider.js"></script>
	<script>
	// $(document).ready(function($) {
	// 	$(window).scroll(function(){
	// 		if($(this).scrollTop()>150){
	// 		$(".header-bottom").addClass('fixNav')
	// 		}else{
	// 			$(".header-bottom").removeClass('fixNav')
	// 		}}
	// 	)
  //
	// })
	</script>
</body>
</html>
