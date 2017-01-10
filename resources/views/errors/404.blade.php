@extends('frontend.layout')

@section('content')
 <!-- Page Parallax Header -->
    <div class="ws-parallax-header2 parallax-window hidden-xs">        
        <div class="ws-overlay-hard"></div>            
    </div>            

    <div class="container ws-page-container">
		<div class="ws-contact-offices text-center">
			<!-- Title -->
			<h2>404 - Page Not found</h2>
			<div class="ws-separator"></div>  
		</div> 

		<div class="row">
        	<div class="col-xs-12">
        		<h4 class="text-center">Continue to find more art works!</h4>
        	</div>
		</div>
		<hr/>
        <div class="row">            
            <div class="ws-shop-page">
            	<div class="col-xs-12 col-sm-4 error-btn">
            		<a href="{{ action('Frontend\ArtistController@index') }}" class="btn ws-btn-fullwidth full-width">Artists</a>
            	</div>
            	<div class="col-xs-12 col-sm-4 error-btn">
            		<a href="{{ action('Frontend\WorkController@opportunities') }}" class="btn ws-btn-fullwidth full-width">Opportunities</a>
            	</div>
            	<div class="col-xs-12 col-sm-4 error-btn">
            		<a href="{{ action('Frontend\ExhibitionController@index') }}" class="btn ws-btn-fullwidth full-width">Exhibitions</a>
            	</div>
            </div>
        </div>
    </div>

    @if (isset($featuredWorks))
    <section class="ws-arrivals-section">

        <div class="ws-works-title clearfix">
            <div class="col-sm-12">
                <h3>You may like</h3> 
                <div class="ws-separator"></div>   
            </div>
        </div>        

        <div id="ws-items-carousel">
            @foreach ($featuredWorks as $work)
                <!-- Item -->
                <div class="ws-works-item" data-sr='wait 0.1s, ease-in 20px'>
                    <a href="{!! action('Frontend\WorkController@solo', $work->slug) !!}">                        
                        <div class="ws-item-offer">
                            <!-- Image -->                        
                            <figure>                            
                                <img src="/upload/works/midsize/{{ $work->img }}" alt="#" class="img-responsive">
                            </figure>                    
                        </div>

                        <div class="ws-works-caption text-center">
                            <!-- Item Category -->
                            <div class="ws-item-category">{{ $work->artist_name }}</div>

                            <!-- Title -->
                            <h3 class="ws-item-title">{{ $work->name }}</h3>                        

                            <div class="ws-item-separator"></div>    

                            @if ($work->price)
                                <div class="ws-item-price">
                                    @if ($work->discount > 0)
                                        <del>{{ $work->price }} €</del> 
                                        <ins>{{ $work->discount }} €</ins>
                                    @else 
                                        <ins>{{ $work->price }} €</ins>
                                    @endif
                                </div>
                            @endif                                                    
                        </div>
                    </a>
                </div>
            @endforeach
            
        </div>
    </section>
    @endif
@stop

@section('pagescripts')
<script>

    $('.parallax-window').parallax({imageSrc: '{{ asset("upload/error/404.png") }}'});

</script>
@endsection
