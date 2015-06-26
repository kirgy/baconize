<!DOCTYPE>
<html lang="en">
<head>
	<meta charset="utf-8">	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		Bacon URL
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
	</header>
	@yield('content')
	@include('parts.footer')

</div>
</body>
</html>