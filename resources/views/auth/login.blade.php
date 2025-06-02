<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('images/ico/logoFiori.ico')}}">

    <title>Centro Médico Fiori | Login</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/skin_color.css') }}">

</head>

<body class="hold-transition theme-primary bg-img" style="background-image: url({{asset('images/auth/bg-1.jpg')}});">
    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">

            <div class="col-12">
                <div class="row justify-content-center g-0">
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="bg-white rounded10 shadow-lg">
                            <div class="content-top-agile p-20 pb-0">
                                <h2 class="text-primary">Bienvenidos</h2>
                                <p class="mb-0">Inicia sesión para continuar Centro Médico Fiori.</p>
                            </div>
                            <div class="p-40">
                                <form method="post" action="{{ route('login') }}" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-transparent">
                                                <i class="ti-user"></i>
                                            </span>
                                            <input type="text" name="username" id="username"
                                                class="form-control ps-15 bg-transparent"
                                                placeholder="{{ __('Usuario') }}"
                                                value="{{ old('username', null) }}">
                                        </div>
                                        {!! $errors->first('username', '<small class="text-danger">:message</small>') !!}
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text  bg-transparent">
                                                <i class="ti-lock"></i>
                                            </span>
                                            <input type="password" name="password" id="password"
                                                class="form-control ps-15 bg-transparent"
                                                placeholder="{{ __('Password...') }}">
                                        </div>
                                        {!! $errors->first('password', '<small class="text-danger">:message</small>') !!}
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-primary mt-10">Ingresar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS -->
    <script src="{{ asset('js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>
</body>

</html>