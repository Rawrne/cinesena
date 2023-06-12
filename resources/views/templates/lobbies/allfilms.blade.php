<div class="d-flex justify-content-between mt-5 mb-1">
    <h2>{{ $title }}</h2>
</div>
<div class="grid mb-5">
    @foreach ($films as $film)
        @php($img = $film->image ?? "../not_found.jpeg")
            <a href="{{ route("films.dedicated", [ 'id' => $film->id]) }}" class="item">
                <img src="{{ asset("/img/films/{$img}")}}" alt="{{$film->name}}">
            </a>
    @endforeach
</div>