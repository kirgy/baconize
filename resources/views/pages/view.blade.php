@extends('templates/home')

@section('title')
View
@stop

@section('content')
	<p>
		Click to view site for : <a href="{{{ $url }}}">{{{ $url }}}</a>
	</p>
@stop