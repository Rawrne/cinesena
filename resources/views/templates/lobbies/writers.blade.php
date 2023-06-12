<div class="grid">
    @foreach ($writers as $writer)
        @php($img = $writer->image ?? "../not_found.jpeg")
        <a class="item d-flex flex-column align-items-center link-secondary gap-2 text-decoration-none" title="{{ $writer->name }}" href="">
            <img src="{{ asset("/img/writers/{$img}")}}" alt="{{$writer->name}}">
            <p>{{ $writer->name }}</p>
        </a>
    @endforeach
</div>