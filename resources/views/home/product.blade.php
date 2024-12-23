<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
                <div class="col-md-3" id="{{$product->id}}">
                    <div class="product-card">
                        <div class="product-card-img" onclick="window.location='{{ url('product_detail', $product->id) }}';" style="height:220px; border-top-left-radius: 15px; border-top-right-radius: 15px; overflow: hidden;">
                            <label class="stock bg-success">In Stock</label>
                            <img src="products/{{$product->image}}" alt="Laptop" class="product-image">
                        </div>

                        <div class="product-card-body">
                            <p class="product-brand">HP</p>
                            <p class="product-quantity">{{$product->quantity}}</p>
                            <h5 class="product-name">
                                <a href="">{{ $product->name }}</a>
                            </h5>
                            <div>
                                <span class="selling-price">{{$product->price}}</span>
                                <span class="original-price">{{$product->price}}</span>
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
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.addToCartBtn').on('click', function(e) {
            var currentValue = parseInt(document.getElementById('counter-value').innerText);

            e.preventDefault(); // Ngăn chặn hành động mặc định của thẻ <a>

            var productId = $(this).data('product-id');

            axios.post("{{ url('add-to-cart') }}", { product_id: productId })
                .then(function(response) {
                    // Xử lý khi gửi yêu cầu thành công
                    console.log(currentValue);
                    var newvalue = currentValue + 1;
                    document.getElementById('counter-value').innerText = newvalue;
                    toastr.success('Add to cart successfully');

                })
                .catch(function(error) {
                    console.log(error);
                    toastr.error('Product already in your cart!');
                });
        });
    });
</script>



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
