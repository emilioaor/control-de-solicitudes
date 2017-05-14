<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')  }}">
	<link rel="stylesheet" href="{{ asset('css/styles.css')  }}">
	@yield('css')
    <title>@yield('title')</title>
</head>
<body>
	@if(Auth::check())
		@include('template.barLoginUser')
	@else
		@include('template.barMenu')
	@endif
	<header id="header-generic">
		<div class="container">
			<h1 class="text-center">Tu Nombre</h1>
		</div>
	</header>
	<section class="main">
		<div class="container">
			@if(count($errors) > 0)
				<div class="space-alert">
					<div class="alert alert-dismissible {{ ($errors['error_success']) ? 'alert-success' : 'alert-danger' }}">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<p>
							<ul>
								@foreach($errors['errors'] as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</p>
					</div>
				</div>
			@endif
			<div id="contentMain">
				@yield('content')
			</div>
			@if(Auth::check())
				@include('template.extra')
			@endif
		</div>
	</section>

	@include('template.footer')

	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js')  }}"></script>
	@yield('js')
</body>
</html>