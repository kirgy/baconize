<!DOCTYPE>
<html lang="en" itemscope itemtype="http://schema.org/Article">
<head>
	@include('parts.meta')

	<title>
		Baconize.it - making URLs tasty since 2015
	</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<!--<script src="/scripts/jquery.highlight.js"></script>-->
	<!--<script src="/scripts/jquery.highlighttextarea.js"></script>-->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>	
	<script src="/scripts/zeroclipboard-2.2.0/dist/ZeroClipboard.js"></script>
	<script src="/scripts/analytics.js"></script>

	<link href="/css/main.css" rel="stylesheet">
</head>
<body @yield('bodyAttributes')>
<div class="body-container">
	<header>
		@include('parts.nav')
		<div class="site-logo-wrapper">
			<a href="/"><img src="/img/baconize-logo.png" class="site-logo" /></a>
		</div>
		<h1>
			@yield('title')
		</h1>
	</header>
	@yield('content')
	@include('parts.footer')

</div>

<script src="/scripts/baconize-frontend.js"></script>
</body>
</html>