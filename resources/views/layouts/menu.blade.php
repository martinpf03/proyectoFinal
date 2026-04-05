<div id="menu-lateral" class="menu-lateral">
    <div class="perfil">
        <img src="../media/img/subasta.jpg" alt="{{ __('idioma.foto_perfil') }}" class="perfil-img">
    </div>
    <ul class="menu-list">
        <fieldset>
            <li><a href="/app/#/productos">{{ __('idioma.productos') }}</a></li>
            <li><a href="/app/#/subastas" hreflang="es">{{ __('idioma.subastas') }}</a></li>
        </fieldset>
        <fieldset>
            <li>
                <h1>{{ __('idioma.idioma') }}</h1>
            </li>
            <li><a href="{{ route('idioma', 'es') }}">{{ __('idioma.espanol') }}</a></li>
            <li><a href="{{ route('idioma', 'en') }}">@lang('idioma.ingles')</a></li>
        </fieldset>
    </ul>
</div>
