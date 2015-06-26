@extends('templates/home')

@section('title')
View
@stop

@section('content')
<article>
	<p>
		Click to view site for : <a href="{{{ $url }}}">{{{ $url }}}</a>
	</p>
</article>
@stop