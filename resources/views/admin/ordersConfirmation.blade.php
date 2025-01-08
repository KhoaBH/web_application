<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.layout.css')
</head>
<body>
<div class="container-scroller">
    @include('admin.layout.sidebar')
    @include('admin.layout.header')
    <div class="main-panel" style="padding-top: 0px;">
        <h1>Orders Confirmation</h1>
        <form action="{{ route('admin.selected_category') }}" method = 'get' style="width:60%;; margin-top:30px">
            <div class="d-flex" >
                <input name='search' class="form-control mr-2" type="search" placeholder="Search" aria-label="Search" style="width:20%;color:white">
                <input type="submit" href="{{ url('selected_category') }}" class="btn btn-secondary d-flex align-items-center justify-content-center" value="Search">
            </div>
        </form>


        <table class="table " style="color: white; width:60%">
            <thead class="thead-light">
            <tr>
                <th scope="col" >Order ID</th>
                <th scope="col">Product Name</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Confirmation</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <th scope="row" >{{$order->order_id}}</th>
                    <td>{{$order->product_name}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->order_date}}</td>
                    <td>{{$order->status}}</td>
                    @if($order->status == "pending")
                    <td><a  class="btn btn-success" data-order-id="{{$order->order_detail_id}}" onclick="confirmDelivery(this)">Delivery</a></td>
                    @else
                        <td><button type="button" class="btn btn-danger" disabled>Confirmed</button></td>
                    @endif

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
@include('admin.layout.js')
</body>
<script>
    async function confirmDelivery(button) {
        var orderDetailId = button.getAttribute('data-order-id'); // Get the value of data-order-id
        Swal.fire({
            title: "<h5 style='color:#151313; font-size: 35px '>Confirm Order Pickup?</h5>",
            text: 'Ready for delivery?',
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: 'Yes, confirm!',
            cancelButtonText: 'Cancel',
            background: "#fff"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "<h5 style='color:#151313; font-size: 35px '>Pickup Confirmed!</h5>",
                    text: "<h5 style='color:#151313; font-size: 15px '>Delivery service notified.</h5>",
                    background: "#fff",
                    icon: "success"
                }).then((next_result) => {
                    if (next_result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('ordersConfirmation') }}',  // URL to handle order pickup confirmation
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}', // Add CSRF token
                                orderDetailId
                            },
                            success: function(response) {
                                console.log("Response from server:", response);
                            }
                        });
                        window.location.href = window.location.href;
                    }
                });
            }
        });
    }
</script>
</html>
