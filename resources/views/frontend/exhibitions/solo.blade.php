@extends('frontend.layout')

@section('title', "$exhibition->title")

@section('content')
 <!-- Page Parallax Header -->
    <div class="ws-parallax-header2 parallax-window hidden-xs">        
        <div class="ws-overlay-hard"></div>            
    </div>            
    <!-- End Page Parallax Header -->

    <!-- Page Content -->
    <div class="container ws-page-container">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2 ws-contact-offices text-center">
			<!-- Title -->
			<h1>{{ $exhibition->title }}</h1>
			<div class="ws-separator"></div>  
            <p>{{ $exhibition->description }}</p>
		</div> 

        <div class="row">
            <div class="col-xs-12">
                <iframe id="catalogIframe" src="http://{{ $exhibition->catalog }}" width="100%"></iframe>
            </div>
        </div>

        <div class="row">   
            <div class="ws-shop-page">

            	@foreach ($exhibitionWorks as $work)  
	                
                    @include('frontend.shared.workBlock', compact('work'))

                @endforeach
            </div>
        </div>
    </div>
@stop


@section('pagescripts')
<script>

    $('.parallax-window').parallax({imageSrc: '{{ asset("upload/exhibitions/banner/$exhibition->imgBanner") }}'});

</script>
@endsection