@extends('frontend.layout')

@section('title', trans('frontend/index.title'))

@section('content')
<!-- Banner Content -->    
    <div id="ws-hero-fullscreen" class="rev_slider">
        <ul>   
            <li data-transition="fade" data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="2000">        
                <!-- Background Image -->
                <img src="{{ asset('/img/backgrounds/duma.jpg') }}" alt="Alternative Text" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10"> 

                <!-- Background Overlay -->
                <div class="tp-caption tp-shape tp-shapewrapper rs-parallaxlevel-0"  
                    data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                    data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
                    data-width="full"
                    data-height="full"
                    data-whitespace="nowrap"
                    data-transform_idle="o:1;"
                    data-transform_in="opacity:0;s:1500;e:Power3.easeInOut;" 
                    data-transform_out="s:300;s:300;" 
                    data-start="750" 
                    data-basealign="slide" 
                    data-responsive_offset="on" 
                    data-responsive="off"
                    style="z-index: 5;background-color:rgba(0, 0, 0, 0.30);border-color:rgba(0, 0, 0, 0.30);"> 
                </div>       

                <!-- Layer -->
                <div class="tp-caption ws-hero-title"  
                    data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                    data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','1']"                         
                    data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;"             
                    data-mask_in="x:0px;y:0px;" 
                    data-mask_out="x:0;y:0;" 
                    data-start="1000" 
                    data-responsive_offset="on" 
                    style="z-index: 6;"><h1>Duma - The Warrior Flowers</h1>
                </div>

                <!-- Layer -->
                <div class="tp-caption ws-hero-description"
                    data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                    data-y="['middle','middle','middle','middle']" data-voffset="['-50','-50','-50','-38']"             
                    data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;"          
                    data-mask_in="x:0px;y:0px;" 
                    data-mask_out="x:0;y:0;" 
                    data-start="1000"            
                    data-responsive_offset="on" 
                    style="z-index: 7;"><h4>Saturday 19th Nov, 16h. Until 19th Dec 2016</h4>                                
                </div>

                <!-- Button -->
                <div class="tp-caption btn ws-big-btn"
                    data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
                    data-y="['middle','middle','middle','middle']" data-voffset="['92','92','92','76']"                                    
                    data-transform_in="y:50px;opacity:0;s:1500;e:Power4.easeInOut;"             
                    data-start="1000"                      
                    data-responsive_offset="on" 
                    data-responsive="off"
                    style="z-index: 8;">BUY NOW
                </div>
            </li>
        </ul>    
        <div class="tp-static-layers"></div>
        <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>         
    </div>
    <!-- Banner Content -->    

    <!-- Exhibition Section Start -->
    <section class="ws-about-section">
        <div class="container">
            <div class="row">

                <!-- Description -->
                <div class="ws-about-content clearfix">
                    <div class="col-sm-8 col-sm-offset-2">
                        <h3>Duma</h3> 
                        <div class="ws-separator"></div>                      
                        <p>There is always an unknown part of the whole. Duma's characters are full of glamour, innocent but provocative, frail but also strong, dichotomies present in female but also human behaviour in general.</p>
                    </div>                
                </div>

                <!-- Featured Collections -->
                <div class="ws-featured-collections clearfix">
                    <!-- Item -->
                    <div class="col-sm-4 featured-collections-item">
                        <a href="#x">
                            <div class="thumbnail">
                                <img src="assets/img/works/duma/duma_ns01.jpg" alt="Duma">
                                <div class="ws-overlay">
                                </div>
                            </div>
                            <div class="ws-works-caption text-center">

                        <!-- Title -->
                        <h4 class="ws-item-title">The velvet warrior</h4>                        

                        <div class="ws-item-separator"></div>    

                        <!-- Price -->
                        <div class="ws-item-price"><del>2.100 €</del> <ins>2.000 €</ins></div>                                                    
                    </div>
                        </a>
                    </div>

                    <!-- Item -->
                    <div class="col-sm-4 featured-collections-item">
                        <a href="#x">
                            <div class="thumbnail">
                                <img src="assets/img/works/duma/duma_ns02.jpg" alt="Duma">
                                <div class="ws-overlay">
                                </div>
                            </div>
                            <div class="ws-works-caption text-center">

                        <!-- Title -->
                        <h4 class="ws-item-title">The young rebellion</h4>                        

                        <div class="ws-item-separator"></div>    

                        <!-- Price -->
                        <div class="ws-item-price"><ins>2.100 €</ins></div>                                                    
                    </div>
                        </a>
                    </div>

                    <!-- Item -->
                    <div class="col-sm-4 featured-collections-item">
                        <a href="#x">
                            <div class="thumbnail">
                                <img src="assets/img/works/duma/duma_ns03.jpg" alt="Duma">
                                <div class="ws-overlay">
                                </div>
                            </div>
                            <div class="ws-works-caption text-center">

                        <!-- Title -->
                        <h4 class="ws-item-title">General with a blooming heart</h4>                        

                        <div class="ws-item-separator"></div>    

                        <!-- Price -->
                        <div class="ws-item-price"><ins>2.500 €</ins></div>                                                    
                    </div>
                        </a>
                    </div>
                    
                    
                </div>

            </div>
        </div>
    </section>
    <!-- Exhibition Section End -->     

    <!-- Oportunities Section -->    
    <section class="ws-arrivals-section">

        <div class="ws-works-title clearfix">
            <div class="col-sm-12">
                <h3>Opportunities</h3> 
                <div class="ws-separator"></div>   
            </div>
        </div>        

        <div id="ws-items-carousel">

            <!-- Item -->
            <div class="ws-works-item" data-sr='wait 0.1s, ease-in 20px'>
                <a href="#">                        
                    <div class="ws-item-offer">
                        <!-- Image -->                        
                        <figure>                            
                            <img src="assets/img/works/gil_maia/01.jpg" alt="#" class="img-responsive">
                        </figure>                    
                    </div>

                    <div class="ws-works-caption text-center">
                        <!-- Item Category -->
                        <div class="ws-item-category">Gil Maia</div>

                        <!-- Title -->
                        <h3 class="ws-item-title">Untitled</h3>                        

                        <div class="ws-item-separator"></div>    

                        <!-- Price -->
                        <div class="ws-item-price"><del>3500 €</del> <ins>3000 €</ins></div>                                                    
                    </div>
                </a>
            </div>

            <!-- Item -->
            <div class="ws-works-item" data-sr='wait 0.1s, ease-in 20px'>
                <a href="#">                        
                    <div class="ws-item-offer">
                        <!-- Image -->                        
                        <figure>                            
                            <img src="assets/img/works/nuno_horta/02.jpg" alt="#" class="img-responsive">
                        </figure>                    
                    </div>

                    <div class="ws-works-caption text-center">
                        <!-- Item Category -->
                        <div class="ws-item-category">Nuno Horta</div>

                        <!-- Title -->
                        <h3 class="ws-item-title">Untitled</h3>                        

                        <div class="ws-item-separator"></div>    

                        <!-- Price -->
                        <div class="ws-item-price"><ins>3000 €</ins></div>                                                    
                    </div>
                </a>
            </div>

            <!-- Item -->
            <div class="ws-works-item" data-sr='wait 0.1s, ease-in 20px'>
                <a href="#">                        
                    <div class="ws-item-offer">
                        <!-- Image -->                        
                        <figure>                            
                            <img src="assets/img/works/juan_domingues/02.jpg" alt="#" class="img-responsive">
                        </figure>                    
                    </div>

                    <div class="ws-works-caption text-center">
                        <!-- Item Category -->
                        <div class="ws-item-category">Juan Domingues</div>

                        <!-- Title -->
                        <h3 class="ws-item-title">Untitled</h3>                        

                        <div class="ws-item-separator"></div>    

                        <!-- Price -->
                        <div class="ws-item-price"><ins>3000 €</ins></div>                                                    
                    </div>
                </a>
            </div>

            <!-- Item -->        
            <div class="ws-works-item" data-sr='wait 0.1s, ease-in 20px'>
                <a href="#">                        
                    <div class="ws-item-offer">
                        <!-- Image -->                        
                        <figure>                            
                            <img src="assets/img/works/traexler/01.jpg" alt="#" class="img-responsive">
                        </figure>                    
                    </div>

                    <div class="ws-works-caption text-center">
                        <!-- Item Category -->
                        <div class="ws-item-category">Traexler</div>

                        <!-- Title -->
                        <h3 class="ws-item-title">Untitled</h3>                        

                        <div class="ws-item-separator"></div>    

                        <!-- Price -->
                        <div class="ws-item-price"><ins>3000 €</ins></div>                                                    
                    </div>
                </a>
            </div>

            <!-- Item -->
            <div class="ws-works-item" data-sr='wait 0.1s, ease-in 20px'>
                <a href="#">                        
                    <div class="ws-item-offer">
                        <!-- Image -->                        
                        <figure>                            
                            <img src="assets/img/works/fabio_carneiro/01.jpg" alt="#" class="img-responsive">
                        </figure>                    
                    </div>

                    <div class="ws-works-caption text-center">
                        <!-- Item Category -->
                        <div class="ws-item-category">Fábio Carneiro</div>

                        <!-- Title -->
                        <h3 class="ws-item-title">Untitled</h3>                        

                        <div class="ws-item-separator"></div>    

                        <!-- Price -->
                        <div class="ws-item-price"><ins>3000 €</ins></div>                                                    
                    </div>
                </a>
            </div>

            <!-- Item -->
            <div class="ws-works-item" data-sr='wait 0.1s, ease-in 20px'>
                <a href="#">                        
                    <div class="ws-item-offer">
                        <!-- Image -->                        
                        <figure>                            
                            <img src="assets/img/works/gil_maia/02.jpg" alt="#" class="img-responsive">
                        </figure>                    
                    </div>

                    <div class="ws-works-caption text-center">
                        <!-- Item Category -->
                        <div class="ws-item-category">Gil Maia</div>

                        <!-- Title -->
                        <h3 class="ws-item-title">Untitled</h3>                        

                        <div class="ws-item-separator"></div>    

                        <!-- Price -->
                        <div class="ws-item-price"><ins>3000 €</ins></div>                                                    
                    </div>
                </a>
            </div>
            
        </div>
    </section>
    <!-- End Oportunities Section -->     

    <!-- Work Featured Start  -->
    <section class="ws-works-section">
        <div class="container">
            <div class="row">   

                <div class="ws-works-title">
                    <div class="col-sm-12">
                        <h3>Featured</h3> 
                        <div class="ws-separator"></div>   
                    </div>
                </div>

                <!-- Item -->
                <div class="col-sm-6 col-md-4 ws-works-item" data-sr='wait 0.1s, ease-in 20px'>
                    <a href="#">                        
                        <div class="ws-item-offer">
                            <!-- Image -->                        
                            <figure>                            
                                <img src="assets/img/works/duarte_vitoria/01.jpg" alt="#" class="img-responsive">
                            </figure>
                            <!-- Sale Caption -->
                            <div class="ws-item-sale">
                                <span>Sale</span>
                            </div>
                        </div>

                        <div class="ws-works-caption text-center">
                            <!-- Item Category -->
                            <div class="ws-item-category">Duarte Vitória</div>

                            <!-- Title -->
                            <h3 class="ws-item-title">Untitled</h3>                        

                            <div class="ws-item-separator"></div>    

                            <!-- Price -->
                            <div class="ws-item-price"><del>3000 €</del> <ins>2800 €</ins></div>                                                    
                        </div>
                    </a>
                </div>

                <!-- Item -->
                <div class="col-sm-6 col-md-4 ws-works-item" data-sr='wait 0.3s, ease-in 20px'>
                    <a href="#">                        
                        <div class="ws-item-offer">
                            <!-- Image -->                        
                            <figure>                            
                                <img src="assets/img/works/diogo_moreira/01.jpg" alt="#" class="img-responsive">
                            </figure>
                        </div>

                        <div class="ws-works-caption text-center">
                            <!-- Item Category -->
                            <div class="ws-item-category">Diogo Moreira</div>

                            <!-- Title -->
                            <h3 class="ws-item-title">Untitled</h3>                        

                            <div class="ws-item-separator"></div>    

                            <!-- Price -->
                            <div class="ws-item-price"><ins>2000 €</ins></div>                                                    
                        </div>
                    </a>
                </div>

                <!-- Item -->
                <div class="col-sm-6 col-md-4 ws-works-item" data-sr='wait 0.5s, ease-in 20px'>
                    <a href="#">
                        <!-- Image -->                        
                        <figure>                            
                            <img src="assets/img/works/nuno_raminhos/raminhos_ns01.jpg" alt="#" class="img-responsive">                
                        </figure>
                        <div class="ws-works-caption text-center">
                            <!-- Item Category -->
                            <div class="ws-item-category">Nuno Raminhos</div>

                            <!-- Title -->
                            <h3 class="ws-item-title">Untitled</h3>                        

                            <div class="ws-item-separator"></div>    

                            <!-- Price -->
                            <div class="ws-item-price">2000 €</div>                        
                        </div>
                    </a>
                </div>                 

                <!-- Item -->
                <div class="col-sm-6 col-md-4 ws-works-item" data-sr='wait 0.1s, ease-in 20px'>
                    <a href="#">
                        <!-- Image -->                        
                        <figure>                            
                            <img src="assets/img/works/elisabeth_leite/01.jpg" alt="#" class="img-responsive">
                        </figure>
                        <div class="ws-works-caption text-center">
                            <!-- Item Category -->
                            <div class="ws-item-category">Elizabeth Leite</div>

                            <!-- Title -->
                            <h3 class="ws-item-title">Untitled</h3>                        

                            <div class="ws-item-separator"></div>    

                            <!-- Price -->
                            <div class="ws-item-price">2000 €</div>                        
                        </div>
                    </a>
                </div>  

                <!-- Item -->
                <div class="col-sm-6 col-md-4 ws-works-item" data-sr='wait 0.3s, ease-in 20px'>
                    <a href="#">
                        <!-- Image -->                        
                        <figure>                            
                            <img src="assets/img/works/duarte_vitoria/02.jpg".jpg alt="#" class="img-responsive">
                        </figure>
                        <div class="ws-works-caption text-center">
                            <!-- Item Category -->
                            <div class="ws-item-category">Duarte Vitória</div>

                            <!-- Title -->
                            <h3 class="ws-item-title">Untitled</h3>                        

                            <div class="ws-item-separator"></div>    

                            <!-- Price -->
                            <div class="ws-item-price">2000 €</div>                        
                        </div>
                    </a>
                </div>  

                        <!-- Item -->
                <div class="col-sm-6 col-md-4 ws-works-item" data-sr='wait 0.1s, ease-in 20px'>
                    <a href="#">
                        <div class="ws-item-offer">
                            <!-- Image -->                        
                            <figure>                            
                                <img src="assets/img/works/nuno_horta/01.jpg" alt="#" class="img-responsive">
                            </figure>
                            <!-- Sale Caption -->
                            <div class="ws-item-sold">
                                <span>Sold</span>
                            </div>
                        </div>
                        <div class="ws-works-caption text-center">
                            <!-- Item Category -->
                            <div class="ws-item-category">Nuno Horta</div>

                            <!-- Title -->
                            <h3 class="ws-item-title">The Fisherman</h3>                        

                            <div class="ws-item-separator"></div>    

                            <!-- Price -->
                            <div class="ws-item-price"><del>2000 €</del> </div>                        
                        </div>
                    </a>
                </div>                                                                   

               

            </div>
        </div>
    </section>
    <!-- Work Featured End  -->

    <!-- About Section -->
       <section class="hidden-xs">
			<div class="ws-parallax-header parallax-window" data-parallax="scroll"  data-image-src="assets/img/backgrounds/wall.jpg">
            <div class="ws-overlay-hard">            
            <div class="ws-parallax-caption">                
                <div class="ws-parallax-holder" >
                    <div class="col-sm-6 col-sm-offset-3">
                        <h3 style="color: #fff">Nuno Sacramento Arte Contemporânea</h3>         
                        <div class="ws-separator" style="background-color: #fff"></div>                                                                          <p>In the hope of providing the best service, together with the publics, critics, curators, commissioners and collectors, we intend within the professionalism that characterizes us that our path. With the necessary determination and the risk inherent in this activity, we will continue to launch our motto: "Buying art is both a pleasure and an investment for the future".</p>
                        <!-- Button -->
                        <div class="btn ws-small-btn-white" style="margin-top: 30px; margin-bottom: 70px;"><a href="contacts.html">CONTACT US</a></div>
                    </div>
                </div>
            </div>    
            </div> 
        </div>
        </section>
    <!-- End About Section -->    

    <!-- Instagram Content -->
    <section id="ws-instagram-section">
        <div class="container">
            <div class="row vertical-align">

                <!-- Instagram Item -->
                <div class="col-sm-3 ws-instagram-item" data-sr='wait 0.1s, ease-in 20px'>
                    <a href="https://www.instagram.com/" target="_blank">
                        <img src="assets/img/works/gil_maia/02.jpg" alt="Alternative Text" class="img-responsive">
                    </a>
                </div>    

                <!-- Instagram Item -->
                <div class="col-sm-3 ws-instagram-item" data-sr='wait 0.1s, ease-in 20px'>
                    <a href="https://www.instagram.com/" target="_blank">
                        <img src="assets/img/works/duma/duma_ns03.jpg" alt="Alternative Text" class="img-responsive">
                    </a>
                </div>    

                <!-- Instagram Item -->
                <div class="col-sm-3 ws-instagram-item" data-sr='wait 0.3s, ease-in 20px'>
                    <a href="https://www.instagram.com/" target="_blank">
                        <img src="assets/img/works/fabio_carneiro/01.jpg" alt="Alternative Text" class="img-responsive">
                    </a>
                </div>   

                <!-- Instagram Item -->
                <div class="col-sm-3 ws-instagram-item" data-sr='wait 0.5s, ease-in 20px'>
                    <a href="https://www.instagram.com/" target="_blank">
                        <img src="assets/img/works/duma/duma_ns01.jpg" alt="#" class="img-responsive">
                    </a>
                </div>                                   
            </div>
        </div>
    </section>
    <!-- End Instagram Content -->
    
    <!-- Subscribe Section -->
    <section class="ws-subscribe-section">
        <div class="container">
            <div class="row">
                <!-- Subscribe Content -->
                <div class="ws-subscribe-content text-center clearfix">
                    <div class="col-sm-8 col-sm-offset-2">
                        <h3>Sign up our newsletter</h3>       
                        <div class="ws-separator"></div>                             
                        <!-- Form -->
                        <form class="form-inline">                            
                            <div class="form-group">                                
                                <input type="email" class="form-control" placeholder="Your email">
                            </div>   
                            <!-- Button -->                         
                            <a class="btn ws-btn-subscribe">Subscribe</a>                                      
                        </form>
                    </div>                
                </div>
            </div>          
        </div>
    </section>
    <!-- End Subscribe Section -->   
@endsection