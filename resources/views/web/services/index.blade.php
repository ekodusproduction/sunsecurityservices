@extends('web.common.main')

@section('title', 'Services | Sun Security Services')

@section('customHeader')
    <style>
        .card-body p {
            font-size: 14px
        }

    </style>
@endsection

@section('main')
    <div class="container" id="service">
        <!-- <div class="service-section">
                        
                    </div> -->
        <h2>Our Services</h2>
        <div class="row mt-3">
            <div class="col-md-6 mb-4">
                <div class="card">
                    @if ($commercial_security_service->image)
                        <img src="{{ asset($commercial_security_service->image) }}" class="card-img-top" alt="Services">
                    @else
                        <img src="{{ asset('website_assets/images/services/commercial-security.jpg') }}"
                            class="card-img-top" alt="Services">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">Commercial Security Service</h5>
                        <p class="card-text">Protecting a commercial entity from miscreants and thefts is of utmost
                            importance for a business to flourish. It is more comprehensive protection compared to
                            residential services, as they often target larger areas. Sun Security professionals guarantee
                            you a safe and carefree environment when you are at your workplace. Sun Security guards ensure
                            your safety by screening visitors at the entrance; thus preventing any miscreants from breaching
                            the place.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    @if ($residence_security_service->image)
                        <img src="{{ asset($residence_security_service->image) }}" class="card-img-top" alt="Services">
                    @else
                        <img src="{{ asset('website_assets/images/services/residence-security.jpg') }}"
                            class="card-img-top" alt="Services">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">Residence Security Service</h5>
                        <p class="card-text">Sun Security guards ensure safe and secured surroundings while you are
                            indoors at your home. Our professionals render services 24x7 by securing the premises from
                            unwarranted activities and thefts. Our security guards act as first-hand respondents in case of
                            any emergency. They receive training on reacting to situations where they face crisis.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    @if ($hotels_and_malls_security_service->image)
                        <img src="{{ asset($hotels_and_malls_security_service->image) }}" class="card-img-top"
                            alt="Services">
                    @else
                        <img src="{{ asset('website_assets/images/services/hotel-mall-security.jpg') }}"
                            class="card-img-top" alt="Services">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">Hotels & Malls Security Service</h5>
                        <p class="card-text">Enjoy a scrumptious meal at your favorite restaurant or shop your heart
                            out without worrying about any sort of misdeed in the vicinity. Keeping a location safe and
                            secure is the basic responsibility of any security guard.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    @if ($gunman->image)
                        <img src="{{ asset($gunman->image) }}" class="card-img-top" alt="Services">
                    @else
                        <img src="{{ asset('website_assets/images/services/gunman.jpg') }}" class="card-img-top"
                            alt="Services">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">Gunman</h5>
                        <p class="card-text">Our professionals provide complete safety to our customers and keep the
                            area under observation. They are armed with proper ammunition to protect any facility from
                            discrepancies. A sense of safety always persists for any individual to live and breathe freely
                            in a secured and peaceful environment.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJS')
@endsection
