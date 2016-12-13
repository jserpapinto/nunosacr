@extends('frontend.layout')

@section('title', 'Exhibitions')

@section('content')
    <!-- Page Parallax Header -->
    <div class="ws-parallax-header2 parallax-window hidden-xs">        
        <div class="ws-overlay-hard"></div>            
    </div>            
    <!-- End Page Parallax Header -->

    <!-- Page Content -->
    <div class="container ws-page-container">
		<div class="ws-contact-offices text-center">
			<!-- Title -->
			<h2>Exhibitions</h2>
			<div class="ws-separator"></div>  
		</div> 

        <div class="row">            
            <div class="ws-shop-page">

            	@foreach ($allExhibitions as $exhibition)  
	                <!-- Item -->
	                <div class="col-sm-6 col-md-6 ws-works-item">
	                    <a href="{{ action('Frontend\ExhibitionController@solo', $exhibition->slug) }}">                        
	                        <div class="ws-item-offer">
	                            <!-- Image -->                        
	                            <figure>                            
	                                <img src="{{ asset("upload/exhibitions/midsize/$exhibition->img") }}" alt="Alternative Text" class="img-responsive">
	                            </figure>                    
	                        </div>

	                        <div class="ws-works-caption text-center">
	                            <!-- Item Category -->
	                            <!--<div class="ws-item-category">Abstract Prints</div>-->

	                            <!-- Title -->
	                            <h3 class="ws-item-title">{{ $exhibition->title }}</h3>                        

	                            <div class="ws-item-separator"></div>    
	                        </div>
	                    </a>
	                </div>
	                <!-- .Item -->
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('pagescripts')
<script>

	$('.parallax-window').parallax({imageSrc: '/img/backgrounds/galeria.jpg'});

</script>
@endsection