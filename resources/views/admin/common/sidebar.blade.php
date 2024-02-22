<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.index') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img width="30" src="{{ asset('website_assets/images/logo/favicon.png') }}" alt="">
            </span>
            <span class="demo menu-text fw-bolder ms-2">Sun Security Services</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::routeIs('admin.index') ? 'active' : '' }}">
            <a href="{{ route('admin.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <li
            class="menu-item {{ Request::routeIs('admin.carousel.index') || Request::routeIs('admin.gallery.index') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div>Master</div>
            </a>

            <ul class="menu-sub">
                {{-- Carousel --}}
                <li class="menu-item {{ Request::routeIs('admin.carousel.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.carousel.index') }}" class="menu-link">
                        <div>Carousel</div>
                    </a>
                </li>

                {{-- Gallery --}}
                <li class="menu-item {{ Request::routeIs('admin.gallery.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.gallery.index') }}" class="menu-link">
                        <div>Gallery</div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Latest news --}}
        <li class="menu-item {{ Request::routeIs('admin.latestnews.index') ? 'active' : '' }}">
            <a href="{{ route('admin.latestnews.index') }}" class="menu-link">
                <i class='menu-icon bx bx-news'></i>
                <div>Latest News</div>
            </a>
        </li>

        {{-- Services --}}
        <li class="menu-item {{ Request::routeIs('admin.services.index') ? 'active' : '' }}">
            <a href="{{ route('admin.services.index') }}" class="menu-link">
                <i class='menu-icon bx bxs-grid'></i>
                <div>Services</div>
            </a>
        </li>

        {{-- Latest news --}}
        <li class="menu-item {{ Request::routeIs('admin.testimonial.index') ? 'active' : '' }}">
            <a href="{{ route('admin.testimonial.index') }}" class="menu-link">
                <i class='menu-icon bx bxs-star'></i>
                <div>Testimonial</div>
            </a>
        </li>

        {{-- Blog --}}
        <li
            class="menu-item {{ Request::routeIs('admin.blog.index') || Request::routeIs('admin.blog.add') || Request::routeIs('admin.blog.edit') ? 'active' : '' }}">
            <a href="{{ route('admin.blog.index') }}" class="menu-link">
                <i class='menu-icon bx bxl-blogger'></i>
                <div>Blog</div>
            </a>
        </li>

        {{-- Career --}}
        <li
            class="menu-item {{ Request::routeIs('admin.career.index') || Request::routeIs('admin.career.add') || Request::routeIs('admin.career.edit') ? 'active' : '' }}">
            <a href="{{ route('admin.career.index') }}" class="menu-link">
                <i class='menu-icon bx bxs-shopping-bag'></i>
                <div>Career</div>
            </a>
        </li>

        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Components</span></li>

    </ul>
</aside>
