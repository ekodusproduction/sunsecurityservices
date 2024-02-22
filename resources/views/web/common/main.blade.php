<!Doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta name="description"
        content="We provide quality and professional security and allied services to clients with diverse requirements with a strong commitment to customer services. Sun Security Services,  is promoted by Major Surajit Barman (Retd.), a young retired Army Officer of the Indian Army with vast and diverse experiences in the field and administration during his services.">
    <meta name="keywords"
        content="Sun Security, Sun Security Services, professional security, allied services, NISHTHA SAHIT SEVA, best security, security in assam, guwahati security guard ">

    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('website_assets/images/logo/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- SLick -->
    <link rel="stylesheet" href="{{ asset('website_assets/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('website_assets/plugins/slick/slick-theme.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('website_assets/css/main.css') }}">
    @yield('customHeader')

</head>

<body>
    <!-- Header Section -->
    @include('web.common.navbar')
    <!-- End Header Section -->

    @yield('main')

    <!-- Footer -->
    @include('web.common.footer')

    <!-- End Footer Section -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Slick Script -->
    <script src="{{ asset('website_assets/plugins/slick/slick.min.js') }}"></script>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({
            disable: 'mobile'
        });
    </script>

    <!-- Sweetalert 2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('website_assets/js/main.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        $('.responsive').not('.slick-initialized').slick({
            dots: true,
            arrows: false,
            infinite: true,
            speed: 700,
            slidesToShow: 2,
            slidesToScroll: 2,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true,
                        arrows: false,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        arrows: false
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false
                    }
                }
            ]
        });
    </script>

    <script>
        $("#submitNewsletterForm").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            let btn = $('#btnSubscribe');
            btn.text('Wait...');
            btn.attr('disabled', true);

            var form = $(this);
            var actionUrl = form.attr('action');

            let formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: actionUrl,
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status === 200) {
                        btn.text('Subscribe');
                        btn.attr('disabled', false);
                        Swal.fire(
                            'Good job!',
                            data.message,
                            'success'
                        ).then(() => {
                            $(form).trigger("reset");
                        })
                    } else {
                        btn.text('Subscribe');
                        btn.attr('disabled', false);
                        Swal.fire(
                            'Oops!',
                            data.message,
                            'error'
                        ).then(() => {
                            $(form).trigger("reset");
                        });
                    }
                },
                error: function(data) {
                    btn.text('Subscribe');
                    btn.attr('disabled', false);
                    Swal.fire(
                        'Oops!',
                        'Server error',
                        'error'
                    )
                }
            });
        });
    </script>

    @yield('customJS')
</body>

</html>
