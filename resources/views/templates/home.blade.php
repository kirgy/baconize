<!DOCTYPE>
<html lang="en" itemscope itemtype="http://schema.org/Article">
<head>
	@include('parts.meta')

	<title>
		Baconize.it - making URLs tasty since 2015
	</title>

	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>	
	<link href="/css/main.css" rel="stylesheet">
</head>
<body>
<div class="body-container">
	<header>
		@include('parts.nav')
		<h1>
			@yield('title')
		</h1>
		<div class="site-logo-wrapper">
			<img src="/img/baconize-logo.png" class="site-logo" />
		</div>
	</header>
	@yield('content')
	@include('parts.footer')

</div>
</body>
</html>