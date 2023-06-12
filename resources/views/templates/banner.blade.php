@isset($films)
<div id="carouselExampleCaptions" class="carousel banner carousel-dark slide shadow-sm border-bottom border-primary" data-bs-ride="false">
    <div class="carousel-indicators">
        @foreach ($films as $film)
            @if ($loop->first)
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$loop->index}}" class="active" aria-current="true" aria-label="Película {{$film->id}}"></button>
            @else
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$loop->index}}" aria-label="Película {{$film->id}}"></button>
            @endif 
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach ($films as $film)
            @if ($loop->first)
                <div class="carousel-item active position-relative">
                    @if (is_null($film->image))
                        <img src="{{asset('/img/not_found.jpeg')}}" class="d-block w-100 cover object-fit-contain" alt="{{$film->name}}" height="360" style="background-color: #f2f2f2">
                    @else
                        <img src="{{asset("/img/films/{$film->image}")}}" class="d-block w-100 cover object-fit-cover" alt="{{$film->name}}" height="360" id="banner_{{$film->id}}">
                    @endif
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{$film->name}}</h5>
                        <p>Dirigida por {{$film->director}}</p>
                    </div>
                </div> 
            @else
                <div class="carousel-item position-relative">
                    @if (is_null($film->image))
                        <img src="{{asset('/img/not_found.jpeg')}}" class="d-block w-100 cover object-fit-contain" alt="{{$film->name}}" height="360" style="background-color: #f2f2f2">
                    @else
                        <img src="{{asset("/img/films/{$film->image}")}}" class="d-block w-100 cover object-fit-cover" alt="{{$film->name}}" height="360" id="banner_{{$film->id}}">
                    @endif
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{$film->name}}</h5>
                        <p>Dirigida por {{$film->director}}</p>
                    </div>
                </div>  
            @endif
  
        @endforeach

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
    </button>
</div>    
@endisset



