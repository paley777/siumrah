<!DOCTYPE html>
<html data-bs-theme="light" lang="en" style="font-size: 13px;font-family: Manrope, sans-serif;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $active }} | SiUmrah Ver 1.0</title>
    <link rel="icon" href="{{ url('/assets/logo.jpg') }}" />
    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="{{ URL::asset('/css/portal.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="app" style="font-family: Manrope, sans-serif;">
    <section>
        @include('templates.partials.header')
        @yield('container')
    </section>
    <style>
        #btn-back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
        }
    </style>
    <!-- Back to top button -->
    <button type="button" class="btn btn-light btn-floating btn-lg" id="btn-back-to-top">

        <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="Arrow / Arrow_Up_SM">
                <path id="Vector" d="M12 17V7M12 7L8 11M12 7L16 11" stroke="#000000" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" />
            </g>
        </svg>
    </button>
    <script>
        //Get the button
        let mybutton = document.getElementById("btn-back-to-top");
        //When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            if (
                document.body.scrollTop > 20 ||
                document.documentElement.scrollTop > 20
            ) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }
        // When the user clicks on the button, scroll to the top of the document
        mybutton.addEventListener("click", backToTop);

        function backToTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <!-- Javascript -->
    <script src="{{ URL::asset('/plugins/popper.min.js') }}"></script>
    <script src="{{ URL::asset('/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('/plugins/chart.js/chart.min.js') }}"></script>
    <script src="{{ URL::asset('/js/index-charts.js') }}"></script>
    <script src="{{ URL::asset('/js/app.js') }}"></script>
    <script defer src="{{ URL::asset('/plugins/fontawesome/js/all.min.js') }}"></script>
</body>

</html>
