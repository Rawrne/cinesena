<div class="grid">
    @foreach ($directors as $director)
        @php($img = $director->image ?? "../not_found.jpeg")
        <a class="item d-flex flex-column align-items-center link-secondary gap-2 text-decoration-none" title="{{ $director->name }}" href="">
            <img src="{{ asset("/img/directors/{$img}")}}" alt="{{$director->name}}">
            <p>{{ $director->name }}</p>
        </a>
    @endforeach
</div>