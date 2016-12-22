@extends('frontend.layout')

@section('title', 'Artists')

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
			<h2>Gallery Artists</h2>
			<div class="ws-separator"></div>  
		</div> 

        <div class="row">            
            <div class="ws-shop-page">

            	@foreach ($allArtists as $artist)  
	                <!-- Item -->
	                <div class="col-sm-6 col-md-4 ws-works-item">
	                    <a href="{{ action('Frontend\ArtistController@solo', $artist->slug) }}">                        
	                        <div class="ws-item-offer">
	                            <!-- Image -->                        
	                            <figure>                            
	                                <img src="{{ asset("upload/artists/profile/midsize/$artist->img") }}" alt="Alternative Text" class="img-responsive">
	                            </figure>                    
	                        </div>

	                        <div class="ws-works-caption text-center">
	                            <!-- Item Category -->
	                            <!--<div class="ws-item-category">Abstract Prints</div>-->

	                            <!-- Title -->
	                            <h3 class="ws-item-title">{{ $artist->name }}</h3>                        

	                            <div class="ws-item-separator"></div>    
	                        </div>
	                    </a>
	                </div>
	                <!-- .Item -->
                @endforeach
            </div>
        </div>
		{{ $allArtists->links('vendor.pagination.default') }}
    </div>

@endsection

@section('pagescripts')
<script>

	$('.parallax-window').parallax({imageSrc: '/img/backgrounds/galeria.jpg'});

</script>
@endsection