<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('idioma.alta_producto') }}</title>
    @vite(['resources/css/header.css'])
    @vite(['resources/css/footer.css'])
    @vite(['resources/css/formProd.css'])
    @vite(['resources/css/menu-lateral.css'])

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ocultar todas las secciones al inicio
            $(".seccion").hide();

            // Evento al cambiar el tipo de producto
            $("#tipo").change(function() {
                let tipoSeleccionado = $(this).val();

                // Ocultar todas las secciones antes de mostrar la correcta
                $(".seccion").hide();

                // Mostrar la sección correspondiente
                if (tipoSeleccionado === "pieza") {
                    $("#seccion_pieza").show();
                } else if (tipoSeleccionado === "arcade") {
                    $("#seccion_arcade").show();
                } else if (tipoSeleccionado === "consola") {
                    $("#seccion_consola").show();
                }
            });
        });
    </script>
</head>

<body>
    @include('layouts.header')
    @include('layouts.menu')

    <div id="loginForm">
        <div id="tituloForm">
            <h1>{{ __('idioma.alta_producto') }}</h1>
        </div>
        <div id="divForm">
            <form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data">
                @csrf
                <label for="nombre">{{ __('idioma.nombre_producto') }}</label>
                <input type="text" placeholder="{{ __('idioma.inserte_nombre') }}" id="nombre" name="nombre" required> <br> <br>

                <label for="url_imagen">{{ __('idioma.foto_producto') }}</label>
                <input type="file" id="url_imagen" name="url_imagen" required>

                <label for="descripcion">{{ __('idioma.descripcion_producto') }}</label>
                <textarea placeholder="{{ __('idioma.descripcion_producto') }}" id="descripcion" name="descripcion" required></textarea><br>

                <label for="stock">{{ __('idioma.stock_disponible') }}</label>
                <input type="number" placeholder="{{ __('idioma.stock_disponible') }}" id="stock" name="stock" min="0" required>

                <label for="precio">{{ __('idioma.precio') }}</label>
                <input type="number" step="0.01" placeholder="{{ __('idioma.precio') }}" id="precio" name="precio" min="0" required>

                <label for="IVA">{{ __('idioma.iva') }}</label>
                <input type="number" step="0.01" placeholder="{{ __('idioma.iva') }}" id="IVA" name="IVA" min="0" required>

                <select id="tipo" name="tipo" required>
                    <option value="" disabled selected>{{ __('idioma.seleccione_tipo') }}</option>
                    <option value="arcade">{{ __('idioma.arcade') }}</option>
                    <option value="consola">{{ __('idioma.consola') }}</option>
                    <option value="pieza">{{ __('idioma.pieza') }}</option>
                </select>

                <!-- Sección PIEZA -->
                <div id="seccion_pieza" class="seccion">
                    <input type="text" name="dimensiones" placeholder="{{ __('idioma.dimensiones') }}"><br>
                    <input type="number" name="peso" placeholder="{{ __('idioma.peso') }}"><br>
                    <input type="number" name="garantia" placeholder="{{ __('idioma.garantia') }}">
                </div>

                <!-- Sección ARCADE -->
                <div id="seccion_arcade" class="seccion">
                    <input type="number" name="anho_salida" placeholder="{{ __('idioma.ano_salida') }}"><br>
                    <input type="text" name="marcaArcade" placeholder="{{ __('idioma.marca') }}">
                </div>

                <!-- Sección CONSOLA -->
                <div id="seccion_consola" class="seccion"><br>
                    <input type="checkbox" name="portatil"> <label for="portatil">{{ __('idioma.portatil') }}</label><br>
                    <input type="text" name="marcaConsola" placeholder="{{ __('idioma.marca') }}">
                </div>

                <input type="submit" value="{{ __('idioma.subir_producto') }}">
            </form>
        </div>
    </div>
    
@include('layouts.footer')    @vite(['resources/js/menu.js'])

</body>

