<!-- Stored in resources/views/layouts/app.blade.php -->

<html>
    <head>
        <title> @yield('title') - {{ config('app.name') }}</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Bootstrap 3 styles -->
        {!! Html::style('/css/bootstrap.min.css') !!}
        {!! Html::style('/css/app.css') !!}
        {!! Html::style('/css/bootstrap-material-design.min.css') !!}
        {{-- Html::style('/css/ripples.min.css') --}}
        {!! Html::style('/css/styles.css') !!}
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
                <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/admin">Home</a></li>
                        @if (Auth::user())
                            <li><a href="/admin/artistas">Artistas</a></li>
                            <li><a href="/admin/obras">Obras</a></li>
                            <li><a href="/admin/exposicoes">Exposições</a></li>
                            <!--<li><a href="/admin/press">Press</a></li>-->
                        @endif
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/admin/login') }}">Login</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/admin/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <li><a href="{{ url('/admin/register') }}">Novo utilizador</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        @show

        <div class="container">
            <di class="row">
                <div class="col-xs-8">
                    <h1>@yield('title')</h1>
                    <h4>@yield('subtitle')</h4>
                    @yield('addBtn')
                    <hr>
                </div>
                @yield('content')
            </div>
        </div>

        <footer>
            <div class="container">
                <div class="row">
                    <hr/>
                    <div class="col-xs-12 text-center">
                        <p>by jSerpa</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap 3 script -->
        {!! Html::script('/js/jquery-3.1.1.min.js') !!}
        {!! Html::script('/js/jquery-ui.min.js') !!}
        {!! Html::script('/js/bootstrap.min.js') !!}
        {!! Html::script('/js/admin/main.js') !!}

        @yield('pageScripts')
    </body>
</html>