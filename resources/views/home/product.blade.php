<div class="latest-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Latest Products</h2>
                    <a href="products.html">view all products <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
            @foreach($products as $product)
                <div class="col-md-3">
                    <div class="product-card">
                        <div class="product-card-img" onclick="window.location='{{ url('product_detail', $product->id) }}';" style="height:120px;border-top-left-radius: 15px; border-top-right-radius: 15px;">
                            <label class="stock bg-success">In Stock</label>
                            <img  src="products/{{$product->image}}" alt="Laptop">
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
                            <div class="mt-2">
                                <a href="" class="btn btn1">Add To Cart</a>
                                <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                <a href="" class="btn btn1"> View </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>


