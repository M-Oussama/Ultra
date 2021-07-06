@extends('layouts.app')

@section('page_meta')
    <title>Porto - Responsive HTML5 Template</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Porto - Responsive HTML5 Template">
    <meta name="author" content="okler.net">
@endsection

@section('styles')
    <!-- Page styles -->
@endsection

@section('scripts')
    <!-- Page scripts -->
@endsection

@section('content')
    <div class="owl-carousel-wrapper" style="height: 100vh;">
        <div class="owl-carousel dots-inside dots-horizontal-center show-dots-hover nav-inside nav-inside-plus nav-dark nav-md nav-font-size-md show-nav-hover mb-0" data-plugin-options="{'responsive': {'0': {'items': 1}, '479': {'items': 1}, '768': {'items': 1}, '979': {'items': 1}, '1199': {'items': 1}}, 'loop': false, 'autoHeight': false, 'margin': 0, 'dots': true, 'dotsVerticalOffset': '-75px', 'nav': true, 'animateIn': 'fadeIn', 'animateOut': 'fadeOut', 'mouseDrag': false, 'touchDrag': false, 'pullDrag': false, 'autoplay': true, 'autoplayTimeout': 9000, 'autoplayHoverPause': true, 'rewind': true}">

            <!-- Carousel Slide 1 -->
            <div class="position-relative pt-5" style="background-color: #35383d; height: 100vh;">
                <div class="position-absolute top-0 left-0 w-50pct w-lg-auto z-index-2">
                    <img src="porto/img/slides/slide-one-page-1-2.jpg" class="w-100 appear-animation" data-appear-animation="fadeInRightDownShorter" data-appear-animation-delay="500" alt="">
                </div>
                <div class="position-absolute top-0 right-0 w-50pct w-lg-auto z-index-2">
                    <img src="porto/img/slides/slide-one-page-1-3.jpg" class="w-100 appear-animation" data-appear-animation="fadeInLeftDownShorter" data-appear-animation-delay="500" alt="">
                </div>
                <div class="position-absolute bottom-0 left-0 w-50pct w-lg-auto z-index-2">
                    <img src="porto/img/slides/slide-one-page-1-4.jpg" class="w-100 appear-animation" data-appear-animation="fadeInRightUpShorter" data-appear-animation-delay="500" alt="">
                </div>
                <div class="position-absolute bottom-0 right-0 w-50pct w-lg-auto z-index-2">
                    <img src="porto/img/slides/slide-one-page-1-5.jpg" class="w-100 appear-animation" data-appear-animation="fadeInLeftUpShorter" data-appear-animation-delay="500" alt="">
                </div>

                <div class="container position-relative z-index-3 h-100">
                    <Div class="row justify-content-center align-items-center h-100">
                        <div class="col-lg-6">
                            <div class="d-flex flex-column align-items-center">
                                <h3 class="position-relative text-color-light text-4 line-height-5 font-weight-medium px-4 mb-3 appear-animation" data-appear-animation="fadeInDownShorterPlus" data-plugin-options="{'minWindowWidth': 0}">
                                    <span class="position-absolute right-100pct top-50pct transform3dy-n50 opacity-3">
                                        <img src="porto/img/slides/slide-title-border.png" class="w-auto appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
                                    </span>
                                        WE WORK HARD AND PORTO HAS
                                    <span class="position-absolute left-100pct top-50pct transform3dy-n50 opacity-3">
                                        <img src="porto/img/slides/slide-title-border.png" class="w-auto appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
                                    </span>
                                </h3>
                                <h2 class="text-color-light font-weight-extra-bold text-12 mb-4 appear-animation" data-appear-animation="blurIn" data-appear-animation-delay="500" data-plugin-options="{'minWindowWidth': 0}">
                                    THE <span class="position-relative">BEST<span class="position-absolute left-50pct transform3dx-n50 bottom-0"><img src="porto/img/slides/slide-blue-line-big.png" class="w-auto appear-animation" data-appear-animation="fadeInLeftShorterPlus" data-appear-animation-delay="1000" data-plugin-options="{'minWindowWidth': 0}" alt="" /></span></span> DESIGN
                                </h2>
                                <p class="text-4 text-color-light font-weight-light opacity-7 text-center mt-2 mb-4" data-plugin-animated-letters data-plugin-options="{'startDelay': 1000, 'minWindowWidth': 0, 'animationSpeed': 25}">Trusted by over <strong class="text-color-light">40,000</strong> satisfied users, Porto is a huge success in the one of larest world's MarketPlace</p>
                                <a href="#" class="btn btn-primary btn-rounded font-weight-bold text-3 px-5 py-3 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="1600">GET STARTED NOW!</a>
                            </div>
                        </div>
                    </Div>
                </div>
            </div>

            <!-- Carousel Slide 2 -->
            <div class="position-relative overlay overlay-show overlay-op-8 pt-5" style="background-image: url(porto/img/slides/slide-bg-2.jpg); background-size: cover; background-position: center; height: 100vh;">
                <div class="container position-relative z-index-3 h-100">
                    <Div class="row justify-content-center align-items-center h-100">
                        <div class="col-lg-6">
                            <div class="d-flex flex-column align-items-center">
                                <h3 class="position-relative text-color-light text-5 line-height-5 font-weight-medium px-4 mb-2 appear-animation" data-appear-animation="fadeInDownShorterPlus" data-plugin-options="{'minWindowWidth': 0}">
                                    <span class="position-absolute right-100pct top-50pct transform3dy-n50 opacity-3">
                                        <img src="porto/img/slides/slide-title-border.png" class="w-auto appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
                                    </span>
                                        WE WORK HARD AND PORTO HAS
                                    <span class="position-absolute left-100pct top-50pct transform3dy-n50 opacity-3">
                                        <img src="porto/img/slides/slide-title-border.png" class="w-auto appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
                                    </span>
                                </h3>
                                <h2 class="text-color-light font-weight-extra-bold text-12 mb-3 appear-animation" data-appear-animation="blurIn" data-appear-animation-delay="500" data-plugin-options="{'minWindowWidth': 0}">THE BEST DESIGN</h2>
                                <p class="text-4 text-color-light font-weight-light opacity-7 text-center mb-0" data-plugin-animated-letters data-plugin-options="{'startDelay': 1000, 'minWindowWidth': 0, 'animationSpeed': 25}">Trusted by over <strong class="text-color-light">40,000</strong> satisfied users, Porto is a huge success in the one of larest world's MarketPlace</p>
                            </div>
                        </div>
                    </Div>
                </div>
            </div>

            <!-- Carousel Slide 3 -->
            <div class="position-relative overlay overlay-show overlay-op-8 pt-5" style="background-image: url(porto/img/slides/slide-bg-6.jpg); background-size: cover; background-position: center; height: 100vh;">
                <div class="container position-relative z-index-3 h-100">
                    <Div class="row justify-content-center align-items-center h-100">
                        <div class="col-lg-6">
                            <div class="d-flex flex-column align-items-center">
                                <h3 class="position-relative text-color-light text-4 line-height-5 font-weight-medium px-4 mb-2 appear-animation" data-appear-animation="fadeInDownShorterPlus" data-plugin-options="{'minWindowWidth': 0}">
                                    <span class="position-absolute right-100pct top-50pct transform3dy-n50 opacity-3">
                                        <img src="porto/img/slides/slide-title-border.png" class="w-auto appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
                                    </span>
                                        WE CREATE DESIGNS, WE ARE
                                    <span class="position-absolute left-100pct top-50pct transform3dy-n50 opacity-3">
                                        <img src="porto/img/slides/slide-title-border.png" class="w-auto appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
                                    </span>
                                </h3>
                                <h2 class="porto-big-title text-color-light font-weight-extra-bold mb-3" data-plugin-animated-letters data-plugin-options="{'startDelay': 1000, 'minWindowWidth': 0, 'animationSpeed': 250, 'animationName': 'fadeInRightShorterOpacity', 'letterClass': 'd-inline-block'}">PORTO</h2>
                                <p class="text-4 text-color-light font-weight-light text-center mb-0" data-plugin-animated-letters data-plugin-options="{'startDelay': 2000, 'minWindowWidth': 0}">The best choice for your new website</p>
                            </div>
                        </div>
                    </Div>
                </div>
            </div>

            <!-- Carousel Slide 4 -->
            <div class="position-relative video overlay overlay-show overlay-op-8 pt-5" data-video-path="porto/video/memory-of-a-woman" data-plugin-video-background data-plugin-options="{'posterType': 'jpg', 'position': '50% 50%'}" style="height: 100vh;">
                <div class="container position-relative z-index-3 h-100">
                    <Div class="row justify-content-center align-items-center h-100">
                        <div class="col-lg-6">
                            <div class="d-flex flex-column align-items-center">
                                <h3 class="position-relative text-color-light text-5 line-height-5 font-weight-medium px-4 mb-2 appear-animation" data-appear-animation="fadeInDownShorterPlus" data-plugin-options="{'minWindowWidth': 0}">
                                    <span class="position-absolute right-100pct top-50pct transform3dy-n50 opacity-3">
                                        <img src="porto/img/slides/slide-title-border.png" class="w-auto appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
                                    </span>
                                        WE WORK HARD AND PORTO HAS
                                    <span class="position-absolute left-100pct top-50pct transform3dy-n50 opacity-3">
                                        <img src="porto/img/slides/slide-title-border.png" class="w-auto appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="250" data-plugin-options="{'minWindowWidth': 0}" alt="" />
                                    </span>
                                </h3>
                                <h2 class="text-color-light font-weight-extra-bold text-12 mb-3 appear-animation" data-appear-animation="blurIn" data-appear-animation-delay="500" data-plugin-options="{'minWindowWidth': 0}">THE BEST DESIGN</h2>
                                <p class="text-4 text-color-light font-weight-light opacity-7 text-center mb-0" data-plugin-animated-letters data-plugin-options="{'startDelay': 1000, 'minWindowWidth': 0, 'animationSpeed': 25}">Trusted by over <strong class="text-color-light">40,000</strong> satisfied users, Porto is a huge success in the one of largest world's MarketPlace<strong class="bg-light">Oi oi oi</strong></p>
                            </div>
                        </div>
                    </Div>
                </div>
            </div>

        </div>
    </div>
    <section id="services" class="section section-height-3 bg-primary border-0 m-0 appear-animation" data-appear-animation="fadeIn">
        <div class="container my-3">
            <div class="row mb-5">
                <div class="col text-center appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
                    <h2 class="font-weight-bold text-color-light mb-2">Services</h2>
                    <p class="text-color-light opacity-7">LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT</p>
                </div>
            </div>
            <div class="row mb-lg-4">
                <div class="col-lg-4 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="300">
                    <div class="feature-box feature-box-style-2">
                        <div class="feature-box-icon">
                            <i class="icons icon-support text-color-light"></i>
                        </div>
                        <div class="feature-box-info">
                            <h4 class="font-weight-bold text-color-light text-4 mb-2">CUSTOMER SUPPORT</h4>
                            <p class="text-color-light opacity-7">Lorem ipsum dolor sit amet, consectetur adipiscing <span class="alternative-font text-color-light">metus.</span> elit. Quisque rutrum pellentesque imperdiet.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 appear-animation" data-appear-animation="fadeInUpShorter">
                    <div class="feature-box feature-box-style-2">
                        <div class="feature-box-icon">
                            <i class="icons icon-layers text-color-light"></i>
                        </div>
                        <div class="feature-box-info">
                            <h4 class="font-weight-bold text-color-light text-4 mb-2">SLIDERS</h4>
                            <p class="text-color-light opacity-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="300">
                    <div class="feature-box feature-box-style-2">
                        <div class="feature-box-icon">
                            <i class="icons icon-menu text-color-light"></i>
                        </div>
                        <div class="feature-box-info">
                            <h4 class="font-weight-bold text-color-light text-4 mb-2">BUTTONS</h4>
                            <p class="text-color-light opacity-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="300">
                    <div class="feature-box feature-box-style-2">
                        <div class="feature-box-icon">
                            <i class="icons icon-doc text-color-light"></i>
                        </div>
                        <div class="feature-box-info">
                            <h4 class="font-weight-bold text-color-light text-4 mb-2">HTML5 / CSS3 / JS</h4>
                            <p class="text-color-light opacity-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 appear-animation" data-appear-animation="fadeInUpShorter">
                    <div class="feature-box feature-box-style-2">
                        <div class="feature-box-icon">
                            <i class="icons icon-user text-color-light"></i>
                        </div>
                        <div class="feature-box-info">
                            <h4 class="font-weight-bold text-color-light text-4 mb-2">ICONS</h4>
                            <p class="text-color-light opacity-7">Lorem ipsum dolor sit amet, consectetur adipiscing <span class="alternative-font text-color-light">metus.</span> elit. Quisque rutrum pellentesque imperdiet.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="300">
                    <div class="feature-box feature-box-style-2">
                        <div class="feature-box-icon">
                            <i class="icons icon-screen-desktop text-color-light"></i>
                        </div>
                        <div class="feature-box-info">
                            <h4 class="font-weight-bold text-color-light text-4 mb-2">LIGHTBOX</h4>
                            <p class="text-color-light opacity-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum pellentesque imperdiet. Nulla lacinia iaculis nulla.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="projects" class="container">
        <div class="row justify-content-center pt-5 mt-5">
            <div class="col-lg-9 text-center">
                <div class="appear-animation" data-appear-animation="fadeInUpShorter">
                    <h2 class="font-weight-bold mb-2">Projects</h2>
                    <p class="mb-4">LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT</p>
                </div>
                <p class="pb-3 mb-4 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce elementum, nulla vel pellentesque consequat, ante nulla hendrerit arcu, ac tincidunt mauris lacus sed leo. vamus suscipit molestie vestibulum.</p>
            </div>
        </div>
        <div class="row pb-5 mb-5">
            <div class="col">

                <div class="appear-animation popup-gallery-ajax" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
                    <div class="owl-carousel owl-theme mb-0" data-plugin-options="{'items': 4, 'margin': 35, 'loop': false}">

                        <div class="portfolio-item">
                            <a href="porto/ajax/portfolio-ajax-project.html" data-ajax-on-modal>
                                <span class="thumb-info thumb-info-lighten">
                                    <span class="thumb-info-wrapper">
                                        <img src="porto/img/projects/project.jpg" class="img-fluid border-radius-0" alt="">
                                        <span class="thumb-info-title">
                                            <span class="thumb-info-inner">Presentation</span>
                                            <span class="thumb-info-type">Brand</span>
                                        </span>
                                        <span class="thumb-info-action">
                                            <span class="thumb-info-action-icon bg-dark opacity-8"><i class="fas fa-plus"></i></span>
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="portfolio-item">
                            <a href="porto/ajax/portfolio-ajax-project-1.html" data-ajax-on-modal>
                                <span class="thumb-info thumb-info-lighten">
                                    <span class="thumb-info-wrapper">
                                        <span class="owl-carousel owl-theme dots-inside m-0" data-plugin-options="{'items': 1, 'margin': 20, 'animateOut': 'fadeOut', 'autoplay': true, 'autoplayTimeout': 3000}"><span><img src="porto/img/projects/project-1.jpg" class="img-fluid border-radius-0" alt=""></span><span><img src="porto/img/projects/project-1-2.jpg" class="img-fluid border-radius-0" alt=""></span></span>
                                        <span class="thumb-info-title">
                                            <span class="thumb-info-inner">Porto Watch</span>
                                            <span class="thumb-info-type">Media</span>
                                        </span>
                                        <span class="thumb-info-action">
                                            <span class="thumb-info-action-icon bg-dark opacity-8"><i class="fas fa-plus"></i></span>
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="portfolio-item">
                            <a href="porto/ajax/portfolio-ajax-project-2.html" data-ajax-on-modal>
                                <span class="thumb-info thumb-info-lighten">
                                    <span class="thumb-info-wrapper">
                                        <img src="porto/img/projects/project-2.jpg" class="img-fluid border-radius-0" alt="">
                                        <span class="thumb-info-title">
                                            <span class="thumb-info-inner">Identity</span>
                                            <span class="thumb-info-type">Logo</span>
                                        </span>
                                        <span class="thumb-info-action">
                                            <span class="thumb-info-action-icon bg-dark opacity-8"><i class="fas fa-plus"></i></span>
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="portfolio-item">
                            <a href="porto/ajax/portfolio-ajax-project-3.html" data-ajax-on-modal>
                                <span class="thumb-info thumb-info-lighten">
                                    <span class="thumb-info-wrapper">
                                        <img src="porto/img/projects/project-27.jpg" class="img-fluid border-radius-0" alt="">
                                        <span class="thumb-info-title">
                                            <span class="thumb-info-inner">Porto Screens</span>
                                            <span class="thumb-info-type">Website</span>
                                        </span>
                                        <span class="thumb-info-action">
                                            <span class="thumb-info-action-icon bg-dark opacity-8"><i class="fas fa-plus"></i></span>
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="portfolio-item">
                            <a href="porto/ajax/portfolio-ajax-project-4.html" data-ajax-on-modal>
                                <span class="thumb-info thumb-info-lighten">
                                    <span class="thumb-info-wrapper">
                                        <img src="porto/img/projects/project-4.jpg" class="img-fluid border-radius-0" alt="">
                                        <span class="thumb-info-title">
                                            <span class="thumb-info-inner">Three Bottles</span>
                                            <span class="thumb-info-type">Logo</span>
                                        </span>
                                        <span class="thumb-info-action">
                                            <span class="thumb-info-action-icon bg-dark opacity-8"><i class="fas fa-plus"></i></span>
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="portfolio-item">
                            <a href="porto/ajax/portfolio-ajax-project-5.html" data-ajax-on-modal>
                                <span class="thumb-info thumb-info-lighten">
                                    <span class="thumb-info-wrapper">
                                        <img src="porto/img/projects/project-5.jpg" class="img-fluid border-radius-0" alt="">
                                        <span class="thumb-info-title">
                                            <span class="thumb-info-inner">Company T-Shirt</span>
                                            <span class="thumb-info-type">Brand</span>
                                        </span>
                                        <span class="thumb-info-action">
                                            <span class="thumb-info-action-icon bg-dark opacity-8"><i class="fas fa-plus"></i></span>
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="portfolio-item">
                            <a href="porto/ajax/portfolio-ajax-project-6.html" data-ajax-on-modal>
                                <span class="thumb-info thumb-info-lighten">
                                    <span class="thumb-info-wrapper">
                                        <img src="porto/img/projects/project-6.jpg" class="img-fluid border-radius-0" alt="">
                                        <span class="thumb-info-title">
                                            <span class="thumb-info-inner">Mobile Mockup</span>
                                            <span class="thumb-info-type">Website</span>
                                        </span>
                                        <span class="thumb-info-action">
                                            <span class="thumb-info-action-icon bg-dark opacity-8"><i class="fas fa-plus"></i></span>
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="portfolio-item">
                            <a href="porto/ajax/portfolio-ajax-project-7.html" data-ajax-on-modal>
                                <span class="thumb-info thumb-info-lighten">
                                    <span class="thumb-info-wrapper">
                                        <img src="porto/img/projects/project-7.jpg" class="img-fluid border-radius-0" alt="">
                                        <span class="thumb-info-title">
                                            <span class="thumb-info-inner">Porto Label</span>
                                            <span class="thumb-info-type">Media</span>
                                        </span>
                                        <span class="thumb-info-action">
                                            <span class="thumb-info-action-icon bg-dark opacity-8"><i class="fas fa-plus"></i></span>
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="portfolio-item">
                            <a href="" data-ajax-on-modal>
                                <span class="thumb-info thumb-info-lighten">
                                    <span class="thumb-info-wrapper">
                                        <img src="porto/img/projects/project-23.jpg" class="img-fluid border-radius-0" alt="">
                                        <span class="thumb-info-title">
                                            <span class="thumb-info-inner">Business Folders</span>
                                            <span class="thumb-info-type">Logo</span>
                                        </span>
                                        <span class="thumb-info-action">
                                            <span class="thumb-info-action-icon bg-dark opacity-8"><i class="fas fa-plus"></i></span>
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="portfolio-item">
                            <a href="" data-ajax-on-modal>
                                <span class="thumb-info thumb-info-lighten">
                                    <span class="thumb-info-wrapper">
                                        <img src="porto/img/projects/project-24.jpg" class="img-fluid border-radius-0" alt="">
                                        <span class="thumb-info-title">
                                            <span class="thumb-info-inner">Tablet Screen</span>
                                            <span class="thumb-info-type">Website</span>
                                        </span>
                                        <span class="thumb-info-action">
                                            <span class="thumb-info-action-icon bg-dark opacity-8"><i class="fas fa-plus"></i></span>
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="portfolio-item">
                            <a href="" data-ajax-on-modal>
                                <span class="thumb-info thumb-info-lighten">
                                    <span class="thumb-info-wrapper">
                                        <img src="porto/img/projects/project-25.jpg" class="img-fluid border-radius-0" alt="">
                                        <span class="thumb-info-title">
                                            <span class="thumb-info-inner">Black Watch</span>
                                            <span class="thumb-info-type">Media</span>
                                        </span>
                                        <span class="thumb-info-action">
                                            <span class="thumb-info-action-icon bg-dark opacity-8"><i class="fas fa-plus"></i></span>
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div class="portfolio-item">
                            <a href="" data-ajax-on-modal>
                                <span class="thumb-info thumb-info-lighten">
                                    <span class="thumb-info-wrapper">
                                        <img src="porto/img/projects/project-26.jpg" class="img-fluid border-radius-0" alt="">
                                        <span class="thumb-info-title">
                                            <span class="thumb-info-inner">Monitor Mockup</span>
                                            <span class="thumb-info-type">Website</span>
                                        </span>
                                        <span class="thumb-info-action">
                                            <span class="thumb-info-action-icon bg-dark opacity-8"><i class="fas fa-plus"></i></span>
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <section id="clients" class="section section-background section-height-4 overlay overlay-show overlay-op-9 border-0 m-0" style="background-image: url(porto/img/bg-one-page-1-1.jpg); background-size: cover; background-position: center;">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2 class="font-weight-bold text-color-light mb-2">We’re excited about Porto Template</h2>
                    <p class="text-color-light opacity-7">30,000 CUSTOMERS IN 100 COUNTRIES USE PORTO TEMPLATE. MEET OUR CUSTOMERS.</p>
                </div>
            </div>
            <div class="row text-center py-3 my-4">
                <div class="owl-carousel owl-theme carousel-center-active-item carousel-center-active-item-style-2 mb-0" data-plugin-options="{'responsive': {'0': {'items': 1}, '476': {'items': 1}, '768': {'items': 5}, '992': {'items': 7}, '1200': {'items': 7}}, 'autoplay': true, 'autoplayTimeout': 3000, 'dots': false}">
                    <div>
                        <img class="img-fluid" src="porto/img/logos/logo-light-1.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid" src="porto/img/logos/logo-light-2.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid" src="porto/img/logos/logo-light-3.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid" src="porto/img/logos/logo-light-4.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid" src="porto/img/logos/logo-light-5.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid" src="porto/img/logos/logo-light-6.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid" src="porto/img/logos/logo-light-4.png" alt="">
                    </div>
                    <div>
                        <img class="img-fluid" src="porto/img/logos/logo-light-2.png" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <div class="owl-carousel owl-theme nav-bottom rounded-nav mb-0" data-plugin-options="{'items': 1, 'loop': true, 'autoHeight': true}">
                        <div>
                            <div class="testimonial testimonial-style-2 testimonial-light testimonial-with-quotes testimonial-quotes-primary mb-0">
                                <blockquote>
                                    <p class="text-5 line-height-5 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget risus porta, tincidunt turpis at, interdum tortor. Suspendisse potenti.</p>
                                </blockquote>
                                <div class="testimonial-author">
                                    <p><strong class="font-weight-extra-bold text-2">- John Smith. Okler</strong></p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="testimonial testimonial-style-2 testimonial-light testimonial-with-quotes testimonial-quotes-primary mb-0">
                                <blockquote>
                                    <p class="text-5 line-height-5 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget risus porta, tincidunt turpis at, interdum tortor. Suspendisse potenti.</p>
                                </blockquote>
                                <div class="testimonial-author">
                                    <p><strong class="font-weight-extra-bold text-2">- John Smith. Okler</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div id="team" class="container pb-4">
        <div class="row pt-5 mt-5 mb-4">
            <div class="col text-center appear-animation" data-appear-animation="fadeInUpShorter">
                <h2 class="font-weight-bold mb-1">Team</h2>
                <p>LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT</p>
            </div>
        </div>
        <div class="row pb-5 mb-5 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
            <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                <span class="thumb-info thumb-info-hide-wrapper-bg thumb-info-no-zoom">
                    <span class="thumb-info-wrapper">
                        <a href="about-me.html">
                            <img src="porto/img/team/team-1.jpg" class="img-fluid" alt="">
                        </a>
                    </span>
                    <span class="thumb-info-caption">
                        <h3 class="font-weight-extra-bold text-color-dark text-4 line-height-1 mt-3 mb-0">John Doe</h3>
                        <span class="text-2 mb-0">CEO</span>
                        <span class="thumb-info-caption-text pt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ac ligula mi, non suscipitaccumsan</span>
                        <span class="thumb-info-social-icons">
                            <a target="_blank" href="http://www.facebook.com"><i class="fab fa-facebook-f"></i><span>Facebook</span></a>
                            <a href="http://www.twitter.com"><i class="fab fa-twitter"></i><span>Twitter</span></a>
                            <a href="http://www.linkedin.com"><i class="fab fa-linkedin-in"></i><span>Linkedin</span></a>
                        </span>
                    </span>
                </span>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                <span class="thumb-info thumb-info-hide-wrapper-bg thumb-info-no-zoom">
                    <span class="thumb-info-wrapper">
                        <a href="about-me.html">
                            <img src="porto/img/team/team-2.jpg" class="img-fluid" alt="">
                        </a>
                    </span>
                    <span class="thumb-info-caption">
                        <h3 class="font-weight-extra-bold text-color-dark text-4 line-height-1 mt-3 mb-0">Jessica Doe</h3>
                        <span class="text-2 mb-0">DESIGNER</span>
                        <span class="thumb-info-caption-text pt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ac ligula mi, non suscipitaccumsan</span>
                        <span class="thumb-info-social-icons">
                            <a target="_blank" href="http://www.facebook.com"><i class="fab fa-facebook-f"></i><span>Facebook</span></a>
                            <a href="http://www.twitter.com"><i class="fab fa-twitter"></i><span>Twitter</span></a>
                            <a href="http://www.linkedin.com"><i class="fab fa-linkedin-in"></i><span>Linkedin</span></a>
                        </span>
                    </span>
                </span>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4 mb-sm-0">
                <span class="thumb-info thumb-info-hide-wrapper-bg thumb-info-no-zoom">
                    <span class="thumb-info-wrapper">
                        <a href="about-me.html">
                            <img src="porto/img/team/team-3.jpg" class="img-fluid" alt="">
                        </a>
                    </span>
                    <span class="thumb-info-caption">
                        <h3 class="font-weight-extra-bold text-color-dark text-4 line-height-1 mt-3 mb-0">Ricki Doe</h3>
                        <span class="text-2 mb-0">DEVELOPER</span>
                        <span class="thumb-info-caption-text pt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ac ligula mi, non suscipitaccumsan</span>
                        <span class="thumb-info-social-icons">
                            <a target="_blank" href="http://www.facebook.com"><i class="fab fa-facebook-f"></i><span>Facebook</span></a>
                            <a href="http://www.twitter.com"><i class="fab fa-twitter"></i><span>Twitter</span></a>
                            <a href="http://www.linkedin.com"><i class="fab fa-linkedin-in"></i><span>Linkedin</span></a>
                        </span>
                    </span>
                </span>
            </div>
            <div class="col-sm-6 col-lg-3">
                <span class="thumb-info thumb-info-hide-wrapper-bg thumb-info-no-zoom">
                    <span class="thumb-info-wrapper">
                        <a href="about-me.html">
                            <img src="porto/img/team/team-4.jpg" class="img-fluid" alt="">
                        </a>
                    </span>
                    <span class="thumb-info-caption">
                        <h3 class="font-weight-extra-bold text-color-dark text-4 line-height-1 mt-3 mb-0">Melinda Doe</h3>
                        <span class="text-2 mb-0">SEO ANALYST</span>
                        <span class="thumb-info-caption-text pt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ac ligula mi, non suscipitaccumsan</span>
                        <span class="thumb-info-social-icons">
                            <a target="_blank" href="http://www.facebook.com"><i class="fab fa-facebook-f"></i><span>Facebook</span></a>
                            <a href="http://www.twitter.com"><i class="fab fa-twitter"></i><span>Twitter</span></a>
                            <a href="http://www.linkedin.com"><i class="fab fa-linkedin-in"></i><span>Linkedin</span></a>
                        </span>
                    </span>
                </span>
            </div>
        </div>
    </div>
@endsection
