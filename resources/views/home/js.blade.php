<!-- Bootstrap core JavaScript -->
<script src="{{URL::asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Additional Scripts -->
<script src="{{URL::asset('assets/js/custom.js')}}"></script>
<script src="{{URL::asset('assets/js/owl.js')}}"></script>
<script src="{{URL::asset('assets/js/slick.js')}}"></script>
<script src="{{URL::asset('assets/js/isotope.js')}}"></script>
<script src="{{URL::asset('assets/js/accordions.js')}}"></script>


<script language = "text/Javascript">
    cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
    function clearField(t){                   //declaring the array outside of the
        if(! cleared[t.id]){                      // function makes it static and global
            cleared[t.id] = 1;  // you could use true and false, but that's more typing
            t.value='';         // with more chance of typos
            t.style.color='#fff';
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('.addToCartBtn').on('click', function(e) {
            if(!checkAuth()){
                return;
            }
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
    function checkAuth(){
        var isAuthenticated = @json(Auth::check());
        if(!isAuthenticated){
            Swal.fire({
                title: "<h5 style='color:#151313; font-size: 35px '>You need to Login?</h5>",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Go to Login!",
                background: "#fff"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/login'; // Chuyển hướng đến một URL khác
                    return false;
                }
            });
            console.log(isAuthenticated); // true nếu đã đăng nhập, false nếu chưa
            return false
        }
        return true
    }


</script>
