@extends('frontend.layout')

@section('title', 'Presses')

@section('content')
    <!-- Page Parallax Header -->
    <div class="ws-parallax-header2 parallax-window hidden-xs">        
        <div class="ws-overlay-hard"></div>            
    </div>            
    <!-- End Page Parallax Header -->


    <!-- Page Content -->
    <div class="container ws-page-container">
        <div class="row">            
            <div class="ws-journal-page">  

            @foreach($allPress as $press)


                <!-- Item -->
                <div class="col-sm-4 ws-journal-item">
                    <a target="_blank" href="{!! asset("upload/press/pdfs/$press->pdf") !!}">                                
                        <div class="ws-journal-image">
                            <figure>
                                <img src="{!! asset("upload/press/original/$press->img") !!}" alt="Alternative Text">
                            </figure>
                        </div>
                        <div class="ws-journal-caption">
                            <h3>{{ $press->name }}</h3>
                            <p>{{ $press->description }}</p>                                    
                        </div>                   
                        <!--<span class="ws-journal-category">Home</span>             -->
                    </a>                  
                </div>

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