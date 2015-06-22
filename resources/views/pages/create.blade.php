@extends('templates.home')

@section('title')
	Create
@stop

@section('content')

	<h2>
		posted: {{{ $url or 'None set'}}}
	</h2>

	@if(isset($errors))
		<div class="errors">
		@foreach ($errors as $error)
			<p>
				{{{ $error }}}
			</p>
		@endforeach
		</div>
	@endif

	@if(isset($baconURL))
		<p>
			Your URL has just become a heck more tasty!
		</p>
		<p>
			<a href="{{{ $baconURL }}}/{{{ $baconName }}}">{{{ $baconURL }}}/{{{ $baconName }}}</a>
		</p>
	@endif

	<div class="bacon-form">
		{!! Form::open(['action' => 'PagesController@create']) !!}
			{!! Form::label('url', 'URL:') !!}
			{!! Form::text('url', $submitted_url , ['class' => 'input']) !!}
			{!! Form::submit('Bacon my URL!') !!}
		{!! Form::close() !!}
	</div>
@stop