<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    <style>

    </style>

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
<!-- Banner Ends Here -->
<div class="py-3 py-md-5 bg-light" >
    <div class="container" style="margin-top: 30px">
        <div class="row">
            <div class="col-md-5 mt-3">
                <div class="bg-white border">
                    <img src="{{ asset('products/'.$product->image) }}" class="w-100" alt="fauk">
                </div>
            </div>
            <div class="col-md-7 mt-3">
                <div class="product-view">
                    <h4 class="product-name">
                        {{$product->name}}
                        <label class="label-stock bg-success">In Stock</label>
                    </h4>

                    <hr>
                    <p class="product-path">
                        Home / Category / Product / HP Laptop
                    </p>
                    <div>
                        <span class="selling-price">$399</span>
                        <span class="original-price">$499</span>
                    </div>
                    <div class="mt-2">
                        <div class="input-group">
                            <span class="btn btn1"><i class="fa fa-minus"></i></span>
                            <input type="text" value="1" class="input-quantity" />
                            <span class="btn btn1"><i class="fa fa-plus"></i></span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <a href="" class="btn btn1"> <i class="fa fa-shopping-cart"></i> Add To Cart</a>
                        <a href="" class="btn btn1"> <i class="fa fa-heart"></i> Add To Wishlist </a>
                    </div>
                    <div class="mt-3">
                        <h5 class="mb-0">Product Detail</h5>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a ty
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="section-heading">
                <h2>Related Products</h2>
            </div>
        </div>
        @foreach($products as $product)
            <div class="col-md-3">
                <div class="product-card">
                    <div class="product-card-img" onclick="window.location='{{ url('product_detail', $product->id) }}';" style="height:120px;border-top-left-radius: 15px; border-top-right-radius: 15px;">
                        <label class="stock bg-success">In Stock</label>
                        <img  src="{{ asset('products/'.$product->image)}}" alt="Laptop">
                    </div>
                    <div class="product-card-body">
                        <p class="product-brand">HP</p>
                        <p class="product-quantity">{{$product->quantity}}</p>
                        <h5 class="product-name">
                            <a href="">
                                {{$product->name}}
                            </a>
                        </h5>
                        <div>
                            <span class="selling-price">{{$product->price}}</span>
                            <span class="original-price">{{$product->price}}</span>
                        </div>
                        <!--div class="mt-2">
                            <a href="" class="btn btn1">Add To Cart</a>
                            <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                            <a href="" class="btn btn1"> View </a>
                        </div-->
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>

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
