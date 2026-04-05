<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/header.css'])
    @vite(['resources/css/footer.css'])
    @vite(['resources/css/register.css'])

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>{{ __('idioma.registro') }}</title>
</head>

<body>
    @include('layouts.header')

    <div id="registerForm">
        <div id="tituloForm">
            <h1>{{ __('idioma.registro') }}</h1>
        </div>
        <div id="divForm">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <input placeholder="{{ __('idioma.nombre') }}" type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror

                <input placeholder="{{ __('idioma.correo') }}" type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
                
                <input placeholder="{{ __('idioma.contrasena') }}" type="password" id="password" name="password" required>
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
                
                <input placeholder="{{ __('idioma.confirmar_contrasena') }}" type="password" id="password_confirmation" name="password_confirmation" required>
                @error('password_confirmation')
                    <p class="error">{{ $message }}</p>
                @enderror
                
                <input type="submit" value="{{ __('idioma.registrarse') }}">
            </form>
          
        </div>
        <div id="divEnlaces">
            <a href="{{ route('login') }}">{{ __('idioma.ya_tienes_cuenta') }}</a>
        </div>
    </div>

    @include('layouts.footer')
</body>

</html>
