@extends('frontend.layout')

@section('title', "$work->name")

@section('content')
 <!-- Page Parallax Header -->
    <div class="ws-parallax-header2 parallax-window hidden-xs">        
        <div class="ws-overlay-hard"></div>            
    </div>            
    <!-- End Page Parallax Header -->

    <!-- Page Content -->
    <div class="container ws-page-container">
        <!-- Product Image Carousel -->
        <div class="col-sm-7">        
            <div id="ws-products-carousel" class="owl-carousel">
                <div class="item">
                    <img src="{{ asset("upload/works/original/$work->img") }}" class="img-responsive" alt="Alternative Text">
                </div>    
            </div>
        </div>

        <!-- Product Information -->
        <div class="col-sm-5">
            <div class="ws-product-content">
                <header>
                    <!-- Item Category -->
                    <div class="ws-item-category">{{ $artist->name }}</div>

                    <!-- Title -->
                    <h3 class="ws-item-title">{{ $work->name }}</h3>                        

                    <div class="ws-separator"></div>    
  
                    <!-- Price -->
                    @if ($work->price)
                        <div class="ws-item-price">
                            @if ($work->discount > 0)
                                <del>{{ $work->price }} €</del> 
                                <ins>{{ $work->discount }} €</ins>
                            @else 
                                <ins>{{ $work->price }} €</ins>
                            @endif
                        </div>
                    @endif 

                    <!-- Quantity 
                    <div class="ws-product-quantity">
                        <a href="#" class="minus">-</a>
                            <input type="text" value="1" size="4">
                        <a href="#" class="plus">+</a>
                    </div>      --> 
                </header>
                
                <div class="ws-product-details">
                    {{ $work->description }}
                </div>

                <!-- Button -->                         
                <a onclick="popup();" class="btn ws-btn-fullwidth">Buy Now</a><br><br><br>                   
            </div>
        </div>  
    </div>

    <div id="mail-overlay">
        <div id="mail-popup">
            <div id="mail-error" class="">
                
            </div>
            <div id="mail-popup-close" onclick="depopup();"><i class="fa fa-times"></i></div>

            <h2>Send us a message!</h2>  
            <div class="ws-separator"></div>  

            <div class="form-group ws-contact-form" id="mail-form">
                {{ csrf_field() }}
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
                    {!! Form::textarea('message', null, ['class' => 'form-control text-center', 'rows' => '5', 'placeholder' => 'Message']) !!}
                </div>
                <!-- .Message -->
                <div id="btnSubmitBuyWork">
                    <a onclick="mailReq();" class="btn ws-btn-fullwidth">Send</a>
                </div>
            </div>
            <div id="mail-success">
                <h3>Success!</h3>
                <p class="lead">Email has been sent!<br/>We will enter in contact with you briefly.<br/>Thank you!</p>
            </div>
        </div>
    </div>


    <section class="ws-arrivals-section">

        <div class="ws-works-title clearfix">
            <div class="col-sm-12">
                <h3>You may also like</h3> 
                <div class="ws-separator"></div>   
            </div>
        </div>        

        <div id="ws-items-carousel">

            @foreach ($featuredWorks as $work)
                <!-- Item -->
                <div class="ws-works-item" data-sr='wait 0.1s, ease-in 20px'>
                    <a href="{!! action('Frontend\WorkController@solo', $work->slug) !!}">                        
                        <div class="ws-item-offer">
                            <!-- Image -->                        
                            <figure>                            
                                <img src="/upload/works/midsize/{{ $work->img }}" alt="#" class="img-responsive">
                            </figure>                    
                        </div>

                        <div class="ws-works-caption text-center">
                            <!-- Item Category -->
                            <div class="ws-item-category">{{ $work->artist_name }}</div>

                            <!-- Title -->
                            <h3 class="ws-item-title">{{ $work->name }}</h3>                        

                            <div class="ws-item-separator"></div>    

                            @if ($work->price)
                                <div class="ws-item-price">
                                    @if ($work->discount > 0)
                                        <del>{{ $work->price }} €</del> 
                                        <ins>{{ $work->discount }} €</ins>
                                    @else 
                                        <ins>{{ $work->price }} €</ins>
                                    @endif
                                </div>
                            @endif                                                    
                        </div>
                    </a>
                </div>
            @endforeach
            
        </div>
    </section>
@stop

@section('pagescripts')
<script>
function popup () {
    $('#mail-overlay').fadeIn('fast');
    $('#mail-popup').fadeIn('slow');
}
function depopup () {
    $('#mail-overlay').fadeOut('fast');
    $('#mail-popup').fadeOut('slow');
}

function mailReq () {
    var clientName = $('input[name="name"]').val();
    var clientMail = $('input[name="mail"]').val();
    var clientSubject = $('input[name="subject"]').val();
    var clientMessage = $('textarea[name="message"]').val();
    var formToken = $('input[name="_token"]').val();

    $.ajax({
        url: '{!! action('Frontend\WorkController@buyWorkEmail', $work->slug) !!}',
        method: 'POST',
        data: {
            "_token": formToken,
            name: clientName,
            mail: clientMail,
            subject: clientSubject,
            message: clientMessage,
        },
        success: function(result) {
            $('#mail-form').fadeOut('fast');
            $('#mail-success').fadeIn('fast');
        },
        error: function(xhr, desc, err) {
            alert("err");
            console.log(xhr, "-", err);
            if (xhr.status == 500) {
                // Internal Server Error
                $('#mail-form').fadeOut('fast');
                $('#mail-error').html('<h3>Error!</h3>\
                    <p class="lead">Email could not be sent!<br/>Please try again briefly or contact us directly through the email <a href="mailto:ns@nunosacramento.com.pt">ns@nunosacramento.com.pt</a>.<br/>Thank you!</p>').fadeIn('fast');
            } else {
                // Bad Request
                let e = "<div class='alert alert-danger'>";
                Object.values(xhr.responseJSON).forEach(function(val, i) {
                    e += "<p>" + val + "<p/>";
                });
                e += "</div>";
                $('#mail-error').html(e).fadeIn('fast');
            }
        }
    })
}

// Banner parallax
$('.parallax-window').parallax({imageSrc: '{{ asset('upload/artists/banner/' . ($artist->imgBanner != "" ? $artist->imgBanner : 'default.jpg')) }}'});
</script>
@stop