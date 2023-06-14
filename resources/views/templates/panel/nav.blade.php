<div class="list-group mt-1">
    <a href="@if(Route::is('panel.users')) # @else {{route('panel.users')}} @endif" class="list-group-item list-group-item-action @if(Route::is('panel.users')) active @endif" @if(Route::is('panel.users')) aria-current="true" @endif>
        Usuarios
    </a>
    <a href="@if(Route::is('panel.films')) # @else {{route('panel.films')}} @endif" class="list-group-item list-group-item-action @if(Route::is('panel.films')) active @endif" @if(Route::is('panel.films')) aria-current="true" @endif>
        Películas
    </a>
    <a href="@if(Route::is('panel.directors')) # @else {{route('panel.directors')}} @endif" class="list-group-item list-group-item-action @if(Route::is('panel.directors')) active @endif" @if(Route::is('panel.directors')) aria-current="true" @endif>
        Directores
    </a>
    <a href="@if(Route::is('panel.writers')) # @else {{route('panel.writers')}} @endif" class="list-group-item list-group-item-action @if(Route::is('panel.writers')) active @endif" @if(Route::is('panel.writers')) aria-current="true" @endif>
        Escritores
    </a>
    <a href="@if(Route::is('panel.actors')) # @else {{route('panel.actors')}} @endif" class="list-group-item list-group-item-action @if(Route::is('panel.actors')) active @endif" @if(Route::is('panel.actors')) aria-current="true" @endif>
        Actores
    </a>
</div>