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
                    <i data-feather="book" class="menu-icon tf-icons"></i>
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
                    <li class="menu-item">
                        <a href="lesson-preview.html" class="menu-link">
                            Thiết lập
                        </a>
                    </li>
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
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="activity" class="menu-icon tf-icons"></i>
                    <span class="title">Analytics</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="customers.html" class="menu-link">
                            Customers
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="reports.html" class="menu-link">
                            Reports
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="shopping-cart" class="menu-icon tf-icons"></i>
                    <span class="title">eCommerce</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="products.html" class="menu-link">
                            Products
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="product-details.html" class="menu-link">
                            Product Details
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="create-product.html" class="menu-link">
                            Create Product
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="orders-list.html" class="menu-link">
                            Orders List
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="order-details.html" class="menu-link">
                            Order Details
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="customers-2.html" class="menu-link">
                            Customers
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="cart.html" class="menu-link">
                            Cart
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="checkout.html" class="menu-link">
                            Checkout
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="sellers.html" class="menu-link">
                            Sellers
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <i data-feather="layers" class="menu-icon tf-icons"></i>
                    <span class="title">Pages</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="profile-2.html" class="menu-link">
                            Profile
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="pricing.html" class="menu-link">
                            Pricing
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="timeline.html" class="menu-link">
                            Timeline
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="faq.html" class="menu-link">
                            FAQ
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="blogs.html" class="menu-link">
                            Blogs
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="blog-details.html" class="menu-link">
                            Blog Details
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="gallery.html" class="menu-link">
                            Gallery
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="contact-us.html" class="menu-link">
                            Contact Us
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="404-error.html" class="menu-link">
                            404 Error Page
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
