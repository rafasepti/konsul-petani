<!--
=========================================================
* Material Kit 2 - v3.0.4
=========================================================

* Product Page:  https://www.creative-tim.com/product/material-kit
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('petani/assets') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('petani/assets') }}/img/favicon.png">
    <title>
        Konsultasi Pertanian
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('petani/assets') }}/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('petani/assets') }}/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('petani/assets') }}/css/material-kit.css?v=3.0.4" rel="stylesheet" />
    @yield('style')
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    @vite(['resources/js/app.js'])
</head>

<body class="presentation-page bg-gray-200">
    <!-- Navbar -->
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                @include('layouts.petani.navbar')
                <!-- End Navbar -->
            </div>
        </div>
    </div>
    @yield('header')
    <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
        @yield('content')
    </div>
    @include('layouts.petani.footer')

    <script>
        var botmanWidget = {
            aboutText: 'Konsultasi Pertanian',
            title: 'Konsultasi Pertanian',
            introMessage: "Halo! Apakah ada yang bisa dibantu?",
            mainColor: '#4CAF50', // Main color
            bubbleBackground: '#4CAF50', // Background color of the bubble
            headerTextColor: '#fff', // Text color of the header
        };
    </script>
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script async defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script async defer src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <!--   Core JS Files   -->
    <script src="{{ asset('petani/assets') }}/js/core/popper.min.js" type="text/javascript"></script>
    <script src="{{ asset('petani/assets') }}/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ asset('petani/assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
    <!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
    <script src="{{ asset('petani/assets') }}/js/plugins/countup.min.js"></script>
    <!--  Plugin for Parallax, full documentation here: https://github.com/dixonandmoe/rellax -->
    <script src="{{ asset('petani/assets') }}/js/plugins/rellax.min.js"></script>
    <!--  Plugin for TiltJS, full documentation here: https://gijsroge.github.io/tilt.js/ -->
    <script src="{{ asset('petani/assets') }}/js/plugins/tilt.min.js"></script>
    <!--  Plugin for Selectpicker - ChoicesJS, full documentation here: https://github.com/jshjohnson/Choices -->
    <script src="{{ asset('petani/assets') }}/js/plugins/choices.min.js"></script>
    <!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
    <script src="{{ asset('petani/assets') }}/js/material-kit.min.js?v=3.0.4" type="text/javascript"></script>
    <script type="text/javascript">
        if (document.getElementById('state1')) {
            const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
            if (!countUp.error) {
                countUp.start();
            } else {
                console.error(countUp.error);
            }
        }
        if (document.getElementById('state2')) {
            const countUp1 = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
            if (!countUp1.error) {
                countUp1.start();
            } else {
                console.error(countUp1.error);
            }
        }
        if (document.getElementById('state3')) {
            const countUp2 = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));
            if (!countUp2.error) {
                countUp2.start();
            } else {
                console.error(countUp2.error);
            };
        }
    </script>
    <script>
        $(document).ready(function() {
            function replaceButton() {
                $('#messageArea .btn').each(function() {
                    if ($(this).attr('replaced') !== 'true') {
                        var newButton = '<a href="https://wa.link/0wrvo0" class="btn">' + $(this).text() +
                            '</a>';
                        $(this).replaceWith(newButton);
                        $(this).attr('replaced', 'true');
                        console.log("Button replaced:", this);
                    }
                });
            }

            // Memanggil fungsi replaceButton secara berkala
            setInterval(replaceButton, 1000); // Cek setiap 1 detik
        });
    </script>
    @yield('script')
</body>

</html>
