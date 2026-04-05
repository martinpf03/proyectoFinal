<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/header.css'])
    @vite(['resources/css/footer.css'])
    @vite(['resources/css/login.css'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>{{ __('idioma.recuperar_contrasena') }}</title>
</head>

<body>
    @include('layouts.header')

    <div id="loginForm">
        <div id="tituloForm">
            <h2>{{ __('idioma.recuperar_contrasena') }}</h2>
        </div>
        <div id="divForm">
            <p>{{ __('idioma.recuperar_contrasena_texto') }}</p>
            
            <!-- Estado de la sesión -->
            @if (session('status'))
                <p class="success-message">{{ session('status') }}</p>
            @endif
            
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                
                <input placeholder="{{ __('idioma.insertar_email') }}" type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
                
                <input type="submit" value="{{ __('idioma.enviar_enlace') }}">
            </form>
        </div>
        <div id="divEnlaces">
            <a href="{{ route('login') }}">{{ __('idioma.volver_login') }}</a>
        </div>
    </div>

    @include('layouts.footer')
</body>

</html>
