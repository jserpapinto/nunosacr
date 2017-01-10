@extends('frontend.layout')

@section('title', "$artist->name")

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
			<h1>{{ $artist->name }}</h1>
			<div class="ws-separator"></div>  
		</div> 

        <div class="row">            
            <div class="ws-shop-page">

            	@foreach ($works as $work)  
	                
                    @include('frontend.shared.workBlock', compact('work'))

                @endforeach
            </div>
        </div>
        {{ $works->links('vendor.pagination.default') }}
    </div>
@stop


@section('pagescripts')
<script>

    $('.parallax-window').parallax({imageSrc: '{{ asset("upload/artists/banner/$artist->imgBanner") }}'});

</script>
@endsection
