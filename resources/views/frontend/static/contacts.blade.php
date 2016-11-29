@extends('frontend.layout')

@section('title', 'Contacts')

@section('content')

<!-- Page Parallax Header -->
<div class="ws-parallax-header2 parallax-window hidden-xs" data-parallax="scroll" data-image-src="assets/img/backgrounds/galeria.jpg">        
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


	<div class="row">            
		<div class="ws-contact-page">

			<!-- Contact Form -->
			<div class="col-sm-12">
				{!! Form::open(['action' => ["HomeController@contactsMail"],  'method' => "post", 'class' => 'form-horizontal ws-contact-form']) !!}

					<!-- Name -->
					<div class="form-group">
						<input type="text" class="form-control text-center" placeholder="Name">                        
					</div>

					<!-- Email -->
					<div class="form-group">
						<input type="email" class="form-control text-center" placeholder="Email">                        
					</div>

					<!-- Subject -->
					<div class="form-group">
						<input type="text" class="form-control text-center" placeholder="Subject">                        
					</div>

					<!-- Message -->
					<div class="form-group text-center">
						<textarea class="form-control text-center" rows="7" placeholder="Message"></textarea>
					</div>

					<!-- Submit Button -->
					<div class="form-group text-center">                        
						<a href="#x" class="btn ws-big-btn " style="width: 100%">Submit</a>                        
					</div>
				{!! Form::close() !!}
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