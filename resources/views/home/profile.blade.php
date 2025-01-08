<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
</head>
@include('home.header')
<body>
@include('home.js')
<div class="container">
    <div class="page-content page-container" id="page-content" style="width: 200%;padding-top: 100px;">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-6 col-md-12" style="width:90%; max-width: 90%;flex: 0 0 100%;">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25">
                                        <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
                                    </div>
                                    <h6 class="f-w-600">{{Auth::user()->name}}</h6>
                                    <p style="color:white;font-weight: bold;">{{Auth::user()->user_type}}</p>
                                    <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Name</p>
                                            <h6 class="text-muted f-w-400">{{Auth::user()->name}}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Email</p>
                                            <h6 class="text-muted f-w-400">{{Auth::user()->email}}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Phone</p>
                                            <h6 class="text-muted f-w-400">{{Auth::user()->phone}}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Address</p>
                                            <h6 class="text-muted f-w-400">{{Auth::user()->address}}</h6>
                                        </div>
                                    </div>
                                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Shopping</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Orders</p>
                                            <h6 class="text-muted f-w-400">{{$orders_count}}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Total Spent</p>
                                            <h6 class="f-w-400" style="color: #138b46">${{$totalSpent}}</h6>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container" style="width:90%; justify-content: flex-start; padding-left:10px; padding-top: 100px; text-align: center;">
    <h3 style="margin-top: 20px;justify-self: flex-start">Orders</h3> <!-- Thêm nhãn "Orders" -->
    <div class="table-container" style="display: flex; justify-content: center; margin-top: 20px;max-height: 400px; overflow-y: auto;">
        <table class="table" style="width:150%;"> <!-- Thêm margin-top -->
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Total</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Confirm</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $data)
                <tr>
                    <th scope="row">{{$data->id}}</th>
                    <td>{{$data->total}}$</td>
                    <td>{{$data->created_at}}</td>
                    <td>{{$data->status}}</td>
                    <td>
                        @if($data->status == "delivering")
                            <button type="button" onclick="confirmDelivery(this)" class="btn btn-success" data-order-id="{{{$data->id}}}">Confirm Delivery</button>
                        @elseif($data->status == "pending")
                            <button type="button" class="btn btn-warning" disabled>Pending</button>
                        @else
                            <button type="button" class="btn btn-danger" disabled>Delivered</button>
                        @endif
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>

<div class="best-features">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>About Prime Picks</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="left-content" style="font-family: 'Montserrat', sans-serif;">
                    <h4>Looking for Quality Products?</h4>
                    <p><a rel="nofollow" href="https://templatemo.com/tm-546-sixteen-clothing" target="_parent">Prime Picks</a> is the place to find the finest products! <br>Let Prime Picks be your trusted shopping partner, offering the best products and excellent services!</p>
                    <ul class="featured-list">
                        <li><a href="#">Top Quality</a></li>
                        <li><a href="#">Variety</a></li>
                        <li><a href="#">Affordable Prices</a></li>
                        <li><a href="#">Customer Service Excellence</a></li>
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
                    <p>Copyright &copy; 2024 Prime Picks Co., Ltd.
                        - Design: <a rel="nofollow noopener" href="https://templatemo.com" target="_blank">KHOADAUBU</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
</body>
</html>
<script>
    async function confirmDelivery(button){
        var orderId = button.getAttribute('data-order-id'); // Lấy giá trị data-product-id
        Swal.fire({
            title: "<h5 style='color:#151313; font-size: 35px '>Confirm Delivery?</h5>",
            text: 'Do you want to confirm that the order has been delivered?',
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: 'Yes, confirm delivery!',
            background:"#fff"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "<h5 style='color:#151313; font-size: 35px'>Order Placed!</h5>",
                    text: "Thanks",
                    background:"#fff",
                    icon: "success"
                }).then((next_result) =>{
                    if(next_result.isConfirmed){
                        $.ajax({
                                url: '{{route('confirm_delivery')}}',  // Đường dẫn đến route xử lý checkout
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}', // Thêm CSRF token
                                    orderId
                                }, success: function(response) {
                                    console.log("Response from server:", response);
                                }
                            }

                        )
                        window.location.href = window.location.href;

                    }
                });
            }
        });

    }
</script>
<style>
    body {
        background-color: #f9f9fa
    }

    .padding {
        padding: 1rem !important
    }

    .user-card-full {
        overflow: hidden;
    }

    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 20px 0 rgba(69,90,100,0.08);
        box-shadow: 0 1px 20px 0 rgba(69,90,100,0.08);
        border: none;
        margin-bottom: 30px;
    }

    .m-r-0 {
        margin-right: 0px;
    }

    .m-l-0 {
        margin-left: 0px;
    }

    .user-card-full .user-profile {
        border-radius: 5px 0 0 5px;
    }

    .bg-c-lite-green {
        background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
        background: linear-gradient(to right, #ee5a6f, #f29263);
    }

    .user-profile {
        padding: 20px 0;
    }

    .card-block {
        padding: 1.25rem;
    }

    .m-b-25 {
        margin-bottom: 25px;
    }

    .img-radius {
        border-radius: 5px;
    }



    h6 {
        font-size: 22px;
    }

    .card .card-block p {
        line-height: 25px;
    }

    @media only screen and (min-width: 1400px){
        p {
            font-size: 14px;
        }
    }

    .card-block {
        padding: 1.25rem;
    }

    .b-b-default {
        border-bottom: 1px solid #e0e0e0;
    }

    .m-b-20 {
        margin-bottom: 20px;
    }

    .p-b-5 {
        padding-bottom: 5px !important;
    }

    .card .card-block p {
        line-height: 25px;
    }

    .m-b-10 {
        margin-bottom: 10px;
    }

    .text-muted {
        color: #22262c !important;
    }

    .b-b-default {
        border-bottom: 1px solid #e0e0e0;
    }

    .f-w-600 {
        font-weight: 600;
    }

    .m-b-20 {
        margin-bottom: 20px;
    }

    .m-t-40 {
        margin-top: 20px;
    }

    .p-b-5 {
        padding-bottom: 5px !important;
    }

    .m-b-10 {
        margin-bottom: 10px;
    }

    .m-t-40 {
        margin-top: 20px;
    }

    .user-card-full .social-link li {
        display: inline-block;
    }

    .user-card-full .social-link li a {
        font-size: 20px;
        margin: 0 10px 0 0;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }



    .table-container {
        border: 2px solid #ffeeee; /* Thêm viền */
        border-radius: 5px; /* Bo góc nếu cần */
        padding: 10px; /* Thêm khoảng cách giữa viền và nội dung */
    }
</style>
