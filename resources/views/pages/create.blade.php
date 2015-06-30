@extends('templates.home')

@section('title')
@stop

@section('content')
<article>
	
	@if(isset($errors))
		<div class="message message-error">
		@foreach ($errors as $error)
			<p>
				{{{ $error }}}
			</p>
		@endforeach
		</div>
	@endif

	@if(isset($baconURL))
		<p class="message message-success">
			Your URL has just become a heck more tasty!
		</p>
		<p>
			<a href="{{{ $baconURL }}}/{{{ $baconName }}}">{{{ $baconURL }}}/{{{ $baconName }}}</a>
		</p>
	@endif

	<div class="bacon-form">
		{!! Form::open(['action' => 'PagesController@create']) !!}
			{{--!! Form::label('url', 'URL:') !!--}}
			{!! Form::text('url', $submitted_url , ['class' => 'input bacon-url', 'placeholder' => 'www.example.com']) !!}
			{!! Form::submit('Bacon my URL!', ['class' => 'submit bacon-submit']) !!}
		{!! Form::close() !!}
	</div>
</article>
@stop