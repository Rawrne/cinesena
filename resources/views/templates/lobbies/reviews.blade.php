<div class="grid cols-2 cols-mobile-1">
    @foreach ($reviews as $review)
        <section class="item panel d-flex flex-column gap-2 p-4 text-center">
            @if(Route::is('profile'))
                    <h2><a class="link-light" style="text-decoration: none" href="{{ route("films.dedicated", [ 'id' => $review->film_id]) }}">{{ $review->film }}</a></h2>
            @endif         
            <div class="d-flex justify-content-between align-items-end">
                <img style="border-radius: 50%;" width="56" src="{{ asset('/img/not_found.jpeg') }}" alt="">
                <p class="fs-4 mb-0">Escrito por <b>{{ $review->user == optional(Auth::user())->name && $review->user != null ? 'mí' : $review->user ?? 'Sistema'}}</b></p>
                <p class="mb-0">
                    @php($full = floor($review->score))
                    @php($half = abs($review->score-$full))
                    @php($stars = 0)

                    @foreach (range(0, $full) as $item)
                        @if($item > 0)
                            <i class="las la-star text-warning"></i>
                            @php($stars++)
                        @endif
                    @endforeach

                    @if ($half > 0)
                        <i class="lar la-star-half text-warning"></i>
                        @php($stars++)
                    @endif

                    @if ($stars == 0)
                        <i class="lar la-star text-warning"></i>
                    @endif

                    <span>
                        ({{ $review->score }})
                    </span>
                </p>
            </div>
            <hr>
            <article>
                {!! $review->content !!}
            </article>
            <p class="text-end fs-4 mb-0" style="transform: translateY(-1em); height: 1px;">...</p>
            <div class="d-flex justify-content-start align-items-center gap-3">
                @if(Route::is('profile'))
                    <a title="{{ $review->comments->count() }} comentario(s)" href="{{ route('films.dedicated.review', ['id' => $review->film_id, 'review' => $review->id]) }}" class="btn btn-success align-middle rounded-pill"><i class="las la-comment-dots fs-4 align-middle"></i> {{ $review->comments->count() }}</a>
                @else
                    <a title="{{ $review->comments->count() }} comentario(s)" href="{{ route('films.dedicated.review', ['id' => $film->id, 'review' => $review->id]) }}" class="btn btn-success align-middle rounded-pill"><i class="las la-comment-dots fs-4 align-middle"></i> {{ $review->comments->count() }}</a> 
                @endif
                    <button title="{{ $review->rating }} usuario(s) han valorado esta reseña positivamente" class="btn btn-primary align-middle rounded-pill"><i class="las la-thumbs-up fs-4 align-middle"></i> {{ $review->rating }}</button> 
            </div>
        </section>
    @endforeach
</div>