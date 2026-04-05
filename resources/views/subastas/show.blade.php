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
    @vite(['resources/css/subasta.css'])
    @vite(['resources/css/header.css'])
    @vite(['resources/css/footer.css'])
    @vite(['resources/css/menu-lateral.css'])

</head>

<body>
    @include('layouts.header')
    @include('layouts.menu')

    <div id="content">
        <div id="divImg">
            <img src="../{{ $subasta->producto->url_imagen }}" alt="" id="imgProd">
        </div>
        <h1 id="nomeProd">{{ $subasta->producto->nombre }}</h1>
        <div id="divDesc">
            <p>{{ $subasta->producto->descripcion }}</p>
            @if ($subasta->producto->tipo == 'pieza')
                <p>{{ __('idioma.dimensiones') }}: {{ $subtipo->dimensiones }}</p>
                <p>{{ __('idioma.peso') }}: {{ $subtipo->peso }}</p>
            @endif
            @if ($subasta->producto->tipo == 'consola')
                <p>{{ __('idioma.portatil') }}:
                    @if ($subtipo->portatil)
                        {{ __('idioma.si') }}
                    @else
                        {{ __('idioma.no') }}
                    @endif
                </p>
            @endif
            @if ($subasta->producto->tipo == 'arcade')
                <p>{{ __('idioma.anho_salida') }}: {{ $subtipo->anho_salida }}</p>
            @endif
            @if ($subasta->producto->tipo == 'arcade' || $subasta->producto->tipo == 'consola')
                <p>{{ __('idioma.marca') }}: {{ $subtipo->marca }}</p>
            @endif
            <p>{{ __('idioma.puja_minima_inicial') }}: {{$subasta->pInicial}}€</p>
            <h4>{{ __('idioma.fecha_fin') }}: {{$subasta->fechaFin}}</h4>
        </div>
        <table id="tabPuja" border="1">
            <tr>
                <th>{{ __('idioma.lider') }}</th>
                <th>{{ __('idioma.hora') }}</th>
                <th>{{ __('idioma.pago') }}</th>
            </tr>
            <tr>
                @if ($puja)
                    <td>{{ $puja->user->name }}</td>
                    <td>{{ $puja->hora }}</td>
                    <td>{{ $puja->cantidad }}</td>
                @endif
            </tr>
        </table>
        <form id="divPagar" action="{{route('puja.post')}}" method="POST">
            @csrf
            <button type="submit" id="btnPagar">{{ __('idioma.pujar') }}</button>
            <input type="hidden" value="{{$subasta->id}}" name="subasta_id">
            <input type="number" name="cantidad">
        </form>
    </div>

    @include('layouts.footer')
    @vite(['resources/js/menu.js'])

</body>
