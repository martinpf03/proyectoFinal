<header>
    <a href="{{route('inicio')}}" hreflang="es"><img src="../media/img/logo.png" height="50px" width="50px" alt=""></a>
    <h1>Pixel Palace</h1>
    <div id="menu">
        <div class="profile-icon">
            <a href="@if(auth()->check()){{route('perfil')}}@else{{route('login')}} @endif" hreflang="es"><i class="fas fa-user"></i></a> <!-- Ícono de perfil -->
        </div>
        <div class="menu-icon" id="menu-icon">
            <i class="fas fa-bars"></i> <!-- Icono de hamburguesa -->
        </div>
    </div>
</header>