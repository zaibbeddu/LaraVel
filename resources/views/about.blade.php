@extends('templates.default')

@section('title','About')

@section('content')
	<h1>ABOUTTTT</h1>
	@component('components.card',
	[
	
	'img_title'=>'Image About',
	'img_url'=>'http://lorempixel.com/400/200/'
	
	]
	
	)
	<p> <h3>Questa</h3> è una cosa molto carina!!! :P</p>
	@endcomponent

	@component('components.card')
	@slot('img_title','Image About')
	@slot('img_url','http://lorempixel.com/400/200/')
	
	)
	<p> <h3>Questa</h3> è una cosa molto carina2!!! :P</p>
	@endcomponent	
	
	@include('components.card')
	
@endsection

@section('footer')
	@parent
	
@endsection