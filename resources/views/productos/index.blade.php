<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('idioma.productos') }}</title>
    @vite(['resources/css/productos.css'])
    @vite(['resources/css/header.css'])
    @vite(['resources/css/footer.css'])
    @vite(['resources/css/menu-lateral.css'])
    <!-- Cargar Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    
    @include('layouts.header')
    @include('layouts.menu')

    <div id="bandaInicial">
        <h1>{{ __('idioma.productos') }}</h1>
    </div>

    <div id="content">
        @foreach ($productos as $producto)
        <a href="{{ route('productos.show', ['id' => $producto->id]) }}">
            <div class="divProducto">
                <img src="{{ $producto->url_imagen }}" alt="" class="imgProd">
                <h1>{{ $producto->nombre }}</h1>
                <p><strong>{{ __('idioma.Descripcion') }}:</strong> {{ $producto->descripcion }}</p>
                <p><strong>{{ __('idioma.precio') }}:</strong> {{ $producto->precio }}€</p>
            </div>
        </a>
        @endforeach
    </div>

    @include('layouts.footer')
  
    @vite(['resources/js/menu.js'])
</body>