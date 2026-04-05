<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('idioma.pedidos') }}</title>
    @vite(['resources/css/tabla.css'])
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
        <h1>{{ __('idioma.pedidos') }}</h1>
    </div>

    <div id="content">
        @if ($pedidos)
            <table border="1">
                <th>ID</th>
                <th>{{ __('idioma.metodo_pago') }}</th>
                <th>{{ __('idioma.fecha_pedido') }}</th>
                <th>{{ __('idioma.productos') }}</th>
                @foreach ($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->metodoPago }}</td>
                            <td>{{ $pedido->fechaPedido }}</td>
                            <td>
                                <ul>
                                    @foreach ($pedido->productos as $producto)
                                        <li>{{ $producto->nombre }} // {{ __('idioma.unidades') }}: {{ $producto->pivot->cantidad }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                @endforeach
            </table>
        @else
            <p>{{ __('idioma.no_pedidos') }}</p>
        @endif
    </div>

    @include('layouts.footer')

    @vite(['resources/js/menu.js'])
</body>
