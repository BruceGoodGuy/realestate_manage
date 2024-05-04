<div class="sidebar-area" id="sidebar-area">
    <div class="logo position-relative">
        <a href="{{ route('dashboard') }}" class="d-block text-decoration-none">
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="logo-icon">
            <span class="logo-text fw-bold text-dark">Farol</span>
        </a>
        <button
            class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y"
            id="sidebar-burger-menu">
            <i data-feather="x"></i>
        </button>
    </div>
    <aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
        <ul class="menu-inner">
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="members-grid.html" class="menu-link">
                        Members Grid
                    </a>
                </li>
                <li class="menu-item">
                    <a href="members-list.html" class="menu-link">
                        Members List
                    </a>
                </li>
                <li class="menu-item">
                    <a href="profile.html" class="menu-link">
                        Profile
                    </a>
                </li>
            </ul>
            </li>
            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">PAGES</span>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="user" class="menu-icon tf-icons"></i>
                    <span class="title">Khách hàng</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('client.index') }}" class="menu-link">
                            Danh sách
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('client.add') }}" class="menu-link">
                            Thêm mới
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('client.setting') }}" class="menu-link">
                            Thiết lập
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="archive" class="menu-icon tf-icons"></i>
                    <span class="title">Tài sản</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('property.index') }}" class="menu-link">
                            Danh sách
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('property.add') }}" class="menu-link">
                            Thêm mới
                        </a>
                    </li>
                    {{-- <li class="menu-item">
                        <a href="lesson-preview.html" class="menu-link">
                            Thiết lập
                        </a>
                    </li> --}}
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="dollar-sign" class="menu-icon tf-icons"></i>
                    <span class="title">Điểm và thưởng</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{route('setting.index')}}" class="menu-link">
                            Thiết lập
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="edit" class="menu-icon tf-icons"></i>
                    <span class="title">Hợp đồng</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('contract.index') }}" class="menu-link">
                            Danh sách
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('contract.add') }}" class="menu-link">
                            Thêm mới
                        </a>
                    </li>
                    {{-- <li class="menu-item">
                        <a href="lesson-preview.html" class="menu-link">
                            Thiết lập
                        </a>
                    </li> --}}
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="book" class="menu-icon tf-icons"></i>
                    <span class="title">Bài Viết</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="browse-courses.html" class="menu-link">
                            Danh sách
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('content.add') }}" class="menu-link">
                            Thêm mới
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="lesson-preview.html" class="menu-link">
                            Thiết lập
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
    <div class="bg-white z-1 admin">
        <div class="d-flex align-items-center admin-info border-top">
            <div class="flex-shrink-0">
                <x-responsive-nav-link :href="route('profile.edit')" :class="'d-block'">
                    <img src="{{ asset('assets/images/admin.jpg') }}" class="rounded-circle wh-54" alt="admin">
                </x-responsive-nav-link>
            </div>
            <div class="flex-grow-1 ms-3 info">
                <a href="{{ route('profile.edit') }}" class="d-block name">{{ auth()->user()->name ?? '' }}</a>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
                {{-- <a href="logout.html">Log Out</a> --}}
            </div>
        </div>
    </div>
</div>
