<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('idioma.inicio') }}</title>

    @vite(['resources/css/inicio.css'])
    @vite(['resources/css/header.css'])
    @vite(['resources/css/footer.css'])
    @vite(['resources/css/menu-lateral.css'])

    <!-- Cargar Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    
    @include('layouts.header')
    @include('layouts.menu')

    <div id="bienvenida">
        <p>
            {{ __('idioma.bienvenida') }}
        </p>
    </div>

    <div id="secciones">
        <div class="seccion">
            <img src="media/img/consola.svg" height="200px" width="200px">
            <h1>{{ __('idioma.consolas') }}</h1>
        </div>
        <div class="seccion">
            <img src="media/img/pacman.svg" height="170px" width="170px">
            <h1>{{ __('idioma.arcades') }}</h1>
        </div>
        <div class="seccion">
            <img src="media/img/pieza.svg" height="170px" width="170px">
            <h1>{{ __('idioma.piezas') }}</h1>
        </div>
    </div>

    @include('layouts.footer')
    @vite(['resources/js/menu.js'])

</body>

</html>
