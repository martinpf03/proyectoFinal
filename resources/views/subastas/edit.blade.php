<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('idioma.editar_subasta') }}</title>
    
    @vite(['resources/css/header.css', 'resources/css/footer.css', 'resources/css/forms.css'])
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    @include('layouts.header')

    <div class="loginForm" id="subastaForm">
        <div id="tituloForm">
            <h1>{{ __('idioma.editar_subasta') }}</h1>
        </div>

        <div id="divForm">
            <form method="POST" action="{{ route('subastas.update', $subasta->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label for="producto_id">{{ __('idioma.producto') }}:</label>
                <select name="producto_id" id="producto_id" required>
                    <option value="" disabled>{{ __('idioma.elija_producto') }}</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}" 
                            {{ old('producto_id', $subasta->producto->id) == $producto->id ? 'selected' : '' }}>
                            {{ $producto->nombre }}
                        </option>
                    @endforeach
                </select>
                <br>

                <label for="pInicial">{{ __('idioma.precio_inicial') }}:</label>
                <input type="number" name="pInicial" id="pInicial" placeholder="{{ __('idioma.precio_inicial') }}" 
                    value="{{ old('pInicial', $subasta->pInicial) }}" required>
                <br><br>

                <label for="fechaInicio">{{ __('idioma.fecha_inicio') }}:</label>
                <input type="date" id="fechaInicio" name="fechaInicio" 
                    value="{{ old('fechaInicio', \Carbon\Carbon::parse($subasta->fechaInicio)->format('Y-m-d')) }}" required>
                <br><br>

                <label for="fechaFin">{{ __('idioma.fecha_fin') }}:</label>
                <input type="date" id="fechaFin" name="fechaFin" 
                    value="{{ old('fechaFin', \Carbon\Carbon::parse($subasta->fechaFin)->format('Y-m-d')) }}" required>
                <br><br>

                <input type="submit" value="{{ __('idioma.actualizar_subasta') }}">
            </form>
        </div>
    </div>

    @include('layouts.footer')
</body>

</html>
