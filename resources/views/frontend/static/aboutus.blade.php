@extends('frontend.layout')

@section('title', 'About Us')

@section('content')

	<!-- Page Parallax Header -->
	<div class="ws-parallax-header parallax-window hidden-xs" >        
		<div class="ws-overlay-hard"></div>            
	</div>            
	<!-- End Page Parallax Header -->

<!-- Page Content -->
	<div class="container ws-page-container">
		<div class="ws-contact-offices text-center">
			<!-- Title -->
			<h1>About Us</h1>  
			<div class="ws-separator"></div>  
		</div> 

		<div class="row">
			<div class="ws-about-content col-sm-12">
		        <!-- Information -->
		        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor.</p>
		        <br>
		        <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat</p>  
		        <br>
		        <p>Nam liber tempor cum soluta nobis eleifend option congue nihil</p>  

		        <!-- Space Helper Class -->
		        <div class="padding-top-x70"></div>

		      

		        <!-- Process -->
		        <div class="row vertical-align">
		            <div class="col-sm-6" data-sr='wait 0.1s, ease-in 20px'>       
		                <h3>{{ config('app.name') }}</h3>
		                <div class="ws-footer-separator"></div>               
		                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam</p>
		                <br>
		                <p>Quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat</p>
		                <br>
		                <p>Vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor.</p>
		            </div>

		            <div class="col-sm-6">
		                <img src="{{ asset('img/backgrounds/about.jpg') }} " alt="Alternative Text" class="img-responsive">
		            </div>                                    
		        </div> 
		    </div> 
		</div> 

	</div>


@include('frontend.shared.about')
@include('frontend.shared.subscribe')
<!-- End Page Content -->

@stop


@section('pagescripts')
<script>

	$('.parallax-window').parallax({imageSrc: '/img/backgrounds/galeria.jpg'});

</script>
@endsection