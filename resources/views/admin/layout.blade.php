<!-- Stored in resources/views/layouts/app.blade.php -->

<html>
    <head>
        <title> @yield('title') - {{ config('app.name') }}</title>

        <!-- Bootstrap 3 styles -->
        {!! Html::style('/css/bootstrap.min.css') !!}
        {!! Html::style('/css/nh-styles.css') !!}
    </head>
    <body>
        @section('navbar')
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="/admin/artistas">Artistas</a></li>
                        <li><a href="#contact">Obras</a></li>
                        <li><a href="#contact">Exposições</a></li>
                        <li><a href="#contact">Press</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        @show

        <div class="container">
            <h1>@yield('title')</h1>
            <h4>@yield('subtitle')</h4>
            @yield('content')
        </div>

        <!-- Bootstrap 3 script -->
        {!! Html::script('/js/bootstrap.min.js') !!}
    </body>
</html>