<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('idioma.subastas') }}</title>
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
        <h1>{{ __('idioma.subastas') }}</h1>
    </div>
    
    <a id="crear" href="{{ route('subastas.create') }}">{{ __('idioma.crear_subasta') }}</a>

    <div id="content">
        <table border="1">
            <th>ID</th>
            <th>{{ __('idioma.productos') }}</th>
            <th>{{ __('idioma.precio_inicial') }}</th>
            <th>{{ __('idioma.precio_final') }}</th>
            <th>{{ __('idioma.fecha_inicio') }}</th>
            <th>{{ __('idioma.fecha_fin') }}</th>
            <th>{{ __('idioma.acciones') }}</th>
            @foreach ($subastas as $subasta)
                <tr>
                    <td>{{ $subasta->id }}</td>
                    <td>{{ $subasta->producto->nombre }}</td>
                    <td>{{ $subasta->pInicial }}€</td>
                    <td>{{ $subasta->pFinal ? $subasta->pFinal . '€' : __('idioma.en_curso') }}</td>
                    <td>{{ $subasta->fechaInicio }}</td>
                    <td>{{ $subasta->fechaFin }}</td>
                    <td>
                        <a href="{{ route('subastas.edit', [$subasta->id]) }}">{{ __('idioma.editar') }}</a>
                        <form action="{{ route('subastas.delete', [$subasta->id]) }}" method="POST">
                            @csrf
                            <input type="submit" value="x">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    @include('layouts.footer')

    @vite(['resources/js/menu.js'])
</body>
