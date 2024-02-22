<footer class="footer mt-5">
    <div class="container-fluid" id="footer">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 leftBox">
                <div class="">
                    <a href="/">
                        <img src="{{ asset('website_assets/images/logo/logo.png') }}" alt="logo.png">
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 centerBox1">
                <h6>Address</h6>
                <div class="place mb-1">
                    <span class="fas fa-map-marker-alt mr-1"></span>
                    <span class="text">H/NO- 211, 1st floor, Near A.I.D.C, RG Baruah Rd, Guwahati, Assam
                        781024</span>
                </div>
                <div class="phone mb-1">
                    <span class="fas fa-phone-alt mr-1"></span>
                    <span class="text">+91- 9954705329</span>
                </div>
                <div class="phone mb-1">
                    <span class="fas fa-phone-alt mr-1"></span>
                    <span class="text">0361-2950055 / 0361-3556491</span>
                </div>
                <div class="email mb-1">
                    <span class="fas fa-envelope mr-1"></span>
                    <span class="text">admin@sunsecuritymail.com</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 centerBox2">
                <h6>Social Links</h6>
                <div class="content">
                    <div class="social">
                        <a href="https://www.facebook.com/sunsecutiryservice/" target="_blank"><span><i
                                    class="fa-brands fa-facebook mr-2"></i></span></a>
                        <a href="https://www.instagram.com/sunsecurityservices/?igshid=YmMyMTA2M2Y="
                            target="_blank"><span><i class="fa-brands fa-instagram"></i></span></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 rightBox">
                <h6>Newsletter</h6>
                <div class="boxContent">
                    <form id="submitNewsletterForm" action="{{ route('site.newsletter') }}">
                        <div class="mb-1">
                            <input type="email" name="emailNewsletter" id="emailNewsletter"
                                placeholder="Enter Email Address">
                        </div>
                        <button type="submit" class="btn shadow-none" id="btnSubscribe">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="col-md-12" id="footer-text">
                <hr>
                <div class="d-sm-flex justify-content-between">
                    <p>All Rights Reserved &copy; <span id="demo"></span> Sun Security Services.
                    </p>
                    <p>Designed & Developed by <a target="_blank" href="https://ekodus.com/">Ekodus Technologies
                            Pvt. Ltd.</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
