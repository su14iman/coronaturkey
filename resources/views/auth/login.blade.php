<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CoronaTürkiye | Sign In</title>
    <!-- ================== GOOGLE FONTS ==================-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500" rel="stylesheet">
    <!-- ======================= GLOBAL VENDOR STYLES ========================-->
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendor/metismenu/dist/metisMenu.css">
    <link rel="stylesheet" href="../assets/vendor/switchery-npm/index.css">
    <link rel="stylesheet" href="../assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- ======================= LINE AWESOME ICONS ===========================-->
    <link rel="stylesheet" href="../assets/css/icons/line-awesome.min.css">
    <!-- ======================= DRIP ICONS ===================================-->
    <link rel="stylesheet" href="../assets/css/icons/dripicons.min.css">
    <!-- ======================= MATERIAL DESIGN ICONIC FONTS =================-->
    <link rel="stylesheet" href="../assets/css/icons/material-design-iconic-font.min.css">
    <!-- ======================= GLOBAL COMMON STYLES ============================-->
    <link rel="stylesheet" href="../assets/css/common/main.bundle.css">
    <!-- ======================= LAYOUT TYPE ===========================-->
    <link rel="stylesheet" href="../assets/css/layouts/vertical/core/main.css">
    <!-- ======================= MENU TYPE ===========================================-->
    <link rel="stylesheet" href="../assets/css/layouts/vertical/menu-type/content.css">
    <!-- ======================= THEME COLOR STYLES ===========================-->
    <link rel="stylesheet" href="../assets/css/layouts/vertical/themes/theme-i.css">
</head>

<body class="content-menu">
<div class="container">
    <form class="sign-in-form" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="card" style=" margin-top: -10%; ">
            <div class="card-body">
                <a href="index.html" class="brand text-center d-block m-b-20">
                    <img style=" width: 70%; " src="img/logo.png" alt="Logo" />
                </a>
                <h5 class="sign-in-heading text-center m-b-20">Sign in to your account</h5>
                <div class="form-group">
                    <label for="inputEmail" class="sr-only">{{ __('Username') }}</label>
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                             </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="sr-only">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="checkbox m-b-10 m-t-20">
                    <div class="custom-control custom-checkbox checkbox-primary form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="stateCheck1">	{{ __('Remember Me') }}</label>
                    </div>
                </div>

                <button style=" background: #df444c; " class="btn btn-danger btn-rounded btn-floating btn-lg btn-block" type="submit">
                    {{ __('Login') }}
                </button>

            </div>

        </div>
    </form>
</div>

<!-- ================== GLOBAL VENDOR SCRIPTS ==================-->
<script src="../assets/vendor/modernizr/modernizr.custom.js"></script>
<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/js-storage/js.storage.js"></script>
<script src="../assets/vendor/js-cookie/src/js.cookie.js"></script>
<script src="../assets/vendor/pace/pace.js"></script>
<script src="../assets/vendor/metismenu/dist/metisMenu.js"></script>
<script src="../assets/vendor/switchery-npm/index.js"></script>
<script src="../assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- ================== GLOBAL APP SCRIPTS ==================-->
<script src="../assets/js/global/app.js"></script>

</body>

</html>
