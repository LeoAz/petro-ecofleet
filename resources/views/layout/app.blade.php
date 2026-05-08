<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Leo AZ">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>Ecofleet | Gestion Transport</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=2.9.0') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=2.9.0') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/skins/theme-egyptian.css?ver=2.9.0') }}">
    @yield('add_css')
</head>

<body class="nk-body bg-lighter npc-default has-aside no-touch nk-nio-theme ui-softy">
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main navbar @e -->
            <x-navbar/>
            <!-- main header @e -->
            <!-- content @s -->
            <div class="nk-content ">
                <div class="container wide-xl">
                    <div class="nk-content-inner">
                        <x-resp-menu/>
                        @yield('sidebar')
                        <div class="nk-content-body">
                            <div class="nk-content-wrap">
                                @yield('content')
                            </div>
                            <!-- footer @s -->
                            <x-footer/>
                            <!-- footer @e -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- main @e -->
</div>
<!-- app-root @e -->
<!-- JavaScript -->
<script src="{{ asset('assets/js/bundle.js?ver=2.9.0')}}"></script>
<script src="{{ asset('assets/js/scripts.js?ver=2.9.0')}}"></script>
@yield('add_js')
@stack('scripts')
</body>

</html>
