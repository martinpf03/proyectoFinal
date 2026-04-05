<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('idioma.editar_subasta') }}</title>
    
    @vite(['resources/css/header.css'])
    @vite(['resources/css/footer.css'])
    @vite(['resources/css/forms.css'])
    @vite(['resources/css/menu-lateral.css'])

    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    @include('layouts.header')
    @include('layouts.menu')


    <div class="loginForm" id="subastaForm">
        <div id="tituloForm">
            <h1>{{ __('idioma.crear_subasta') }}</h1>
        </div>
        
        <div id="divForm">
            <form method="POST" action="{{ route('subastas.store') }}" enctype="multipart/form-data">
                @csrf

                <label for="producto_id">{{ __('idioma.producto') }}:</label>
                <select name="producto_id" id="producto_id" required>
                    <option value="" disabled selected>{{ __('idioma.elija_producto') }}</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
                <br>

                <input type="number" name="pInicial" placeholder="{{ __('idioma.precio_inicial') }}" required>
                <br><br>

                <label for="fechaInicio">{{ __('idioma.fecha_inicio') }}:</label>
                <input type="date" id="fechaInicio" name="fechaInicio" required>
                <br><br>

                <label for="fechaFin">{{ __('idioma.fecha_fin') }}:</label>
                <input type="date" id="fechaFin" name="fechaFin" required>
                <br><br>

                <input type="submit" value="{{ __('idioma.crear_subasta') }}">
            </form>
        </div>
    </div>

    @include('layouts.footer')
    @vite(['resources/js/menu.js'])
</body>

</html>
