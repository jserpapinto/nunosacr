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
            @if (
                    (isset($artist->cv) && !empty($artist->cv)) || 
                    (isset($artist->site) && !empty($artist->site)) ||
                    (isset($artist->email) && !empty($artist->email))
                )
                <div class="row">
                    <div class="col-xs-12">
                        @if (isset($artist->cv) && !empty($artist->cv))
                            <a target="_blank" class="btn btn-default" href="{{ asset('/upload/artists/cv/' . $artist->cv) }}">
                                <i class="fa fa-file-pdf-o"></i>
                            </a>
                        @endif
                        @if (isset($artist->site) && !empty($artist->site))
                            <a target="_blank" class="btn btn-default" href="{{ $artist->site }}">
                                <i class="fa fa-external-link"></i>
                            </a>
                        @endif
                        @if (isset($artist->email) && !empty($artist->email))
                            <a target="_blank" class="btn btn-default" href="mailto:{{ $artist->email }}">
                                <i class="fa fa-envelope"></i>
                            </a>
                        @endif
                    </div> 
                </div> 
                <div class="ws-separator clearfix"></div>  
            @endif
            @if ($artist->bio)
                <div class="col-xs-12">
                    <p>{{ $artist->bio }}</p>
                </div>
            @endif
		</div> 

        <div class="row">            
            <div class="ws-shop-page">

            	@foreach ($works as $work)  
	                
                    @include('frontend.shared.workBlock', compact('work'))

                @endforeach
            </div>
        </div>
        {{-- $works->links('vendor.pagination.default') --}}
    </div>
@stop


@section('pagescripts')
<script>

    $('.parallax-window').parallax({imageSrc: '{{ asset("upload/artists/banner/$artist->imgBanner") }}'});

</script>
@endsection
