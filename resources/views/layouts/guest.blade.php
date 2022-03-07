<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/Epin-api-logo.svg') }}" type="image/svg" />
    
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

    <title>{{ config('app.name', 'Epin') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

</head>

<body class="bg-theme" onload="setThemeFromCookie();">
    <div class="font-sans text-gray-900 antialiased wrapper">
        {{ $slot }}
    </div>
    <!--start switcher-->
    <div class="switcher-wrapper">
        <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
        </div>
        <div class="switcher-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 text-uppercase">{{ __('mainNav.theme') }}</h5>
                <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
            </div>
            <hr />

            <ul class="switcher">
                <li id="theme1"></li>
                <li id="theme2"></li>
                {{-- <li id="theme3"></li> --}}
                <li id="theme4"></li>
                <li id="theme5"></li>
                <li id="theme6"></li>

                {{-- <li id="theme7"></li> --}}
                <li id="theme8"></li>
                <li id="theme9"></li>
                <li id="theme10"></li>
                {{-- <li id="theme11"></li>
                    <li id="theme12"></li>
                    <li id="theme13"></li>
                    <li id="theme14"></li>
                    <li id="theme15"></li> --}}
            </ul>
        </div>
    </div>
    <!--end switcher-->

    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <script>
        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function setThemeFromCookie() {
            var themeNo = parseInt(getCookie("theme"));
            if (!themeNo) {
                themeNo = 1;
            }
            document.body.classList.add("bg-theme" + themeNo);
        }



        $(".switcher-btn").on("click", function() {
                $(".switcher-wrapper").toggleClass("switcher-toggled")
            }), $(".close-switcher").on("click", function() {
                $(".switcher-wrapper").removeClass("switcher-toggled")
            }),
        

        $('#theme1').click(theme1);
        $('#theme2').click(theme2);
        $('#theme3').click(theme3);
        $('#theme4').click(theme4);
        $('#theme5').click(theme5);
        $('#theme6').click(theme6);
        $('#theme7').click(theme7);
        $('#theme8').click(theme8);
        $('#theme9').click(theme9);
        $('#theme10').click(theme10);
        $('#theme11').click(theme11);
        $('#theme12').click(theme12);
        $('#theme13').click(theme13);
        $('#theme14').click(theme14);
        $('#theme15').click(theme15);

        function theme1() {
            $('body').attr('class', 'bg-theme bg-theme1');
            setCookie("theme", 1, 365);
        }

        function theme2() {
            $('body').attr('class', 'bg-theme bg-theme2');
            setCookie("theme", 2, 365);
        }

        function theme3() {
            $('body').attr('class', 'bg-theme bg-theme3');
            setCookie("theme", 3, 365);
        }

        function theme4() {
            $('body').attr('class', 'bg-theme bg-theme4');
            setCookie("theme", 4, 365);
        }

        function theme5() {
            $('body').attr('class', 'bg-theme bg-theme5');
            setCookie("theme", 5, 365);
        }

        function theme6() {
            $('body').attr('class', 'bg-theme bg-theme6');
            setCookie("theme", 6, 365);
        }

        function theme7() {
            $('body').attr('class', 'bg-theme bg-theme7');
            setCookie("theme", 7, 365);
        }

        function theme8() {
            $('body').attr('class', 'bg-theme bg-theme8');
            setCookie("theme", 8, 365);
        }

        function theme9() {
            $('body').attr('class', 'bg-theme bg-theme9');
            setCookie("theme", 9, 365);
        }

        function theme10() {
            $('body').attr('class', 'bg-theme bg-theme10');
            setCookie("theme", 10, 365);
        }

        function theme11() {
            $('body').attr('class', 'bg-theme bg-theme11');
            setCookie("theme", 11, 365);
        }

        function theme12() {
            $('body').attr('class', 'bg-theme bg-theme12');
            setCookie("theme", 12, 365);
        }

        function theme13() {
            $('body').attr('class', 'bg-theme bg-theme13');
            setCookie("theme", 13, 365);
        }

        function theme14() {
            $('body').attr('class', 'bg-theme bg-theme14');
            setCookie("theme", 14, 365);
        }

        function theme15() {
            $('body').attr('class', 'bg-theme bg-theme15');
            setCookie("theme", 15, 365);
        }
    </script>
</body>

</html>
