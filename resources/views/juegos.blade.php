<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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
    <h1>JUEGOS</h1>
    <div id="carrito">
        @if ($juegos!=null)
        @foreach ($juegos as $juego)
            <div class="prod">

                <img src="{{$juego["imagen"]}}" alt="Imagen del producto">
               
                    <div class="datosProd">
                        <h1>{{ $juego["titulo"] }}</h1>
                        <p>Genero:{{ $juego["genero"] }}</p>
                        <p>Fecha de lanzamiento: {{$juego["fecha_salida"]}}</p>
                       
                    </div>
            </div>
        </a>  
        @endforeach
        @endif
    </div>

@include('layouts.footer')

</body>
        