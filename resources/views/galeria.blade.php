@extends('template/generic')

@section('title','Galeria')

@section('h2','Galeria')

@section('content')
	<header>
		<h4>Galeria</h4>
	</header>
	<hr>

	<div class="row">
		<div class="col-md-4">
			<img src="{{ asset('images/pic01.jpg') }}" class="img-responsive" alt="">
		</div>
		<div class="col-md-4">
			<img src="{{ asset('images/pic01.jpg') }}" class="img-responsive" alt="">
		</div>
		<div class="col-md-4">
			<img src="{{ asset('images/pic01.jpg') }}" class="img-responsive" alt="">
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-4">
			<img src="{{ asset('images/pic01.jpg') }}" class="img-responsive" alt="">
		</div>
		<div class="col-md-4">
			<img src="{{ asset('images/pic01.jpg') }}" class="img-responsive" alt="">
		</div>
		<div class="col-md-4">
			<img src="{{ asset('images/pic01.jpg') }}" class="img-responsive" alt="">
		</div>
	</div><br>
	<div class="row">
		<div class="col-md-4">
			<img src="{{ asset('images/pic01.jpg') }}" class="img-responsive" alt="">
		</div>
		<div class="col-md-4">
			<img src="{{ asset('images/pic01.jpg') }}" class="img-responsive" alt="">
		</div>
		<div class="col-md-4">
			<img src="{{ asset('images/pic01.jpg') }}" class="img-responsive" alt="">
		</div>
	</div>
@endsection