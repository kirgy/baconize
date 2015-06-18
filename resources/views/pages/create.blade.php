@extends('templates.home')

@section('title')
	Create
@stop

@section('content')

<h2>
	posted: {{{ $url or 'None set'}}}
</h2>
	<div class="bacon-form">
		{!! Form::open(['action' => 'PagesController@create']) !!}
			{!! Form::label('url', 'URL:') !!}
			{!! Form::text('url', null, ['class' => 'input']) !!}
			{!! Form::submit('Bacon my URL!') !!}
		{!! Form::close() !!}
	</div>
@stop