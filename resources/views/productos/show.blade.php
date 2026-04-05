<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('idioma.producto') }}</title>
    <link rel="stylesheet" href="../css/subasta.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/menu-lateral.css">
    <!-- Cargar Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/producto.css'])
    @vite(['resources/css/header.css'])
    @vite(['resources/css/footer.css'])
    @vite(['resources/css/menu-lateral.css'])
</head>

<body>
    @include('layouts.header')
    @include('layouts.menu')

    <div id="content">
        <div id="divImg">
            <img src="../{{ $producto->url_imagen }}" alt="" id="imgProd">
        </div>
        <h1 id="nomeProd">{{ $producto->nombre }}</h1>
        <div id="divDesc">
            <p>{{ __('idioma.descripcion') }}: {{ $producto->descripcion }}</p>
            
            @if ($producto->tipo == 'pieza')
                <p>{{ __('idioma.dimensiones') }}: {{ $subtipo->dimensiones }}</p>
                <p>{{ __('idioma.peso') }}: {{ $subtipo->peso }}</p>
            @endif

            @if ($producto->tipo == 'consola')
                <p>{{ __('idioma.portatil') }}:
                    @if ($subtipo->portatil)
                        {{ __('idioma.si') }}
                    @else
                        {{ __('idioma.no') }}
                    @endif
                </p>
            @endif

            @if ($producto->tipo == 'arcade')
                <p>{{ __('idioma.anho_salida') }}: {{ $subtipo->anho_salida }}</p>
            @endif

            @if ($producto->tipo == 'arcade' || $producto->tipo == 'consola')
                <p>{{ __('idioma.marca') }}: {{ $subtipo->marca }}</p>
            @endif

            <h3>{{ __('idioma.unidades_restantes') }}: {{ $producto->stock }}</h3>
        </div>

        <div id="tabPuja" border="1"></div>

        <form action="{{ route('carrito.add') }}" method="POST">
            @csrf
            <div id="divPagar">
                <input type="submit" id="btnPagar" value="{{ __('idioma.carrito') }}"></input>
                <input type="number" name="cantidad" value="1" min="1" max="{{$producto->stock}}">
                <input type="hidden" name="id" value="{{$producto->id}}">
                <input type="hidden" name="precio_carrito" value="{{$producto->precio}}">
                <span>{{ $producto->precio }}€</span>
            </div>
        </form>
    </div>

    @include('layouts.footer')
    @vite(['resources/js/menu.js'])
</body>
