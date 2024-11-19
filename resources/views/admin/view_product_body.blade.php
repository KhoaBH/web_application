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
                            <div style="display:none">
                                <a>{{$product->description}}</a>
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
                                    <a  class="btn btn-success" onclick="edit_product(this)" data-id="{{$product->id}}" data-name="{{$product->name}}" data-price="{{$product->price}}" data-quantity="{{$product->quantity}}" data-description="{{$product->description}}" data-image="{{$product->image}}">Edit</a>
                                    <a href="{{ url('delete_product', $product->id) }}" class="btn btn-danger">Delete</a>
                                    <a href="" class="btn btn-primary" style="margin-left:45px"> Restock </a>
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
    </div>
</div>

<style>
    /*Pagination*/
    /* Thay đổi màu nền và chữ của nút phân trang */
    .pagination{
        align-self: center;
        justify-self: center;
    }
    .pagination .page-item .page-link {
        color: #ffffff;           /* Màu chữ */
        background-color: transparent; /* Màu nền */
        border-color: #dbdddf;    /* Màu viền */
    }

    .pagination .page-item.active .page-link {
        background-color: #fc424a; /* Màu nền cho trang hiện tại */
        border-color: #fafafa;     /* Màu viền cho trang hiện tại */
        color: #ffffff;            /* Màu chữ cho trang hiện tại */
    }

    .pagination .page-item:hover .page-link {
        background-color: #ffffff; /* Màu nền khi hover */
        border-color: #ffffff;
        color:black;/* Màu viền khi hover */
    }

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

<script>
    async function edit_product(element) {
        const productId = element.getAttribute("data-id");
        const productName = element.getAttribute("data-name");
        const productPrice = element.getAttribute("data-price");
        const productQuantity = element.getAttribute("data-quantity");
        const productDescription = element.getAttribute("data-description");
        const productImage = element.getAttribute("data-image");

        console.log("Product ID:", productId);
        console.log("Product Name:", productName);
        console.log("Product Price:", productPrice);
        console.log("Product Quantity:", productQuantity);
        console.log("product Description:", productDescription);
        console.log("product Image:", productImage.split('\\').pop().split('/').pop());

        const { value: formValues, isConfirmed } = await Swal.fire({
            title: "<h5 style='color:#151313; font-size: 35px'>Edit product</h5>",
            html: `
        <label style="color:black">Name</label>
        <input id="swal-input1" class="swal2-input" placeholder="" value="${productName}" style="background-color:white;color:black;">
        <label style="color:black">Description</label>
        <input id="swal-input2" class="swal2-input" placeholder="" value="${productDescription}" style="background-color:white;color:black;">
        <label style="color:black">Price</label>
        <input id="swal-input3" class="swal2-input" placeholder="" value="${productPrice}" style="background-color:white;color:black;">
        <label style="color:black">Quantity</label>
        <input id="swal-input4" class="swal2-input" placeholder="" value="${productQuantity}" style="background-color:white;color:black;">
        <label style="color:black">Image</label>
        <input id="swal-input5" class="swal2-input" placeholder="" type="file"  style="background-color:white;color:black;">
    `,
            focusConfirm: false,
            background: "white",
            showCancelButton: true,  // Hiển thị nút "Cancel"
            confirmButtonText: "Save",
            cancelButtonText: "Cancel",
            preConfirm: () => {
                return [
                    productId,
                    document.getElementById("swal-input1").value,
                    document.getElementById("swal-input2").value,
                    document.getElementById("swal-input3").value,
                    document.getElementById("swal-input4").value,
                    document.getElementById("swal-input5").value.split('\\').pop().split('/').pop()
                ];
            }
        });

        if (isConfirmed && formValues) {
            const data = encodeURIComponent(JSON.stringify(formValues));
            const url = `{{ route('admin.edit_product', ['data' => ':data']) }}`.replace(':data', data);
            window.location.href = url;
        } else {
            // Xử lý khi người dùng nhấn "Cancel", nếu cần
            console.log("User cancelled the edit.");
        }
    }
</script>
