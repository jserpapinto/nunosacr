 <!-- Item -->
<div class="col-sm-6 col-md-4 ws-works-item">
    <a href="{{ action('Frontend\WorkController@solo', $work->slug) }}">                        
        <div class="ws-item-offer">
            <!-- Image -->                        
            <figure>                            
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

        <div class="ws-works-caption text-center">
        	@if ($work->artist_name)
	            <!-- Item Category -->
	            <div class="ws-item-category">{{ $work->artist_name }}</div>
	        @endif

            <!-- Title -->
            <h3 class="ws-item-title">{{ $work->name }}</h3>                        

            <div class="ws-item-separator"></div>   
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
            <a class="btn ws-btn-fullwidth">Buy Now</a>
        </div>
    </a>
</div>
<!-- .Item -->
