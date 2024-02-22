@extends('web.common.main')

@section('title', 'Contact | Sun Security Services')

@section('customHeader')
    <style>
        #contactForm .form-control {
            border-radius: 0;
        }

        #contactForm .form-control[type=text],
        #contactForm .form-control[type=email] {
            height: 45px;
        }

    </style>
@endsection

@section('main')
    <div class="container" id="contactUs">
        <h2 class="">Contact Us</h2>
        <div class="row mt-4">

            <div class="col-md-6">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3580.851375626318!2d91.77632611439927!3d26.168969398011242!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x375a59097bfac91d%3A0x3bdfbbefa2eee16b!2sSUN%20SECURITY%20SERVICES!5e0!3m2!1sen!2sin!4v1651120575379!5m2!1sen!2sin"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-md-6">
                <p class="" style="font-size: 25px; color: black ; font-weight: 600;">Please provide the
                    followings :</p>
                <form id="contactForm">
                    <div class="mb-3">
                        <input id="name" name="name" class="form-control shadow-none" type="text" placeholder="Name">
                    </div>
                    <div class="mb-3">
                        <input id="email" name="email" class="form-control shadow-none" type="email"
                            placeholder="Valid email address">
                    </div>
                    <div class="mb-3">
                        <input id="phone" name="phone" class="form-control shadow-none" type="text" pattern="/^\d*(?:\.\d{1,2})?$/"
                            placeholder="Valid phone number">
                    </div>
                    <div class="mb-3">
                        <input id="subject" name="subject" class="form-control shadow-none" type="text"
                            placeholder="Subject">
                    </div>
                    <div class="mb-3">
                        <textarea id="message" name="message" class="form-control shadow-none" rows="3" placeholder="Your Message"></textarea>
                    </div>
                    <button id="submitBtn" class="btn btn-primary form-control" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('customJS')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#contactForm").validate({
                rules: {
                    name: "required",
                    email: "required",
                    phone: {
                        required: true,
                        number: true,
                        maxlength: 10
                    },
                    subject: "required",
                    message: "required"
                },
                messages: {
                    name: "Name field cannot be null",
                    email: "Email field cannot be null",
                    phone: {
                        required: "Phone number field cannot be null",
                        number: "Only accept numbers",
                        maxlength: "Please enter 10 digit phone number"
                    },
                    subject: "Subject field cannot be null",
                    message: "Message field cannot be null"

                },
                errorElement: "em",
                errorPlacement: function(error, element) {
                    // Add the `invalid-feedback` class to the error element
                    error.addClass("invalid-feedback");
                    error.insertAfter(element);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                },
                submitHandler: function(form, e) {
                    e.preventDefault();
                    $('#submitBtn').text('Please wait...');
                    $('#submitBtn').attr('disabled', true);
                    let formData = new FormData(form);
                    $.ajax({
                        method: 'post',
                        url: "{{ route('site.contact') }}",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data.status === 200) {
                                Swal.fire(
                                    'Good job!',
                                    data.message,
                                    'success'
                                ).then(() => {
                                    $(form)[0].reset();
                                    $('#submitBtn').text('Submit');
                                    $('#submitBtn').attr('disabled', false);
                                });
                            } else {
                                Swal.fire(
                                    'Error',
                                    data.message,
                                    'error'
                                ).then(() => {
                                    $('#submitBtn').text('Submit');
                                    $('#submitBtn').attr('disabled', false);
                                })
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
