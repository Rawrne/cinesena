<div class="d-flex justify-content-between mt-5 mb-1">
    <h2>{{ $title }}</h2>
    <a href="{{ route("films.all") }}" class="link-secondary text-decoration-none align-middle fs-3">Ver todas <i class="las la-arrow-right align-middle"></i></a>
</div>
<div class="grid @if($films->count() < 6 ) small @endif mb-5">
    @foreach ($films as $film)
        @php($img = $film->image ?? "../not_found.jpeg")
        @if ($loop->first)
            <a href="{{ route("films.dedicated", [ 'id' => $film->id]) }}" class="item first">
                <img src="{{ asset("/img/films/{$img}")}}" alt="{{$film->name}}">
            </a>
        @else
            <a href="{{ route("films.dedicated", [ 'id' => $film->id]) }}" class="item">
                <img src="{{ asset("/img/films/{$img}")}}" alt="{{$film->name}}">
            </a> 
        @endif
    @endforeach
</div>