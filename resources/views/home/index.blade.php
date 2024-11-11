<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
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
                    <h2>About Sixteen Clothing</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="left-content" style="font-family: 'Montserrat', sans-serif;">
                    <h4>Tìm kiếm những sản phẩm chất lượng?</h4>
                    <p><a rel="nofollow" href="https://templatemo.com/tm-546-sixteen-clothing" target="_parent">Prime Picks</a> Nơi tụ hội những sản phẩm tinh túy nhất! <br>Hãy để Prime Picks trở thành đối tác mua sắm tin cậy của bạn, nơi mang đến những sản phẩm tinh túy và dịch vụ xuất sắc nhất!</p>
                    <ul class="featured-list">
                        <li><a href="#">Chất lượng đỉnh cao</a></li>
                        <li><a href="#">Sự đa dạng</a></li>
                        <li><a href="#">Giá cả hợp lý</a></li>
                        <li><a href="#">Dịch vụ khách hàng tận tâm</a></li>
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

<div class="call-to-action">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="inner-content">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Creative &amp; Unique <em>Prime</em> Picks</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque corporis amet elite author nulla.</p>
                        </div>
                        <div class="col-md-4">
                            <a href="#" class="filled-button">Purchase Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="inner-content">
                    <p>Copyright &copy; 2020 Sixteen Clothing Co., Ltd.
                        - Design: <a rel="nofollow noopener" href="https://templatemo.com" target="_blank">TemplateMo</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
@include('home.js')
</html>
