@extends('templates.home')

@section('bodyAttributes')
	@if(isset($baconURL))
	 class="bacon-url-copy" data-clipboard-text="{{{ $baconURL }}}/{{{ $baconName }}}"
	@endif
@stop

@section('title')
@stop

@section('content')
<article>

	@if(count($errors))
		<div class="message message-error">
			<div class="message-container">
				@foreach ($errors as $error)
					<p>
						{{{ $error }}}
					</p>
				@endforeach
			</div>
		</div>
	@endif

	@if(isset($baconURL))
		<div class="message message-success" data-clipboard-text="{{{ $baconURL }}}/{{{ $baconName }}}">
			<div class="message-container">
				@if($flash_enabled == 1)
					Your URL has just become a heck more tasty! Tap anywhere to copy!
				@else
					Your URL has just become a heck more tasty! You can copy it below. Pretty sick bruh.
				@endif
			</div>
		</div>
		<div class="url-result">
			<textarea id="bacon_url" class="bacon-url-copy generated_bacon_url" data-clipboard-text="{{{ $baconURL }}}/{{{ $baconName }}}">{{{ $baconURL }}}/{{{ $baconName }}}</textarea>
			{{-- <a href="javascript:void(0);"  class="my_clip_button" title="test text" id="copy_button" data-clipboard-text="{{{ $baconURL }}}/{{{ $baconName }}}">{{{ $baconURL }}}/{{{ $baconName }}}</a> --}}
		</div>
		<p class="info">
			Got that fresh baconized scent in the air? Let's get some more URL's sizzlin' in the pan bro!
		</p>
	@else
		<p class="info">
			Slap in your URL below, and let's baconize dat bad boi.
		</p>
	@endif

	<div class="bacon-form">
		{!! Form::open(['action' => 'PagesController@create']) !!}
			{{--!! Form::label('url', 'URL:') !!--}}
			{!! Form::text('url', $submitted_url , ['class' => 'input bacon-url', 'placeholder' => 'www.example.com']) !!}
			{!! Form::hidden('flash_enabled', '0' , ['class' => 'flash_check']) !!}
			{!! Form::submit('Bacon my URL!', ['class' => 'submit bacon-submit']) !!}
		{!! Form::close() !!}
	</div>
</article>
@stop