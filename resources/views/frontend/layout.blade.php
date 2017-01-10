<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
        <title>@yield('title') - {{ config('app.name') }}</title>
        <meta name="description" content="Contemporary Art. Painting, Sculpture and Photography.">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">


        <!-- CSS Styles -->
        {!! Html::style('/css/bootstrap.min.css') !!}
        {!! Html::style('/css/main.css') !!}
        {!! Html::style('/css/frontend.css') !!}

        <!-- Animate CSS -->
        {!! Html::style('/css/animate.min.css') !!}

        <!-- Revolution Slider -->
        {!! Html::style('/js/plugins/revolution/css/settings.css') !!}
        {!! Html::style('/js/plugins/revolution/css/layers.css') !!}
        {!! Html::style('/js/plugins/revolution/css/navigation.css') !!}

        <!-- Owl Carousel -->
        {!! Html::style('/js/plugins/owl-carousel/owl.carousel.css') !!}

        <!-- Google Web Fonts -->           
        <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,700,900' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet"> 

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    </head>
    <body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Loader Start 
    <div id="preloader">
        <div class="preloader-container">
            <div class="sk-folding-cube">                
                <div class="sk-cube1 sk-cube"></div>
                <div class="sk-cube2 sk-cube"></div>                
                <div class="sk-cube4 sk-cube"></div>
                <div class="sk-cube3 sk-cube"></div>
            </div>
        </div>
    </div>
     End Loader Start -->

    <!-- Top Bar Start -->
    <div class="ws-topbar">
                <!-- Logo -->        
        <div class="ws-logo">
            <a href="/">
                <h1 style="color: white; line-height: 55px;">{{ config('app.name') }}</h1>
            </a>
        </div>

    </div> 
    <!-- Top Bar End -->

    <!-- Header Start -->
    <header class="ws-header ws-header-transparent ws-header-third">                            
                    
        <!-- Navbar -->       
        <nav class="navbar ws-navbar navbar-default">
            <div class="container">                
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>                    
                </div>
               
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="/">Home</a></li>
                        <li><a href="{!! action('Frontend\ArtistController@index') !!}">Artists</a></li>
                        <li><a href="{!! action('Frontend\WorkController@opportunities') !!}">Opportunities</a></li>
                        <li><a href="{!! action('Frontend\ExhibitionController@index') !!}">Exhibitions</a></li>
                        <li><a href="{!! action('HomeController@aboutus') !!}">About Us</a></li>        
                        <li><a href="{!! action('HomeController@contacts') !!}">Contact</a></li>                         
                    </ul>            
                </div>
            </div>
        </nav> 
    </header>
    <!-- End Header -->

    @section('content')
    @show

    <!-- Footer Start -->
    <footer class="ws-footer">       
        <div class="container">
            <div class="row">                                             

                <!-- About -->
                <div class="col-sm-6 ws-footer-col">                            
                    <h3>{{ config('app.name') }}</h3>
                    <div class="ws-footer-separator"></div>                                         
                    <div class="ws-footer-about">
                        <p>In the hope of providing the best service, together with the public, critics, curators, commissioners and collectors.</p>
                    </div>
                </div>

                <!-- Support Links -->
                <div class="col-sm-2 ws-footer-col">                    
                    <h3>Info</h3>   
                    <div class="ws-footer-separator"></div>                                         
                    <ul>
                        <li><a href="returns.html">Press</a></li>
                        <li><a href="contacts.html">Contact Us</a></li>                        
                    </ul>                    
                </div>  

                <!-- Social Links -->
                <div class="col-sm-2 ws-footer-col">                    
                    <h3>Social</h3>   
                    <div class="ws-footer-separator"></div>                                         
                    <ul class="ws-footer-social">
                        <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook-square fa-lg"></i> Facebook</a></li>
                        <li><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram fa-lg"></i> Instagram</a></li>
                    </ul>                    
                </div> 

                <!-- Shop -->
                <div class="col-sm-2 ws-footer-col">                    
                    <h3>Shop Now</h3>         
                    <div class="ws-footer-separator"></div>                                                     
                    <ul>
                        <li><a href="artists.html">Our Artists</a></li>
                        <li><a href="opportunities.html">Opportunities</a></li>                       
                    </ul>  
                </div>  
                   
            </div>
        </div>
    </footer>   
    <!-- Footer End -->

    <!-- Footer Bar Start -->
    <div class="ws-footer-bar"> 
        <div class="container">

            <!-- Copyright -->
            <div class="row"> 
            <div class="col-xs-12">
                <div class="pull-left">
                <p>All rights reserved &copy; 2016. By jSerpa@istec</p>       
            </div>
                </div>
                </div>
            
            <!-- Copyright -->

            <!-- Payments 
            <div class="pull-right">
                <ul class="ws-footer-payments">
                    <li><i class="fa fa-cc-visa fa-lg"></i></li>
                    <li><i class="fa fa-cc-paypal fa-lg"></i></li>
                    <li><i class="fa fa-cc-mastercard fa-lg"></i></li>
                </ul>       
            </div> -->
            
        </div>             
    </div>
    <!-- Footer Bar End -->

    <!-- Jquery -->
    {!! Html::script('/js/jquery-3.1.1.min.js') !!}

    <!-- Slider Revolution -->
    {!! Html::script('/js/plugins/revolution/js/jquery.themepunch.tools.min.js') !!}
    {!! Html::script('/js/plugins/revolution/js/jquery.themepunch.revolution.min.js') !!}

    <!-- Slider Revolution 5.0 Extensions  
        (Load Extensions only on Local File Systems !  
        The following part can be removed on Server for On Demand Loading) -->  
    {!! Html::script('/js/plugins/revolution/js/extensions/revolution.extension.actions.min.js') !!}
    {!! Html::script('/js/plugins/revolution/js/extensions/revolution.extension.carousel.min.js') !!}
    {!! Html::script('/js/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js') !!}
    {!! Html::script('/js/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js') !!}
    {!! Html::script('/js/plugins/revolution/js/extensions/revolution.extension.migration.min.js') !!}
    {!! Html::script('/js/plugins/revolution/js/extensions/revolution.extension.navigation.min.js') !!}
    {!! Html::script('/js/plugins/revolution/js/extensions/revolution.extension.parallax.min.js') !!}
    {!! Html::script('/js/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js') !!}
    {!! Html::script('/js/plugins/revolution/js/extensions/revolution.extension.video.min.js') !!}

    <!-- Scripts -->    
    {!! Html::script('/js/plugins/bootstrap.min.js') !!}
    {!! Html::script('/js/plugins/modernizr-2.8.3-respond-1.4.2.min.js') !!}
    {!! Html::script('/js/plugins/owl-carousel/owl.carousel.min.js') !!}
    {!! Html::script('/js/plugins/parallax.min.js') !!}
    {!! Html::script('/js/plugins/scrollReveal.min.js') !!}
    {!! Html::script('/js/plugins/bootstrap-dropdownhover.min.js') !!}
    {!! Html::script('/js/main.js') !!}
    @yield('pagescripts')
    </body>
</html>