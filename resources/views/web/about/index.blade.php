@extends('web.common.main')

@section('title', 'About | Sun Security Services')

@section('customHeader')
@endsection

@section('main')
    <div class="container" id="about-us">
        <h3>About Us</h3>
        <div class="row mt-4">
            <div class="col-md-6 col-sm-12">
                <div class="welcome-detail">
                    <h5>Welcome to</h5>
                    <h2>Sun Security Services</h2>
                    <p class="mt-3">Sun Security Services was established in the year 1999, with the chief aim of providing quality and value-added security services to its customers. It is promoted by Major Surajit Barman (Retd.) under the aegis of DGR</p>

                    <p>Today, Sun Security Services has excelled itself as a leading service provider in the region with services rendered to most of the dominant names in the region. We have rendered security services to all the leading PSUs, Corporates, Banks, Universities, Educational institutions, Expos, and escorts to VIPs.</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <img src="{{asset('website_assets/images/aboutUs/aboutUs.jpg')}}" alt="About us">
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="welcome-detail">
                    <p class="mt-3">Given the scope of its operations, flexibility, and services, Sun Security Services has established itself as the leader in the region. Sun Security Services has its share of advantages over others in the field with its -</p>

                    <p>Management and administration by a team with a blend of diverse experiences; Exposure to a wide variety of security environments; Access to senior industry experts; Synthesis of experience, motivation, and training; Excellent track record of men management and services.</p>

                    <p>ISO: 9001: 2015 Certified.</p>
                </div>
            </div>

        </div>
    </div>
    <div class="container mt-5" id="about-card">
        <div class="card">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <img src="{{asset('website_assets/images/aboutUs/director.JPG')}}" alt="">
                </div>
                <div class="col-md-6 col-sm-12">
                    <h3>From the Director's Desk</h3>
                        <p class="mb-5">Sun Security Services is promoted by Major Surajit Barman (Retd.), a veteran retired Army Officer of the Indian Army with vast and diverse experiences in the field and administration during his services. He is being assisted by his team of administrators, mostly having varied experiences in the defense forces. With the scope of operations of Sun Security Services extending to the entire North East, he is assisted in the operation by a team of field managers and field supervisory staff based at various locations in the region.
                        </p>
                </div>
            </div>
            
        </div>
    </div>
@endsection

@section('customJS')
@endsection
