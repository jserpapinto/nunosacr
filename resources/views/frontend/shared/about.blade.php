<!-- About Section -->
<section class="hidden-xs">
 <div class="ws-parallax-header parallax-window">
    <div class="ws-overlay-hard">            
        <div class="ws-parallax-caption">                
            <div class="ws-parallax-holder" >
                <div class="col-sm-6 col-sm-offset-3">
                    <h3 style="color: #fff">{{ config('app.name') }}</h3>         
                    <div class="ws-separator" style="background-color: #fff"></div>
                    @if (Request::is('contacts'))
                        <p>Rua de cima e baixo, 25<br>
                        4100-225 Porto. Portugal<br><br>
                        <abbr title="Phone">T</abbr> +351 223 439 195 / <abbr title="Email">E</abbr> jserpa.dev@gmail.com<br>
                        GPS 40º 36´ 102,36´´N 8º 393´ 57,73´´W</p>
                    @else
                        <p>Quisque velit nisi, pretium ut lacinia in, elementum id enim. Vivamus suscipit tortor eget felis porttitor volutpat. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                    @endif
                    <div class="btn ws-small-btn-white" style="margin-top: 30px; margin-bottom: 70px;""><a href="mailto:geral@nunosacramento.com.pt">CONTACT US</a></div>
                </div>
            </div>
        </div>    
    </div> 
</div>
</section>
<!-- End About Section --> 