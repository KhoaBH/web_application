<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

<!-- ***** Preloader Start ***** -->
<div id="preloader">
    <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<!-- ***** Preloader End ***** -->

<!-- Header -->
@include('home.header')

<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="banner header-text">
    <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
            <div class="text-content">
                <h4>Best Offer</h4>
                <h2>New Arrivals On Sale</h2>
            </div>
        </div>
        <div class="banner-item-02">
            <div class="text-content">
                <h4>Flash Deals</h4>
                <h2>Get your best products</h2>
            </div>
        </div>
        <div class="banner-item-03">
            <div class="text-content">
                <h4>Last Minute</h4>
                <h2>Grab last minute deals</h2>
            </div>
        </div>
    </div>
</div>
<!-- Banner Ends Here -->

@include('home.product')
<div class="best-features">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>About Prime Picks</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="left-content" style="font-family: 'Montserrat', sans-serif;">
                    <h4>Looking for Quality Products?</h4>
                    <p><a rel="nofollow" href="https://templatemo.com/tm-546-sixteen-clothing" target="_parent">Prime Picks</a> is the place to find the finest products! <br>Let Prime Picks be your trusted shopping partner, offering the best products and excellent services!</p>
                    <ul class="featured-list">
                        <li><a href="#">Top Quality</a></li>
                        <li><a href="#">Variety</a></li>
                        <li><a href="#">Affordable Prices</a></li>
                        <li><a href="#">Customer Service Excellence</a></li>
                    </ul>
                    <a href="about.html" class="filled-button">Read More</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="right-image">
                    <img src="assets/images/feature-image.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

@if (Auth::check())
    @if(Auth::user()->user_type!="Seller")
        <div class="call-to-action">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="inner-content">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4>Creative &amp; Unique <em>Prime</em> Picks</h4>
                                    <p>Become a seller on Prime Picks and connect with millions of customers globally. List your products on a trusted platform with powerful tools to help grow your business and expand your reach.</p>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ url('/seller_register') }}" class="filled-button">Join Prime Picks</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="inner-content">
                    <p>Copyright &copy; 2024 Prime Picks Co., Ltd.
                        - Design: <a rel="nofollow noopener" href="https://templatemo.com" target="_blank">KHOADAUBU</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
@include('home.js')
</html>
