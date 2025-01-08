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
                            <div class="product-card-img" style="position: relative; overflow: hidden; height: 200px; border-top-left-radius: 20px; border-top-right-radius: 20px;">
                                @if($product->quantity>0)
                                    <label class="stock bg-success">In Stock</label>
                                @else
                                    <label class="stock bg-danger">Out of Stock</label>
                                @endif
                                <img src="products/{{$product->image}}" alt="Laptop" style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
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
                                    <span class="selling-price" style="color:white;">${{$product->discounted_price}}</span>
                                    <span class="original-price" style="color:white;">${{$product->price}}</span>
                                </div>
                                <div class="mt-2">
                                    <a  class="btn btn-success" onclick="edit_product(this)" data-category="{{$product->category_id}}" data-id="{{$product->id}}" data-name="{{$product->name}}" data-price="{{$product->price}}" data-quantity="{{$product->quantity}}" data-description="{{$product->description}}" data-image="{{$product->image}}">Edit</a>
                                    <a href="{{ url('delete_product', $product->id) }}" class="btn btn-danger">Delete</a>
                                    <a  class="btn btn-primary" onclick="Restock(this)" data-product-id="{{$product->id}}" style="margin-left:25px"> Restock </a>
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
    label{
        color:black;
    }
</style>

<script>
    async function Restock(button) {
        var productid = button.getAttribute('data-product-id');
        const { value: number } = await Swal.fire({
            title: "<h5 style='color:#151313; font-size: 35px '>Restock product?</h5>",
            input: "number",
            inputLabel: "Your number",
            inputPlaceholder: "Enter a number",
            background: 'white',
            inputAttributes: {
                min: 0, // Optional: Set minimum value
                step: 1 // Optional: Set step value
            },
            customClass: {
                input: 'white-input'
            }
        });

        if (number) {
            // Make the AJAX call after getting the input value
            $.ajax({
                url: '{{route('restock')}}',  // URL to the restock route
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // CSRF token
                    productId: productid,
                    number: number // Send the entered number
                },
                success: function(response) {
                    console.log("Response from server:", response);
                    Swal.fire({
                        icon: 'success',
                        title: 'Restock successful',
                        text: response.message // Display the response message
                    }).then(() => {
                        // Reload the page after the success message is shown
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error from server:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Restock failed',
                        text: 'There was an error restocking the product.'
                    });
                }
            });
        }
    }
    document.querySelector('select[name="category"]').value = "2";
    async function edit_product(element) {
        const categories = @json($category);
        const productId = element.getAttribute("data-id");
        const productName = element.getAttribute("data-name");
        const productPrice = element.getAttribute("data-price");
        const productQuantity = element.getAttribute("data-quantity");
        const productDescription = element.getAttribute("data-description");
        const category_id = element.getAttribute("data-category");
        let optionsHtml = ``;
        categories.forEach(cat => {
            optionsHtml += `<option value="${cat.id}" ${cat.id == category_id ? 'selected' : ''}>${cat.name}</option>`;
        });
        const { value: formValues, isConfirmed } = await Swal.fire({
            title: "<h5 style='color:#151313; font-size: 35px'>Edit product</h5>",
            html: `
        <label style="color:black">Name</label>
        <input id="swal-input1" class="swal2-input" placeholder="" value="${productName}" style="background-color:white;color:black;">
        <label style="color:black">Description</label>
        <input id="swal-input2" class="swal2-input" placeholder="" value="${productDescription}" style="background-color:white;color:black;">
        <label style="color:black">Price</label>
        <input id="swal-input3" class="swal2-input" placeholder="" value="${productPrice}" style="background-color:white;color:black;">
        <label for="select_page">Category</label>
        <select id="select_page" style="width:200px;" class="operator" name="category"><br>
        <label for="select_page" style="color:black">Category</label>
                ${optionsHtml}
        </select><br><br>
        <label style="color:black">Image</label>
        <input id="swal-input5" class="swal2-input" placeholder="" type="file" style="background-color:white;color:black;">
    `,
            focusConfirm: false,
            background: "white",
            showCancelButton: true,  // Hiển thị nút "Cancel"
            confirmButtonText: "Save",
            cancelButtonText: "Cancel",
            preConfirm: () => {
                const name = document.getElementById("swal-input1").value;
                const description = document.getElementById("swal-input2").value;
                const price = document.getElementById("swal-input3").value;
                const image = document.getElementById("swal-input5").files[0]; // Sử dụng .files[0] để lấy file thực tế
                const category_id = document.getElementById("select_page").value;
                // Tạo FormData để gửi yêu cầu
                const formData = new FormData();
                formData.append('productId', productId);
                formData.append('name', name);
                formData.append('description', description);
                formData.append('price', price);
                formData.append('category_id', category_id);
                console.log(category_id);
                if (image) {
                    formData.append('image', image);
                }
                // Gửi yêu cầu AJAX (hoặc sử dụng fetch)
                formData.forEach((value, key) => {
                    console.log(`${key}: ${value}`);
                });
                return axios.post("{{ route('admin.edit_product') }}", formData)
                    .then(response => {
                        Swal.fire({
                            title: "Edit!",
                            text: "Your work has been saved",
                            icon: "success",
                            color:"#000000",
                            background:"white",
                        }).then((next_result) =>{
                            if(next_result.isConfirmed){
                                const url = `{{ route('admin.product')}}`;
                                window.location.href = url;
                            }
                        });
                    }).catch(error => {
                        console.error(error);
                    });


            }

        });

    }
</script>
