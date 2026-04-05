<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/menu-lateral.css'])
    @vite(['resources/css/header.css'])
    @vite(['resources/css/footer.css'])
    @vite(['resources/css/formProd.css'])

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Editar Producto</title>

    <script>
        $(document).ready(function() {
            $(".seccion").hide();

            let tipoSeleccionado = "{{ $producto->tipo }}";
            if (tipoSeleccionado) {
                $("#seccion_" + tipoSeleccionado).show();
            }

            $("#tipo").change(function() {
                let tipoSeleccionado = $(this).val();
                $(".seccion").hide();
                $("#seccion_" + tipoSeleccionado).show();
            });
        });
    </script>
</head>

<body>
    @include('layouts.header')
    @include('layouts.menu')

    <div id="loginForm">
        <div id="tituloForm">
            <h1>{{ __('idioma.editar_producto') }}</h1>
        </div>
        <div id="divForm">
            <form method="POST" action="{{ route('productos.update', [$producto->id]) }}" enctype="multipart/form-data">
                @csrf   
                @method('put')
                
                <label for="nombre">{{ __('idioma.nombre_producto') }}</label>
                <input type="text" id="nombre" name="nombre" value="{{ $producto->nombre }}" required> <br><br>
                
                <label for="file">{{ __('idioma.foto_producto') }}</label>
                <input type="file" id="url_imagen" name="url_imagen">
                <br> 
                
                <label for="descripcion">{{ __('idioma.descripcion_producto') }}</label>
                <textarea id="descripcion" name="descripcion" required>{{ $producto->descripcion }}</textarea><br>
                
                <label for="stock">{{ __('idioma.stock_disponible') }}</label>
                <input type="number" id="stock" name="stock" min="0" value="{{ $producto->stock }}" required>
                
                <label for="precio">{{ __('idioma.precio') }}</label>
                <input type="number" step="0.01" id="precio" name="precio" min="0" value="{{ $producto->precio }}" required>
                
                <label for="IVA">{{ __('idioma.iva') }}</label>
                <input type="number" step="0.01" id="IVA" name="IVA" min="0" value="{{ $producto->IVA }}" required>
                
                <label for="tipo">{{ __('idioma.seleccione_tipo') }}</label>
                <select id="tipo" name="tipo" required>
                    <option value="arcade" {{ $producto->tipo == 'arcade' ? 'selected' : '' }}>{{ __('idioma.arcade') }}</option>
                    <option value="consola" {{ $producto->tipo == 'consola' ? 'selected' : '' }}>{{ __('idioma.consola') }}</option>
                    <option value="pieza" {{ $producto->tipo == 'pieza' ? 'selected' : '' }}>{{ __('idioma.pieza') }}</option>
                </select>
                
                <!-- Sección PIEZA -->
                <div id="seccion_pieza" class="seccion">
                    <label for="dimensiones">{{ __('idioma.dimensiones') }}</label>
                    <input type="text" name="dimensiones" value="{{ $subtipo->dimensiones ?? '' }}" placeholder="{{ __('idioma.dimensiones') }}"><br>
                
                    <label for="peso">{{ __('idioma.peso') }}</label>
                    <input type="number" name="peso" value="{{ $subtipo->peso ?? '' }}" placeholder="{{ __('idioma.peso') }}"><br>
                
                    <label for="garantia">{{ __('idioma.garantia') }}</label>
                    <input type="text" name="garantia" value="{{ $subtipo->garantia ?? '' }}" placeholder="{{ __('idioma.garantia') }}">
                </div>
                
                <!-- Sección ARCADE -->
                <div id="seccion_arcade" class="seccion">
                    <label for="anho_salida">{{ __('idioma.ano_salida') }}</label>
                    <input type="number" name="anho_salida" value="{{ $subtipo->anho_salida ?? '' }}" placeholder="{{ __('idioma.ano_salida') }}"><br>
                
                    <label for="marcaArcade">{{ __('idioma.marca') }}</label>
                    <input type="text" name="marcaArcade" value="{{ $subtipo->marca ?? '' }}" placeholder="{{ __('idioma.marca') }}">
                </div>
                
                <!-- Sección CONSOLA -->
                <div id="seccion_consola" class="seccion"><br>
                    <input type="checkbox" name="portatil" {{ $subtipo && $subtipo->portatil ? 'checked' : '' }}> 
                    <label for="portatil">{{ __('idioma.portatil') }}</label><br>
                
                    <label for="marcaConsola">{{ __('idioma.marca') }}</label>
                    <input type="text" name="marcaConsola" value="{{ $subtipo->marca ?? '' }}" placeholder="{{ __('idioma.marca') }}">
                </div>
                
                <input type="submit" value="{{ __('idioma.actualizar_producto') }}">
                
            </form>
        </div>
    </div>

    @include('layouts.footer')

    @vite(['resources/js/menu.js'])
</body>

</html>

