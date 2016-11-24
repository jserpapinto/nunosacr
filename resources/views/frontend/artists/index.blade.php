@extends('frontend.layout')

@section('title', 'Artists')

@section('content')
    <!-- Page Parallax Header -->
    <div class="ws-parallax-header2 parallax-window hidden-xs" data-parallax="scroll" data-image-src="/img/backgrounds/galeria.jpg">        
        <div class="ws-overlay-hard"></div>            
    </div>            
    <!-- End Page Parallax Header -->

    <!-- Page Content -->
    <div class="container ws-page-container">
		<div class="ws-contact-offices text-center">
			<!-- Title -->
			<h2>Contact Form</h2>
			<div class="ws-separator"></div>  
		</div> 
	</div> 
@endsection

@section('pagescripts')
<script>
	$('.ws-parallax-header2').on('click', function() {
		console.log($(this).data('image-src'));
	   $(this).css({'background-image': $(this).data('image-src')})
	});
</script>
@endsection