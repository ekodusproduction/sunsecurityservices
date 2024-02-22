<nav class="navbar fixed-top navbar-expand-lg navbar-light bg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('site.home') }}">
            <div class="logo">
                <img src="{{ asset('website_assets/images/logo/logo.png') }}" alt="">
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('site.home') ? 'active' : '' }}" href="{{ route('site.home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('site.about') ? 'active' : '' }}" href="{{ route('site.about') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('site.services') ? 'active' : '' }}" href="{{ route('site.services') }}">Our Services</a>
                </li>                              
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('site.tips') ? 'active' : '' }}" href="{{ route('site.tips') }}">Security Tips</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('site.gallery') ? 'active' : '' }}" href="{{ route('site.gallery') }}">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('site.career') ? 'active' : '' }}" href="{{ route('site.career') }}">Career</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('site.contact') ? 'active' : '' }}" href="{{ route('site.contact') }}">Contact Us</a>
                </li>
            </ul>

        </div>
    </div>
</nav>
