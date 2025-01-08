<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    @include('home.js')
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
                        @if($product->quantity>0)
                            <label class="label-stock bg-success">In Stock</label>
                        @else
                            <label class="label-stock bg-danger">Out of Stock</label>
                        @endif
                    </h4>

                    <hr>
                    <p class="product-path">
                        Home / Category / Product / HP Laptop
                    </p>
                    <div>
                        <span class="selling-price">${{$product->discounted_price}}</span>
                        <span class="original-price">${{$product->price}}</span>
                    </div>
                    <div class="mt-2">
                        <div class="input-group">
                            <span class="btn btn1"><i class="fa fa-minus"></i></span>
                            <input type="text" value="1" class="input-quantity" />
                            <span class="btn btn1"><i class="fa fa-plus"></i></span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <a href="javascript:void(0);" class="btn btn1 addToCartBtn" data-product-id="{{$product->id}}">Add To Cart</a>
                        <a href="" class="btn btn1"> <i class="fa fa-heart"></i> Add To Wishlist </a>
                    </div>
                    <div class="mt-3">
                        <h5 class="mb-0">Product Detail</h5>
                        <p>
                            {{$product->description}}
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
        @foreach($products as $item)
            <div class="col-md-3" id="{{$item->id}}">
                <div class="product-card">
                    <div class="product-card-img" onclick="window.location='{{ url('product_detail', $item->id) }}';" style="height:220px; border-top-left-radius: 15px; border-top-right-radius: 15px; overflow: hidden;">
                        @if($product->quantity>0)
                            <label class="stock bg-success">In Stock</label>
                        @else
                            <label class="stock bg-danger">Out of Stock</label>
                        @endif
                        <img src="/products/{{$item->image}}" alt="Laptop" class="product-image">
                    </div>

                    <div class="product-card-body">
                        <p class="product-brand">HP</p>
                        <p class="product-quantity">{{$item->quantity}}</p>
                        <h5 class="product-name">
                            <a href="">{{ $item->name }}</a>
                        </h5>
                        <div>
                            <span class="selling-price">${{$item->discounted_price}}</span>
                            <span class="original-price">${{$item->price}}</span>
                        </div>
                        <div class="mt-2">
                            <a href="javascript:void(0);" class="btn btn1 addToCartBtn" data-product-id="{{$item->id}}">Add To Cart</a>
                            <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                            <a href="{{ url('product_detail', $item->id) }}" class="btn btn1"> View </a>
                        </div>
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
<style>
    .product-card-img {
        position: relative;
        width: 100%;
        height: 150px;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        overflow: hidden;
    }

    .product-card-img img.product-image {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Hoặc sử dụng 'object-fit: contain;' nếu bạn muốn giữ tỉ lệ của hình ảnh */
    }
</style>
</html>
