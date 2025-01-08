<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"><h2>Prime <em> Picks</em></h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home') }}">Home

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"href="{{ route('products') }}">Our Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/cart') }}">
                            <span class="badge badge-danger" id="counter-value">{{ $cartCount }}</span>
                            Cart    <i class="fa fa-cart-plus"></i>
                        </a>
                    </li>


                </ul>
                <ul class="navbar-nav mr-auto">
                    @if (Auth::check())
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/profile') }}">
                                <i class="fa fa-user"></i> {{ Auth::user()->name }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out-alt"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/login') }}">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ url('/register') }}">
                                <i class="fa fa-user-plus"></i> Register
                            </a>
                        </li>
                    @endif
                    @if(Auth::check())
                    @if(Auth::user()->user_type=="admin"||Auth::user()->user_type=="Seller")
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ url('/dashboard') }}">
                                    <i class="fa fa-tachometer"></i> Dashboard
                                </a>
                            </li>
                        @endif
                        @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
<style>
    .nav-item {
        position: relative; /* Đặt vị trí của nav-item để chứa số lượng giỏ hàng */
    }

    .badge {
        font-size: 10px;
        padding: 5px 10px;
        position: absolute;
        top: -1px;  /* Di chuyển lên phía trên */
        left: 90%;  /* Căn giữa theo chiều ngang */
        transform: translateX(-50%);  /* Căn giữa chính xác */
        background-color: #cc0707;  /* Màu nền của badge */
        color: white;  /* Màu chữ */
        padding: 5px 10px;  /* Padding để làm badge nổi bật */
        border-radius: 50%;  /* Tạo badge tròn */
        z-index: 10;
    }
    .custom-cart-icon {
        font-size: 20px; /* Điều chỉnh kích thước theo ý muốn */
    }

</style>
