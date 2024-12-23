<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<a href="" class="btn btn1" id="addToCartBtn">Add To Cart</a>
<script>
    $(document).ready(function(){
        // Xử lý sự kiện click trên nút Add to Cart
        $('#addToCartBtn').on('click', function(e){
            e.preventDefault(); // Ngừng hành động mặc định của liên kết

            var productId = $(this).data('product-id'); // Lấy id sản phẩm từ thuộc tính data

            // In ra ID sản phẩm
            console.log('1'); // Ví dụ: in ra 1
        });
    });
</script>
