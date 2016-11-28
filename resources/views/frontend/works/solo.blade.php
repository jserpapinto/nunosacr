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

                    <!-- Quantity -->
                    <div class="ws-product-quantity">
                        <a href="#" class="minus">-</a>
                            <input type="text" value="1" size="4">
                        <a href="#" class="plus">+</a>
                    </div>       
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
            <div id="mail-popup-close" onclick="depopup();">X</div>
            <div class="form-group">
                {{ csrf_field() }}
                <!-- Name -->
                <div class="input-group">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                </div>
                <!-- .Name -->
                <!-- Email -->
                <div class="input-group">
                    {!! Form::email('mail', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                </div>
                <!-- .Email -->
                <!-- Subject -->
                <div class="input-group">
                    {!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Subject']) !!}
                </div>
                <!-- .Subject -->
                <!-- Message -->
                <div class="input-group">
                    {!! Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'Message']) !!}
                </div>
                <!-- .Message -->
                <div id="btnSubmitBuyWork">
                    <a onclick="mailReq();" class="btn ws-btn-fullwidth">Send</a>
                </div>
            </div>
        </div>
    </div>
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
        dataTye: 'json',
        data: {
            _token: formToken,
            client_name: clientName,
            client_mail: clientMail,
            client_subject: clientSubject,
            client_message: clientMessage,
        },
        success: function(result) {
            console.log(result);
        },
        error: function(xhr, desc, err) {
           console.log(xhr, err); 
           console.log(xhr.responseText); 
        }
    })
}
</script>
@stop