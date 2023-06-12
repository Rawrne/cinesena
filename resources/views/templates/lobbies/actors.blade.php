<div class="grid">
    @foreach ($actors as $actor)
        @php($img = $actor->image ?? "../not_found.jpeg")
        <a class="item d-flex flex-column align-items-center link-secondary gap-2 text-decoration-none" title="{{ $actor->name }}" href="">
            <img src="{{ asset("/img/actors/{$img}")}}" alt="{{$actor->name}}">
            <p>{{ $actor->name }}: <b>{{ $actor->character }}</b></p>
        </a>
    @endforeach
</div>