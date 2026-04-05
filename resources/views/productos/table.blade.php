<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Products') }}</title>
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
        <h1>{{ __('idioma.productos') }}</h1>
    </div>

    <a id="crear" href="{{ route('productos.create') }}">{{ __('idioma.create_product') }}</a>
    <div id="content">
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __('idioma.nombre') }}</th>
                    <th>{{ __('idioma.url_imagen') }}</th>
                    <th>{{ __('idioma.Descripcion') }}</th>
                    <th>{{ __('Stock') }}</th>
                    <th>{{ __('idioma.precio') }}</th>
                    <th>{{ __('idioma.iva') }}</th>
                    <th>{{ __('idioma.tipo') }}</th>
                    <th>{{ __('idioma.acciones') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->url_imagen }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>{{ $producto->precio }}€</td>
                        <td>{{ $producto->IVA * 100 }}%</td>
                        <td>{{ $producto->tipo }}</td>
                        <td>
                            <a href="{{ route('productos.edit', $producto->id) }}">{{ __('idioma.editar') }}</a>
                            <!-- Formulario de eliminación -->
                            <form action="{{ route('productos.delete', $producto->id) }}" method="POST">
                                @csrf
                                <input type="submit" value="x" onclick="return confirm('{{ __('¿Estás seguro de que deseas eliminar este producto?') }}');">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('layouts.footer')

    @vite(['resources/js/menu.js'])
</body>
