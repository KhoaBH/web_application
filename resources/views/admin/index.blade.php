<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.layout.css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<Style>
    body {
        background-color: transparent; /* Không có màu nền */
    }
    .chart-title {
        text-align: center;
        font-weight: bold;
        margin-bottom: 20px;
    }
</Style>
<body>
<div class="container-scroller">
    @include('admin.layout.sidebar')
    @include('admin.layout.header')
    <div class="container" style="margin-top: 100px;margin-left:300px">
        <div class="row">
            <!-- Các thẻ thông tin -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Today's Orders</h5>
                        <h3>{{ $total_orders }} Orders</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">Today's Revenue</h5>
                        <h3>${{ number_format($today_revenue, 0) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-info text-white">
                    <div class="card-body" >
                        <h5 class="card-title">Total Revenue</h5>
                        <h3>${{ number_format($total_revenue, 0) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card bg-success text-white">
                    <div class="card-body" >
                        <h5 class="card-title">Total Orders</h5>
                        <h3>{{ $total_orders }} Orders</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" >
            <div class="col-lg-6 mb-4">
                <div class="card" >
                    <div class="card-body">
                        <h5 class="chart-title">Monthly Sales Volume</h5>
                        <canvas id="websiteViewsChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card" style="background-color: white;">
                    <div class="card-body" >
                        <h5 class="chart-title">Monthly Sales Revenue</h5>
                        <canvas id="monthlySalesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@include('admin.layout.js')

<script>
    var ctxSales = document.getElementById('websiteViewsChart').getContext('2d');
    var monthlySalesChart = new Chart(ctxSales, {
        type: 'bar',  // Đổi từ 'line' thành 'bar' để tạo biểu đồ cột
        data: {
            labels: @json($months), // Mảng tháng từ 01 đến 12
            datasets: [{
                label: 'Total Revenue',
                data: @json($revenues), // Mảng doanh thu
                backgroundColor: 'rgb(54,162,235)', // Màu nền của các cột
                borderColor: 'rgba(54, 162, 235, 1)', // Màu viền của các cột
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Total Revenue by Month'  // Tiêu đề của biểu đồ
                }
            },
            scales: {
                y: {
                    beginAtZero: true  // Đảm bảo trục Y bắt đầu từ 0
                }
            }
        }
    });

    var ctxOrders = document.getElementById('monthlySalesChart').getContext('2d');
    var monthlyOrdersChart = new Chart(ctxOrders, {
        type: 'line',
        data: {
            labels: @json($months), // Mảng tháng từ 01 đến 12
            datasets: [{
                label: 'Total Orders',
                data: @json($orders), // Mảng số lượng đơn hàng
                backgroundColor: 'rgb(255,99,132)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Total Orders by Month'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>
