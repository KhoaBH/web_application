<nav class="sidebar sidebar-offcanvas" id="sidebar" style="position:fixed">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="/home"><img src="admin/assets/images/logo.svg" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="/home"><img src="admin/assets/images/logo-mini.svg" alt="logo" /></a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle " src="admin/assets/images/faces/face15.jpg" alt="">
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal" style="color: white">{{Auth::user()->name}}</h5>
                        <span>Gold Member</span>
                    </div>
                </div>
                <a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-settings text-primary"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-onepassword  text-info"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-calendar-today text-success"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                        </div>
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="/dashboard">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if(Auth::user()->user_type=="admin")
            <li class="nav-item menu-items">
                <a class="nav-link" data-bs-toggle="collapse" href="#auth2" aria-expanded="false" aria-controls="auth2">
        <span class="menu-icon">
            <i class="mdi mdi-laptop"></i>
        </span>
                    <span class="menu-title">Category</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth2">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('category_view') ? 'active' : '' }}" href="/category_view">Category</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('sub_category') ? 'active' : '' }}" href="/sub_category">Sub Category</a>
                        </li>
                    </ul>

                </div>
            </li>
        @endif
        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth3" aria-expanded="false" aria-controls="auth3">
        <span class="menu-icon">
            <i class="mdi mdi-package-variant"></i>
        </span>
                <span class="menu-title">Products</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth3">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="/add_product">Add Product</a></li>
                    <li class="nav-item"> <a class="nav-link" href="/view_product">Products</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="/ordersConfirmation">
              <span class="menu-icon">
                <i class="mdi mdi-chart-bar"></i>
              </span>
                <span class="menu-title">Order Confirmation</span>
            </a>
        </li>
    </ul>
</nav>
