@include('back-end.layouts.header')
<body>
@include('back-end.modules.top-nav')
@include('back-end.modules.left-nav')
	@yield('content')
@include('back-end.layouts.footer')
