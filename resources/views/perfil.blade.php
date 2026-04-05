<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('idioma.perfil') }}</title>

    @vite(['resources/css/menu-lateral.css'])
    @vite(['resources/css/perfil.css'])
    @vite(['resources/css/header.css'])
    @vite(['resources/css/footer.css'])


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>

    @include('layouts.header')
    @include('layouts.menu')

    <div id="contenido">
        <div id="divDatos" class="divsPerfil">
            <h1>{{ __('idioma.perfil') }}</h1>
            <img src="../media/img/darwin.jpg" alt="" border="1">
            <div id="datos">
                <p>{{ __('idioma.nombre') }}: {{Auth::user()->name}}</p>
                <p>{{ __('idioma.correo') }}: {{Auth::user()->email}}</p>
                <p>{{ __('idioma.palace_points') }}: 1,250</p>
                <p>{{ __('idioma.articulos_venta') }}: 32</p>
                <p>{{ __('idioma.articulos_subasta') }}: 5</p>
                <p><a class="enlacePedidos" href="{{ route('pedidos.index') }}" hreflang="es">{{ __('idioma.pedidos') }}</a></p>
                 <p><form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="color:red">{{ __('idioma.cerrar_sesion') }}</button>
                </form></p>
            </div>
        </div>
        <div id="divVentas" class="divsPerfil">
            <h1><a href="{{route('productos.table')}}">{{ __('idioma.ventas') }}</a></h1>
            <div id="scroll">
                @if ($productos != null)
                    @foreach ($productos as $producto)
                    <a href="{{route('productos.show',[$producto->id])}}">
                        <img src="{{$producto->url_imagen}}" border="1" alt="{{ $producto->nombre }}"></img>
                        @endforeach
                    </a>
                @endif
            </div>
        </div>
        <div id="divSubastas" class="divsPerfil">
            <h1><a href="{{route('subastas.table')}}">{{ __('idioma.subastas') }}</a></h1>
            <div id="scroll">
                @if ($subastas != null)
                    @foreach ($subastas as $subasta)
                    <a href="{{route('subastas.show',[$subasta->id])}}">
                        <img src="{{$subasta->producto->url_imagen}}" border="1" alt="{{ $subasta->producto->nombre }}">
                    </a>
                    @endforeach
                @endif
            </div>
        </div>
        <div id="divCarrito" class="divsPerfil">
            <h1>{{ __('idioma.carrito') }}</h1>
            <div id="carrito">
                @if ($carrito!=null)
                @foreach ($carrito->productos as $producto)
                <a href="{{route('productos.show',['id' => $producto->id])}}">
                    <div class="prod">
                        <div class="delCarrito">
                            <form action="{{route('carrito.del',[$producto->id,$producto->pivot->precio_carrito])}}" method="POST">
                                @csrf
                                <input type="submit" value="x">
                            </form>
                        </div>
                        <img src="{{$producto->url_imagen}}" alt="Imagen del producto">
                        <div class="datosProd">
                            <h1>{{ $producto->nombre }}</h1>
                            <p>{{ $producto->descripcion }}</p>
                            <p>{{ __('idioma.unidades') }}: {{$producto->pivot->cantidad}}</p>
                            <p>{{ __('idioma.precio_unidad') }}: {{$producto->pivot->precio_carrito}} </p>
                        </div>
                        <div class="precio">
                            <h1>
                                <p>{{ $producto->pivot->precio_carrito*$producto->pivot->cantidad }}€</p>
                            </h1>
                        </div>
                    </div>
                </a>  
                @endforeach
                @endif
            </div>
        </div>
    </div>

    <a class="enlacePedidos" href="{{route('pedidos.show')}}">{{ __('idioma.hacer_pedido') }}</a>

    @include('layouts.footer')
    
    @vite(['resources/js/menu.js'])

</body>

</html>