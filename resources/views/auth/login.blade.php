<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/header.css'])
    @vite(['resources/css/footer.css'])
    @vite(['resources/css/login.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>{{ __('idioma.login') }}</title>
</head>

<body>
    @include('layouts.header')



    <div id="loginForm">
        <div id="tituloForm">
            <h1>{{ __('idioma.login') }}</h1>
        </div>
        <div id="divForm">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input placeholder="{{ __('idioma.insertar_email') }}" type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
                <input type="password" id="password" name="password" required placeholder="{{ __('idioma.contrasena') }}">
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror

                <div class="remember-me">
                    <input type="checkbox" id="remember_me" name="remember">
                    <label for="remember_me">{{ __('idioma.recordarme') }}</label>
                </div>

                <input type="submit" value="{{ __('idioma.iniciar_sesion') }}">
            </form>
        </div>
        <div id="divEnlaces">
            <a href="{{ route('register') }}">{{ __('idioma.no_cuenta') }}</a>
            <a href="{{ route('password.request') }}">{{ __('idioma.olvido_contrasena') }}</a>
        </div>
    </div>

   @include('layouts.footer')
</body>

</html>
