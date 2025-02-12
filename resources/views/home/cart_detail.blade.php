<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <!-- Font Awesome CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>
<div class="card">
    <div class="row">

        <div class="col-md-8 cart">
            <a href="javascript:history.back()" class="btn btn-primary" style="align-self: flex-start;width: 20%; margin-top:2px">
                <i class="fa fa-light fa-angle-left"></i> Back
            </a>
            <div class="title">
                <div class="row">
                    <div class="col"><h4><b>Shopping Cart</b></h4></div>
                </div>
            </div>
            <div class="cart-items">
                @foreach($products as $product)
                    <div class="row border-top border-bottom product-row" data-price="{{ $product->discounted_price }}" id="{{$product->product_id}}">
                        <div class="row main align-items-center">
                            <div class="col-2"><img class="img-fluid" src="products/{{$product->image}}"></div>
                            <div class="col">
                                <div class="row text-muted">Available:  {{ $product->quantity }}</div>
                                <span class="available " style="display:none">{{ $product->quantity }}</span>
                                <div class="row">{{ $product->name }}</div>
                            </div>
                            <div class="col">
                                <a href="#" class="decrease">-</a>
                                <span class="quantity ">1</span>
                                <a href="#" class="increase">+</a>
                            </div>
                            <div class="col">
                                <span class="old-price">&dollar;{{ $product->price }}</span>
                                <span class="new-price">&dollar;{{ $product->discounted_price }}</span>
                                <span class="close removeFromCartBtn" data-product-id="{{$product->product_id}}">&#10005;</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4 summary">
            <div><h5><b>Summary</b></h5></div>
            <hr>
            <div class="row">
                <div class="col" style="padding-left:0;">ITEMS <span id="total-items">3</span></div>
                <div class="col text-right"><span id="total-price"> 132.00</span></div>
            </div>
            <form>
                <p>SHIPPING</p>
                <select><option class="text-muted">Standard-Delivery- &dollar;5.00</option></select>
            </form>
            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                <div class="col">TOTAL PRICE</div>
                <div class="col text-right"><span id="final-price">&euro; 137.00</span></div>
            </div>
            <button type="submit" class="btn btn-success" onclick="checkout()">CHECKOUT</button>
        </div>
    </div>
</div>

<script>
    async function checkout() {
        // Check if items are available before proceeding
        if (!checkAvailable()) {
            return; // If any item is out of stock, stop further execution
        }

        var urlToDirect = event.currentTarget.getAttribute('href');
        Swal.fire({
            title: "<h5 style='color:#151313; font-size: 35px '>Are you sure?</h5>",
            text: "Please review your order before continuing!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, proceed to checkout!",
            background: "#fff"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "<h5 style='color:#151313; font-size: 35px'>Order Placed!</h5>",
                    text: "Your order has been successfully placed.",
                    background: "#fff",
                    icon: "success"
                }).then((next_result) => {
                    if (next_result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('checkout') }}', // Đường dẫn đến route xử lý checkout
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}', // Thêm CSRF token
                                cart_items: getCartItems() // Giả sử bạn có hàm getCartItems() để lấy dữ liệu giỏ hàng
                            },
                            success: function(response) {
                                console.log("Response from server:", response);
                            }
                        });

                        window.location.href = "/home";
                    }
                });
            }
        });
    }

    function checkAvailable() {
        var isAvailable = true; // Flag to check if all products are available
        $('.product-row').each(function() {
            var available = parseInt($(this).find('.available').text()); // Get available stock as number
            var quantity = parseInt($(this).find('.quantity').text()); // Get quantity selected as number

            // If available stock is less than selected quantity, show error and return false
            if (available < quantity) {
                Swal.fire({
                    icon: "error",
                    title: "<h5 style='color:#151313; font-size: 35px '>Oops...</h5>",
                    text: "Out of stock for one or more items!",
                    background: "#fff"
                });
                isAvailable = false;
                return false; // Break out of the loop
            }
        });
        return isAvailable; // Return true if all products are available, false if any are not
    }

    function getCartItems() {
        var items = [];
        // Lấy danh sách sản phẩm và số lượng từ giỏ hàng
        $('.product-row').each(function() {
            var product_id = $(this).attr('id');
            var quantity = $(this).find('.quantity').text();
            items.push({ product_id: product_id, quantity: quantity });
        });
        return items;
    }
    $(document).ready(function() {
        $('.removeFromCartBtn').on('click', function(e) {
            var currentValue = parseInt(document.getElementById('counter-value').innerText);
            e.preventDefault(); // Ngăn chặn hành động mặc định của thẻ <a>
            var productId = $(this).data('product-id');
            console.log(productId);
            const element = document.getElementById(productId);

            axios.post("{{ url('remove-from-cart') }}", { product_id: productId })
                .then(function(response) {
                    // Xử lý khi gửi yêu cầu thành công
                    console.log(currentValue);
                    var newvalue = currentValue - 1;
                    document.getElementById('counter-value').innerText = newvalue;
                    element.remove();
                    calculateTotal();
                    toastr.success('Remove from cart successfully');
                })
                .catch(function(error) {
                    console.log(error);
                    toastr.error('Error!');
                });
        });
    });

    function calculateTotal() {
        let total = 0;
        let final = 0;
        let totalItems = 0;

        // Lặp qua tất cả các sản phẩm trong giỏ hàng
        document.querySelectorAll('.product-row').forEach(function(productRow) {
            const price = parseFloat(productRow.dataset.price); // Lấy giá của sản phẩm
            const quantity = parseInt(productRow.querySelector('.quantity').textContent); // Lấy số lượng sản phẩm
            total += price * quantity; // Cộng vào tổng giá
            totalItems += quantity; // Cộng vào tổng số sản phẩm
        });
        final = total + 5;
        // Cập nhật tổng số lượng và tổng giá
        document.getElementById('total-items').textContent = totalItems;
        document.getElementById('total-price').textContent = `$ ${total.toFixed(2)}`;
        document.getElementById('final-price').textContent = `$ ${final.toFixed(2)}`;
    }
    document.addEventListener('DOMContentLoaded', function() {
        // Tính toán tổng giá khi thay đổi số lượng
        // Cập nhật số lượng khi nhấn vào nút "+" hoặc "-"
        document.querySelectorAll('.decrease').forEach(function(decreaseBtn) {
            decreaseBtn.addEventListener('click', function(event) {
                event.preventDefault();
                const quantityElement = decreaseBtn.nextElementSibling;
                let quantity = parseInt(quantityElement.textContent);
                if (quantity > 1) {
                    quantity--;
                    quantityElement.textContent = quantity;
                    calculateTotal(); // Cập nhật tổng khi thay đổi số lượng
                }
            });
        });

        document.querySelectorAll('.increase').forEach(function(increaseBtn) {
            increaseBtn.addEventListener('click', function(event) {
                event.preventDefault();
                const quantityElement = increaseBtn.previousElementSibling;
                let quantity = parseInt(quantityElement.textContent);
                quantity++;
                quantityElement.textContent = quantity;
                calculateTotal(); // Cập nhật tổng khi thay đổi số lượng
            });
        });

        // Tính toán tổng khi trang được tải
        calculateTotal();
    });

    // Lấy các phần tử HTML
    const quantityElement = document.getElementById('quantity');
    const decreaseLink = document.getElementById('decrease');
    const increaseLink = document.getElementById('increase');
    let quantity = 1;

    function updateQuantity() {
        quantityElement.textContent = quantity;
    }
    decreaseLink.addEventListener('click', (event) => {
        event.preventDefault(); // Ngừng hành động mặc định của liên kết
        if (quantity > 1) { // Không cho phép số lượng < 1
            quantity--;
            updateQuantity();
        }
    });

    increaseLink.addEventListener('click', (event) => {
        event.preventDefault(); // Ngừng hành động mặc định của liên kết
        quantity++;
        updateQuantity();
    });
</script>
<style>


    body{
        background: #ddd;
        min-height: 100vh;
        vertical-align: middle;
        display: flex;
        font-size: 0.9rem;
        font-weight: bold;
    }
    .title{
        margin-bottom: 5vh;
    }
    .card{
        margin: auto;
        max-width: 950px;
        width: 90%;
        box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 1rem;
        border: transparent;
    }
    @media(max-width:767px){
        .card{
            margin: 3vh auto;
        }
    }
    .cart{
        background-color: #fff;
        padding: 4vh 5vh;
        border-bottom-left-radius: 1rem;
        border-top-left-radius: 1rem;
    }
    @media(max-width:767px){
        .cart{
            padding: 4vh;
            border-bottom-left-radius: unset;
            border-top-right-radius: 1rem;
        }
    }
    .cart-items {
        max-height: 300px; /* Chiều cao cố định */
        overflow-y: auto; /* Cho phép cuộn dọc */
        margin-bottom: 1rem;
    }
    .old-price, .new-price {
        font-size: 1rem;
        display: inline-block;  /* Sử dụng inline-block để các giá trị không bị tràn ra ngoài */
        text-align: right;      /* Căn chỉnh giá trị về bên phải */
        min-width: 80px;        /* Đặt chiều rộng tối thiểu để căn chỉnh đều */
    }

    .old-price {
        text-decoration: line-through; /* Gạch đi giá cũ */
        color: #888; /* Màu xám cho giá cũ */
    }

    .new-price {
        color: #ff5733; /* Màu đỏ hoặc màu nổi bật cho giá giảm */
        font-size: 1.2rem; /* Kích thước chữ lớn hơn cho giá đã giảm */
        font-weight: bold;
    }

    .summary{
        background-color: #ddd;
        border-top-right-radius: 1rem;
        border-bottom-right-radius: 1rem;
        padding: 4vh;
        color: rgb(65, 65, 65);
    }
    @media(max-width:767px){
        .summary{
            border-top-right-radius: unset;
            border-bottom-left-radius: 1rem;
        }
    }
    .summary .col-2{
        padding: 0;
    }
    .summary .col-10
    {
        padding: 0;
    }.row{
         margin: 0;
     }
    .title b{
        font-size: 1.5rem;
    }
    .main{
        margin: 0;
        padding: 2vh 0;
        width: 100%;
    }
    .col-2, .col{
        padding: 0 1vh;
    }
    a{
        padding: 0 1vh;
    }
    .close{
        margin-left: auto;
        font-size: 0.7rem;
    }
    img{
        width: 3.5rem;
    }
    .back-to-shop{
        margin-top: 4.5rem;
    }
    h5{
        margin-top: 4vh;
    }
    hr{
        margin-top: 1.25rem;
    }
    form{
        padding: 2vh 0;
    }
    select{
        border: 1px solid rgba(0, 0, 0, 0.137);
        padding: 1.5vh 1vh;
        margin-bottom: 4vh;
        outline: none;
        width: 100%;
        background-color: rgb(247, 247, 247);
    }
    input{
        border: 1px solid rgba(0, 0, 0, 0.137);
        padding: 1vh;
        margin-bottom: 4vh;
        outline: none;
        width: 100%;
        background-color: rgb(247, 247, 247);
    }
    input:focus::-webkit-input-placeholder
    {
        color:transparent;
    }
    .btn{
        background-color: #000;
        border-color: #000;
        color: white;
        width: 100%;
        font-size: 0.7rem;
        margin-top: 4vh;
        padding: 1vh;
        border-radius: 0;
    }
    .btn:focus{
        box-shadow: none;
        outline: none;
        box-shadow: none;
        color: white;
        -webkit-box-shadow: none;
        -webkit-user-select: none;
        transition: none;
    }

    a{
        color: black;
    }
    a:hover{
        color: black;
        text-decoration: none;
    }
    #code{
        background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253) , rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
        background-repeat: no-repeat;
        background-position-x: 95%;
        background-position-y: center;
    }
</style>
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap Bundle JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
