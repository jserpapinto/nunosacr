 <!-- Item -->
<div class="col-sm-6 col-md-4 ws-works-item">
    <a href="{{ action('Frontend\WorkController@solo', $work->slug) }}">                        
        <div class="ws-item-offer">

            <!-- Image -->                        
            <figure>                      
                <button class="btn ws-btn-fullwidth btn-inside-img">{{ $work->price > 0 ? "Buy Now" : "Enquiry" }}</button>
                <img src="{{ asset("upload/works/midsize/$work->img") }}" alt="{{ $work->name }}" class="img-responsive">
            </figure>  
            @if ($work->discount > 0)
                <!-- Discount Caption -->
                <div class="ws-item-sale">
                    <span>Sale</span>
                </div>
            @elseif ($work->sold)
                <!-- Sold Caption -->
                <div class="ws-item-sold">
                    <span>Sold</span>
                </div>
            @endif                       
        </div>
    </a>

        <div class="ws-works-caption text-center">
        	@if ($work->artist_name)
	            <!-- Item Category -->
                @if ($work->artist_slug)
                <a href="{{ action('Frontend\ArtistController@solo', $work->artist_slug) }}">
                @endif
	               <div class="ws-item-category">{{ $work->artist_name }}</div>
                @if ($work->artist_slug)
                </a>
                @endif
	        @endif

            <!-- Title -->
            <a href="{{ action('Frontend\WorkController@solo', $work->slug) }}">                        
                <h3 class="ws-item-title">{{ $work->name }}</h3>                        
            </a>

            <div class="ws-item-separator"></div>   
            <!-- Price -->
            @if ($work->price > 0)
                <div class="ws-item-price">
                    @if ($work->discount > 0)
                        <del>{{ $work->price }} €</del> 
                        <ins>{{ $work->discount }} €</ins>
                    @else 
                        <ins>{{ $work->price }} €</ins>
                    @endif
                </div>
            @else
                <div class="ws-item-price">
                    <ins>Price on request</ins> 
                </div>
            @endif  
        </div>
    </a>
</div>
<!-- .Item -->
