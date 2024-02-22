@extends('web.common.main')

@section('title', 'Home | Sun Security Services')

@section('customHeader')
@endsection

@section('main')
    <!-- Banner Section -->

    <div class="container-fluid px-0" id="banner">
        <div class="row no-gutters">
            <div class="col-md-9 carousel slide" data-ride="carousel" id="banner-img" data-pause="false">
                <div class="carousel-inner">
                    @forelse ($carousel as $index => $image)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-interval="3000">
                            <img src="{{ asset($image->image) }}" class="d-block w-100" alt="{{ $image->image }}">
                        </div>
                    @empty
                        <div class="carousel-item active" data-interval="3000">
                            <img src="{{ asset('website_assets/images/banner/banner-1.jpg') }}" class="d-block w-100"
                                alt="banner-1.jpg">
                        </div>
                    @endforelse
                </div>
                <button class="carousel-control-prev" type="button" data-target="#banner-img" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-target="#banner-img" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </button>
            </div>
            <div class="col-md-3" id="latest-news">
                <div style="background-color: black;">
                    <h2>Latest News</h2>
                </div>
                <marquee behavior="" Scrollamount=3 direction="up" onmouseover="this.stop();" onmouseout="this.start();">
                    @forelse ($news as $item)
                        <p>{{ $item->title }}</p>
                    @empty
                        <p>**No news found</p>
                    @endforelse
                </marquee>
            </div>
        </div>
    </div>

    <!-- End Banner Section -->

    <!-- Notification Section -->

    <div class="" id="notification">
        @if ($notification)
            <marquee behavior="" direction="left">
                <p><i>{{ $notification->title }}</i></p>
            </marquee>
        @endif
    </div>

    <!-- End Notification Section -->

    <!-- Short About Us -->

    <div class="container-fluid mt-5" id="welcome-section">
        <div class="row">
            <div class="col-md-6 col-sm-12" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="500">
                <img src="website_assets/images/aboutUs/short-about.jpg" alt="short-about">
            </div>
            <div class="col-md-6 col-sm-12" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="500">
                <div class="welcome-detail mt-3">
                    <h4>About us</h4>
                    <h2>Welcome to Sun Security Services</h2>
                    <p>We provide quality and professional security and allied services to clients with diverse
                        requirements with a strong commitment to customer services.</p>
                    <p>
                        Sun Security Services, is promoted by Major Surajit Barman (Retd.), a retired Indian Army Officer
                        with vast and diverse experiences in the field and administration during his services.
                    </p>
                    <div class="welcome-detail-btn">
                        <a href="{{ route('site.about') }}">
                            <span>Read More</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Short About Us -->

    <!-- Service Section -->

    <div class="container-fluid service-section mt-5">
        <div class="service-detail">
            <h3>Our services</h3>
        </div>
        <div class="service-img-container">
            <div class="service-img-box box-1 overlay" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="500">
                <a href="{{ route('site.services') }}">Commercial Security Service</a>
            </div>
            <div class="service-img-box box-2 overlay" data-aos="fade-down" data-aos-easing="linear"
                data-aos-duration="500">
                <a href="{{ route('site.services') }}">Residence Security Service</a>
            </div>
            <div class="service-img-box box-3 overlay" data-aos="fade-down" data-aos-easing="linear"
                data-aos-duration="500">
                <a href="{{ route('site.services') }}">Hotels & Malls Security Service</a>
            </div>
            <div class="service-img-box box-4 overlay" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="500">
                <a href="{{ route('site.services') }}">Gunman</a>
            </div>
        </div>
        <div class="service-btn" data-aos="zoom-in" data-aos-easing="linear" data-aos-duration="300">
            <a href="{{ route('site.services') }}">
                <span>View More</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <!--End Service Section -->

    <!-- Blog Section -->

    {{-- <div class="container-fluid" id="blog">
        <div class="blog-section">
            <h3>Our Blogs</h3>
        </div>
        <div class="row mt-4">
            @forelse ($blogs as $item)
                <div class="col-md-3 mb-3" data-aos="flip-right" data-aos-easing="linear" data-aos-duration="700">
                    <a class="text-decoration-none" target="_blank"
                        href="{{ route('site.blog', ['id' => Crypt::encrypt($item->id)]) }}">
                        <div class="card">
                            <img src="{{ asset($item->image) }}" class="card-img-top"
                                alt="{{ asset($item->image) }}">
                            <div class="card-body">
                                <h5 class="text-capitalize text-dark">{{ $item->title }}</h5>
                                <small>Admin | {{ date('d-m-Y', strtotime($item->created_at)) }}</small>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <p class="pl-3">**No blogs found</p>
            @endforelse
        </div>
        <div class="text-center">
            <a href="{{ route('site.blog') }}" class="text-decoration-none">
                <span class="text-uppercase text-dark">View More</span>
                <i class="fa-solid fa-arrow-right text-dark"></i>
            </a>
        </div>
    </div> --}}

    <!-- End Blog Section -->

    {{-- Quality policy --}}
    <div class="container-fluid mt-5" id="quality">
        <div class="row">
            <div class="col-12">
                <img src="{{ asset('website_assets/images/quality_policy/Certrificate.jpg') }}" alt="">
            </div>
        </div>
    </div>

    <!-- Testimonial Section -->

    <div class="container mb-5 mt-5" id="testimonial">
        <h3>Testimonials</h3>
        <div class="testimonial-box-container responsive my-4">

            @forelse ($testimonials as $item)
                <div class="testimonial-box">
                    <div class="box-top">
                        <div class="profile">
                            <div class="profile-img">
                                <img src="{{ asset($item->image) }}" alt="Profile image">
                            </div>
                            <div class="name-user">
                                <strong>{{ $item->name }}</strong>
                            </div>
                        </div>
                        <div class="review">{{ $item->rating }}
                            <div class="review-star">
                                @for ($i = 0; $i < $item->rating; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="comment">
                        <p>{{ $item->message }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center">
                    **No reviews found
                </p>
            @endforelse
        </div>
    </div>

    <!-- End Testimonial Section -->

    <!-- Certificates Section -->

    <div class="container-fluid mt-5" id="certificate">
        <div class="certificate-text text-center">
            <h3>Memberships/Affiliations</h3>
        </div>
        <div class="row image mt-4">
            <img src="{{ asset('website_assets/images/certificate/3.jpg') }}" alt="">
            <img src="{{ asset('website_assets/images/certificate/4.jpg') }}" alt="">
            <img src="{{ asset('website_assets/images/certificate/2.jpg') }}" alt="">
        </div>
    </div>

    <!-- End Caertificates Section -->

    <!-- Story Section -->

    <div class="container-fluid mt-5" id="story-section">
        <div class="card">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <img src="website_assets/images/aboutUs/story.jpg" alt="">
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="story-detail mt-4">
                        <h4>Our</h4>
                        <h2>Aims and Objectives</h2>
                        <p>It will be our journey to reach the zenith in the Indian Security Industry in terms of
                            products/service range, service quality, and operations network. We have a vision to provide
                            error free and cost effective World Class Security Services to meet and satisfy the exact needs
                            of our clients.</p>
                        <p>With the changing demands of the varied customers the security industry has also undergone
                            tremendous changes from the earlier days when security was more of a chowkidari concept to the
                            modern day security guard where the skills, motivation, initiative and training of the security
                            guard have more importance than ever.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Story Section -->

    <!-- Certificates Section  -->

    <div class="container-fluid mb-5 mt-5" id="certificates">
        <h3>Certificates</h3>
        <div class="row mt-2">
            <div class="col-6 mb-3">
                <a href="{{ asset('website_assets/images/certificate/CAPSI.jpg') }}" target="_blank"><img
                        src="{{ asset('website_assets/images/certificate/CAPSI.jpg') }}" alt="Certificate"></a>
            </div>
            <div class="col-6">
                <a href="{{ asset('website_assets/images/certificate/FIRE_SERVICES___INDUSTRIAL_SECURITY_MANAGEMENT.jpg') }}"
                    target="_blank"><img
                        src="{{ asset('website_assets/images/certificate/FIRE_SERVICES___INDUSTRIAL_SECURITY_MANAGEMENT.jpg') }}"
                        alt="Certificate"></a>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <a href="{{ asset('website_assets/images/certificate/24.05.2022_page-0001.jpg') }}" target="_blank">
                    <img src="{{ asset('website_assets/images/certificate/24.05.2022_page-0001.jpg') }}" alt="">
                </a>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <a href="{{ asset('website_assets/images/certificate/24.05.2022_page-0002.jpg') }}" target="_blank">
                    <img src="{{ asset('website_assets/images/certificate/24.05.2022_page-0002.jpg') }}" alt="">
                </a>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <a href="{{ asset('website_assets/images/certificate/24.05.2022_page-0003.jpg') }}" target="_blank">
                    <img src="{{ asset('website_assets/images/certificate/24.05.2022_page-0003.jpg') }}" alt="">
                </a>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <a href="{{ asset('website_assets/images/certificate/24.05.2022_page-0004.jpg') }}" target="_blank">
                    <img src="{{ asset('website_assets/images/certificate/24.05.2022_page-0004.jpg') }}" alt="">
                </a>
            </div>
        </div>
    </div>

    <!-- End Certificates Section -->

    <!-- Clients Section -->

    <div class="container-fluid" id="clients">
        <div class="text-center">
            <h3>Our Clients</h3>
        </div>
        <div class="clients-section mt-5">
            <marquee behavior="scroll" direction="left">
                <ul class="d-flex">
                    <li class="slide">
                        <img src="website_assets/images/clients/Airport Authority India.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/BSNL.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/Dishnet.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/Donbosco.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/Exim Bank.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/GNRC.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/Godrej.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/ICAR.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/Ignou.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/Indusland Bank.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/International Hospital.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/Marwari Hospital.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/NEDFi.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/NF Railway.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/NHAI.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/NIC.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/NRL Hospital.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/NSIC.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/Overnight Express.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/Pratiksha Hospital.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/Rajiv Gandhi Polytechnic.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/SAIL.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/Satribari Hospital.png" alt="">
                    </li>
                    <li class="slide">
                        <img src="website_assets/images/clients/SEBI.png" alt="">
                    </li>
                </ul>
            </marquee>
        </div>
    </div>
    <!-- End Clients Section -->
@endsection


@section('customJS')
@endsection
