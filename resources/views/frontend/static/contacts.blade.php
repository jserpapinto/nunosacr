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



	@if (count($errors) > 0)
	    <div class="alert alert-danger col-xs-12">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif


	@if(session('success_status'))
		<div class="col-xs-12 alert alert-success">
			{{ session('success_status') }}
		</div>
	@endif
	@if(session('danger_status'))
		<div class="col-xs-12 alert alert-danger">
			{{ session('danger_status') }}
		</div>
	@endif


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
	                    {!! Form::text('name', null, ['class' => 'form-control text-center', 'placeholder' => 'Name']) !!}
	                </div>
	                <!-- .Name -->
	                <!-- Email -->
	                <div class="form-group">
	                    {!! Form::email('mail', null, ['class' => 'form-control text-center', 'placeholder' => 'Email']) !!}
	                </div>
	                <!-- .Email -->
	                <!-- Subject -->
	                <div class="form-group">
	                    {!! Form::text('subject', null, ['class' => 'form-control text-center', 'placeholder' => 'Subject']) !!}
	                </div>
	                <!-- .Subject -->
	                <!-- Message -->
	                <div class="form-group">
	                    {!! Form::textarea('message', null, ['class' => 'form-control text-center', 'placeholder' => 'Message']) !!}
	                </div>
	                <!-- .Message -->
	                <div id="btnSubmitBuyWork">
						{!! Form::submit('Send', ['class' => 'btn ws-big-btn ws-btn-fullwidth']) !!}
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