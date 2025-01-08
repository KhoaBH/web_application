<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
@include('home.header')
<div class="container" style="padding-top: 80px">
    <form action="{{ route('search_products') }}" method = 'get' style="width:100%;; margin-top:30px;padding:10px">
        <div class="d-flex" >
            <input name='search' class="form-control mr-2" type="search" placeholder="Search" aria-label="Search" style="width:20%">
            <input type="submit" href="{{ url('search_products') }}" class="btn btn-success d-flex align-items-center justify-content-center" value="Search">
        </div>
    </form>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3" id="{{$product->id}}">
                <div class="product-card">
                    <div class="product-card-img" onclick="window.location='{{ url('product_detail', $product->id) }}';" style="height:220px; border-top-left-radius: 15px; border-top-right-radius: 15px; overflow: hidden;">
                        <label class="stock bg-success">In Stock</label>
                        <img src="products/{{$product->image}}" alt="Laptop" class="product-image">
                    </div>

                    <div class="product-card-body">
                        <p class="product-brand">{{$product->business_name}}</p>
                        <p class="product-quantity">{{$product->quantity}}</p>
                        <h5 class="product-name">
                            <a href="">{{ $product->name }}</a>
                        </h5>
                        <div>
                            <span class="selling-price">${{$product->discounted_price}}</span>
                            <span class="original-price">${{$product->price}}</span>
                        </div>
                        <div class="mt-2">
                            <a href="javascript:void(0);" class="btn btn1 addToCartBtn" data-product-id="{{$product->id}}">Add To Cart</a>
                            <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                            <a href="{{ url('product_detail', $product->id) }}" class="btn btn1"> View </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="pagination">
        {{$products->links()}}
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
<style>
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

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
