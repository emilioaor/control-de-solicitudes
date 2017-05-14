<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')  }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css')  }}">
    <title>Tu Nombre</title>
</head>
<body>
    @if(Auth::check())
        @include('template.barLoginUser')
    @elses
        @include('template.barMenu')
    @endif
    <header class="header">
        <div class="container">
            <h1 class="text-center">Tu Nombre</h1>
            <p class="text-center">Buen lugar para tu slogan</p>
            <div class="text-center">
                <a href="{{ route('index.login') }}" class="btn-primary-page">Contratar</a>
            </div>
        </div>
    </header>
    <section class="zone1">
        <div class="container">
            <h2 class="text-center">DESCRIPCION DE LO QUE HACES</h2>
            <hr>
            <p class="text-center">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi ut officiis molestias molestiae rerum harum autem. Recusandae illum quibusdam, et expedita dignissimos nulla, eaque laudantium eius porro veritatis iure voluptatibus.
            </p>

            <h2 class="text-center">QUE OFRECES</h2>
            <hr>
            <p class="text-center">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates mollitia dignissimos harum delectus quia illum fuga! Dolores atque harum aperiam necessitatibus maiores sed perspiciatis nam quidem, quasi iusto accusamus sunt? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint aspernatur architecto, beatae voluptas doloribus tempore ut consequuntur saepe laudantium, deserunt cum accusantium possimus! Assumenda nisi eveniet repellendus minus, alias laudantium.
            </p>
        </div>
    </section>
    <section class="zone2">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="{{ asset('images/pic01.jpg') }}" class="img-responsive" alt="">
                </div>
                <div class="col-md-7">
                    <h3 class="text-center">TITULO</h3>
                    <p class="text-justify">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe qui illo eligendi, ea id ex, minus, molestias accusamus facere optio voluptatem sed voluptate natus. Vero debitis sapiente vel, voluptatum libero!
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <h3 class="text-center">TITULO</h3>
                    <p class="text-justify">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo praesentium aperiam, vitae ab fugit magni, sapiente, reiciendis deserunt sunt corporis maxime quos quam rem modi odit? Optio cum voluptate tempora!
                    </p>
                </div>
                <div class="col-md-5">
                    <img src="{{ asset('images/pic01.jpg') }}" class="img-responsive" alt="">
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <img src="{{ asset('images/pic01.jpg') }}" class="img-responsive" alt="">
                </div>
                <div class="col-md-7">
                    <h3 class="text-center">TITULO</h3>
                    <p class="text-justify">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt a facilis eligendi recusandae quisquam assumenda earum, minus quo consequuntur odio natus veniam, vero fuga repudiandae sequi doloribus corporis necessitatibus temporibus.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="zone3">
        <div class="container">
            <h2 class="text-center">¿QUE SERVICIOS OFRECEMOS?</h2>
            <div class="row">
                <div class="col-md-5 col-md-offset-1 services">
                    <h3>SERVICIO</h3>
                    <p>
                        Descrípcion del servicio.
                    </p>
                </div>
                <div class="col-md-5 services">
                    <h3>SERVICIO</h3>
                    <p>
                        Descrípcion del servicio.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 col-md-offset-1 services">
                    <h3>SERVICIO</h3>
                    <p>
                        Descrípcion del servicio.
                    </p>
                </div>
                <div class="col-md-5 services">
                    <h3>SERVICIO</h3>
                    <p>
                        Descrípcion del servicio.
                    </p>
                </div>
            </div>
        </div>
    </section>
    @include('template.footer')

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js')  }}"></script>
</body>
</html>
