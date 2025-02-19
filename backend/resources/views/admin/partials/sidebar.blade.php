<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="#" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('velzon/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('velzon/assets/images/1.png') }}" alt="" height="50px">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="#" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('velzon/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('velzon/assets/images/1.png') }}" alt="" height="50px">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admins.') }}" role="button" aria-expanded="false"
                        aria-controls="sidebarDashboards">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Tổng quan</span>
                    </a>

                </li> <!-- end Dashboard Menu -->

                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'employee')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarApps">
                        <i class="  ri-book-mark-line"></i> <span data-key="t-apps">Danh mục</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('categories.index') }}" class="nav-link" data-key="t-chat">Danh sách
                                    danh mục </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('categories.create') }}" class="nav-link" data-key="t-api-key">Thêm
                                    danh mục</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'employee')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApp" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarApp">
                        <i class="  ri-book-line"></i> <span data-key="t-apps">Danh mục con</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApp">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('subcategories.index') }}" class="nav-link" data-key="t-chat">Danh
                                    sách danh mục con</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('subcategories.create') }}" class="nav-link" data-key="t-api-key">Thêm
                                    danh mục con</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'employee')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPages" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPages">
                        <i data-feather="package"></i><span data-key="t-Pages">Sản phẩm</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPages">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admins.products.index') }}" class="nav-link" data-key="t-chat"> Danh
                                    sách sản phẩm </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admins.products.create') }}" class="nav-link" data-key="t-api-key">
                                    Thêm sản phẩm</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'employee')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admins.chips.index') }}" role="button"
                        aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="ri-file-copy-line"></i> <span data-key="t-authentication">Thuộc tính</span>
                    </a>
                </li>
                @endif

                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'employee')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarForms" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarForms">
                        <i class="   ri-coupon-2-line"></i> <span data-key="t-apps">Khuyến mại</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarForms">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('promotions.index') }}" class="nav-link" data-key="t-chat">Danh
                                    sách khuyến mại </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('promotions.create') }}" class="nav-link"
                                    data-key="t-api-key">Thêm khuyến mại</a>
                            </li>
                      
                        </ul>
                    </div>
                </li>
                @endif

                @if (Auth::check() && Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('admin.users') }}" role="button"
                            aria-expanded="false" aria-controls="sidebarAuth">
                            <i class="ri-account-circle-line"></i>
                            <span data-key="t-authentication">Khách hàng</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'employee')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.reviews.index')}}" role="button" aria-expanded="false"
                        aria-controls="sidebarAuth">
                        <i class=" ri-chat-3-line"></i> <span data-key="t-authentication">Bình luận</span>
                    </a>
                </li>
                @endif

                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'employee')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('admins.orders.index')}}" role="button" aria-expanded="false"
                        aria-controls="sidebarAuth">
                        <i class="ri-shopping-cart-line"></i> <span data-key="t-authentication">Đơn hàng</span>
                    </a>
                </li>
                @endif

                {{-- @if (Auth::check() && Auth::user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/statistic" role="button" aria-expanded="false"
                        aria-controls="sidebarCharts">
                        <i class="ri-pie-chart-line"></i> <span data-key="t-charts"> Thống kê </span>
                    </a>
                </li>
                @endif --}}

                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'employee')
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApp2" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarApp2">
                        <i class="  ri-book-line"></i> <span data-key="t-apps">Tin tức</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApp2">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('news.index') }}" class="nav-link" data-key="t-chat">Danh
                                    sách tin tức</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('news.create') }}" class="nav-link" data-key="t-api-key">Thêm
                                    tin tức</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
