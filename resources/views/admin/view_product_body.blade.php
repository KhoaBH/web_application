<div class="main-panel" >
    <div class="py-3 py-md-5" style="width:60%">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h4 class="mb-4">Our Products</h4>
                </div>
                @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="product-card" id="{{$product->id}}">
                            <div class="product-card-img">
                                <label class="stock bg-success">In Stock</label>
                                <img src="products/{{$product->image}}" alt="Laptop" style="height:200px;border-top-left-radius: 20px; border-top-right-radius: 20px;">
                            </div>
                            <div class="product-card-body">
                                <p class="product-brand" style="color:white;">Số lượng: {{$product->quantity}}</p>
                                <h5 class="product-name">
                                    <a href="" style="color:white;">
                                        {{$product->name}}
                                    </a>
                                </h5>
                                <div>
                                    <span class="selling-price" style="color:white;">{{$product->price}}</span>
                                    <span class="original-price" style="color:white;">{{$product->price}}</span>
                                </div>
                                <div class="mt-2">
                                    <a href="" class="btn btn-success">Edit</a>
                                    <a href="" class="btn btn-danger">Delete</a>
                                    <a href="" class="btn btn-danger"> Restock </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{$products->links()}}
        </div>
    </div>
</div>

<style>
    /* Product Card */
    .product-card {

        background-color: transparent;
        border: 1px solid #fdfdfd;
        border-radius: 20px;
        margin-bottom: 24px;
    }
    .product-card a{
        text-decoration: none;
    }
    .product-card .stock{
        position: absolute;
        color: #fff;
        border-radius: 4px;
        padding: 2px 12px;
        margin: 8px;
        font-size: 12px;
    }
    .product-card .product-card-img{
        max-height: 260px;
        overflow: hidden;
        border-bottom: 1px solid #ccc;
    }
    .product-card .product-card-img img{
        width: 100%;
    }
    .product-card .product-card-body{
        padding: 10px 10px;
    }
    .product-card .product-card-body .product-brand{
        font-size: 14px;
        font-weight: 400;
        margin-bottom: 4px;
        color: #937979;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }
    .product-card .product-card-body .product-name{
        font-size: 20px;
        font-weight: 600;
        color: #000;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }
    .product-card .product-card-body .selling-price{
        font-size: 22px;
        color: #000;
        font-weight: 600;
        margin-right: 8px;
    }
    .product-card .product-card-body .original-price{
        font-size: 18px;
        color: #937979;
        font-weight: 400;
        text-decoration: line-through;
    }
    .product-card .product-card-body .btn1{
        border: 1px solid;
        margin-right: 3px;
        border-radius: 0px;
        font-size: 12px;
        margin-top: 10px;
    }
    /* Product Card End */
</style>


