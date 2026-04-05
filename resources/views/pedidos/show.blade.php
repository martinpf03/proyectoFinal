<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('idioma.pedido') }}</title>
    @vite(['resources/css/perfil.css'])
    @vite(['resources/css/header.css'])
    @vite(['resources/css/footer.css'])
    @vite(['resources/css/menu-lateral.css'])
    <!-- Cargar Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>

    @include('layouts.header')
    @include('layouts.menu')

<div id="divCarrito" class="divsPerfil">
    <h1>{{ __('idioma.pedido') }}</h1>
    <h1 style="color:red">{{ __('idioma.importante') }}</h1>
    <div id="carrito">
        @if ($productos != null)
        @foreach ($productos as $producto)
        <a href="{{ route('productos.show', ['id' => $producto->id]) }}">
            
            <div class="prod">
                <img src="../{{ $producto->url_imagen }}" alt="Imagen del producto">
               
                <div class="datosProd">
                    <h1>{{ $producto->nombre }}</h1>
                    <p>{{ $producto->descripcion }}</p>
                    <p>{{ __('idioma.unidades') }}: {{$producto->pivot->cantidad}}</p>
                    <p>{{ __('idioma.precio_unidad') }}: {{$producto->precio}} </p>
                </div>
                <div class="precio">
                    <h1>
                        <p>{{ $producto->precio * $producto->pivot->cantidad }}€</p>
                    </h1>
                </div>
            </div>
        </a>  
        @endforeach
        @endif
        <div id="confPedido">
            <form action="{{ route('pedidos.store') }}" method="POST">
                @csrf
                <input type="radio" name="metodoPago" id="tarjeta" value="tarjeta"><label for="tarjeta">{{ __('idioma.tarjeta') }}</label>
                <input type="radio" name="metodoPago" id="paypal" value="paypal"><label for="paypal">PayPal</label><br>
                <input type="submit" value="{{ __('idioma.confirmar_pedido') }}">
            </form>
        </div>
    </div>

    

@include('layouts.footer')
@vite(['resources/js/menu.js'])

</body>
