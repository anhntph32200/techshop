<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">

            </div>

            <div class="d-flex align-items-center">


                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button"
                        class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>


                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            @if (auth()->check())
                                <span class="text-start ms-xl-2">
                                    <span
                                        class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ auth()->user()->name }}</span>
                                    <span
                                        class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">{{ auth()->user()->email }}</span>
                                </span>
                            @else
                                <span class="text-start ms-xl-2">
                                    <span class="fw-medium user-name-text">Khách</span>
                                </span>
                            @endif
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Xin chào!</h6>
                        <a class="dropdown-item" href="{{ route('profile.show') }}"><i
                                class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Hồ sơ</span></a>
                        <a class="dropdown-item" href="{{ route('index') }}"><i
                                class="mdi mdi-home-circle text-muted fs-16 align-middle me-1"></i> <span
                                class="align-middle">Về trang User</span></a>
                        <!-- Form đăng xuất cho Admin -->
                        <form id="logout-admin-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>

                        <!-- Liên Kết Đăng Xuất cho Admin -->
                        <a class="dropdown-item" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-admin-form').submit();">
                            <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle" data-key="t-logout">Đăng xuất</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
