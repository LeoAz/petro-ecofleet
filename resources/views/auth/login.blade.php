<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('dashlite/images/favicon.png') }}">
    <!-- Page Title  -->
    <title>Login | EcoFleet</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=2.9.0') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/skins/theme-egyptian.css?ver=2.9.0') }}">
</head>

<body class="nk-body bg-lighter npc-default has-aside no-touch nk-nio-theme toggle-shown ui-softy">
    <div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap nk-wrap-nosidebar">
            <!-- content @s -->
            <div class="nk-content ">
                <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                    <div class="brand-logo pb-4 text-center">
                        <a href="/" class="logo-link">
                            <img class="logo-light logo-img logo-img-lg" src="{{ asset('assets/images/newecofleet.png')}}" srcset="{{ asset('assets/images/newecofleet.png')}}" alt="logo">
                            <img class="logo-dark logo-img logo-img-lg" src="{{ asset('assets/images/newecofleet.png')}}" srcset="{{ asset('assets/images/newecofleet.png')}}" alt="logo-dark">
                        </a>
                    </div>
                    <div class="card">
                        <div class="card-inner card-inner-lg">
                            <div class="nk-block-head">
                                <div class="nk-block-head-content">
                                    <h4 class="nk-block-title">Se Connecter</h4>
                                    <div class="nk-block-des">
                                        <p>Veuillez rentrer vos differents identifiants pour vous s'authentifier</p>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('login') }}" method="POST" role="form">
                                @csrf
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label" for="default-01">Email ou Pseudo</label>
                                    </div>
                                    <input name="email" type="text" class="form-control form-control-lg @error('email') error @enderror" id="default-01" placeholder="Email ou Pseudo">
                                    @error('email')
                                    <span class="invalid">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label" for="password">Mot de passe</label>
                                    </div>
                                    <div class="form-control-wrap">
                                        <input name="password" type="password" class="form-control form-control-lg @error('password') error @enderror" id="password" placeholder="Saisir votre mot de passe">
                                        @error('password')
                                        <span class="invalid">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="nk-footer nk-auth-footer-full">
                    <div class="container wide-lg">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="nk-block-content text-center text-lg-left">
                                    <p class="text-soft">© {{ now()->year }} EcoFleet. All Rights Reserved.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- wrap @e -->
        </div>
        <!-- content @e -->
    </div>
    <!-- main @e -->
</div>
</body>
<!-- app-root @e -->
<!-- JavaScript -->
<script src="{{ asset('dashlite/assets/js/bundle.js?ver=2.3.0') }}"></script>
<script src="{{ asset('dashlite/assets/js/scripts.js?ver=2.3.0') }}"></script>

</html>
