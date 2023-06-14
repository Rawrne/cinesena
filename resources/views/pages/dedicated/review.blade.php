@extends('layouts.main')

@section('title', 'Review')
@section('main')
    <div class="container py-3">  
        <div class="container pb-3 pt-5">   
            <div class="row mb-5">
                <div class="col-3">
                    @php($img = $film->image ?? "../not_found.jpeg")
                    <img class="w-100" src="{{ asset("/img/films/{$img}")}}" alt="">
                </div>
                <div class="col">
                    <h1>{{ $film->name }}</h1>
                    <h2 class="fs-4 fw-light">{{ $film->description }}</h2>
                    <div class="table-responsive mt-4">
                        <table class="table table-dark table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th class="px-4" style="width: 1px; white-space: nowrap;">País de origen</th>
                                    <td class="px-4">{{ $film->country }}</td>
                                </tr>
                                <tr>
                                    <th class="px-4" style="width: 1px; white-space: nowrap;">Año</th>
                                    <td class="px-4">{{ $film->year }}</td>
                                </tr>
                                <tr>
                                    <th class="px-4" style="width: 1px; white-space: nowrap;">Duración</th>
                                    <td class="px-4">{{ $film->length }}'</td>
                                </tr>
                                <tr>
                                    <th class="px-4" style="width: 1px; white-space: nowrap;">Género</th>
                                    <td class="px-4">{{ $film->genre->implode('name',', ') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <div class="grid cols-1 cols-mobile-1">
            <section class="item panel d-flex flex-column gap-2 p-4 text-left max-height-100% ">   
                <div class="d-flex justify-content-between align-items-end" style="max-height: 100% !important;">
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
                <article style="max-height: none !important;">
                    {!! $review->content !!}
                </article>
                
                <div class="d-flex justify-content-start align-items-center gap-3">
                         <a title="{{ $review->comments->count() }} comentario(s)" href="{{ route('films.dedicated.review', ['id' => $film->id, 'review' => $review->id]) }}" class="btn btn-success align-middle rounded-pill"><i class="las la-comment-dots fs-4 align-middle"></i> {{ $review->comments->count() }}</a> 
                        <button title="{{ $review->rating }} usuario(s) han valorado esta reseña positivamente" class="btn btn-primary align-middle rounded-pill"><i class="las la-thumbs-up fs-4 align-middle"></i> {{ $review->rating }}</button> 
                </div>
                <div>
                    <hr>
                    <h3 class="mt-3">Comentarios ({{ $review->comments->count() }})</h3>
                    <hr>                   
                    @foreach ($review->comments as $comment)
                        <div>
                            <div class="mb-3">
                                <img style="border-radius: 50%; " width="56" src="{{ asset('/img/not_found.jpeg') }}" alt="">

                                @if ($comment->user)
                                    Escrito por {{ $comment->user }}
                                @else
                                    Escrito por el sistema
                                @endif
                            </div>
                            <div class="mb-3">
                                <article style="max-height: none !important;">
                                    {!! $comment->content !!}                               
                                </article>
                            </div>           
                            <div class="mb-3">
                                <button title="{{ $review->rating }} usuario(s) han valorado este comentario positivamente" class="btn btn-primary align-middle rounded-pill"><i class="las la-thumbs-up fs-4 align-middle"></i> {{ $comment->rating }}</button>
                            </div>           
                            <hr>    
                        </div>
                    @endforeach
                    @auth
                        <form method="POST">
                            @csrf
                            <input type="hidden" name="review_id" value="{{ $review->id }}">
                            <div class="mb-3">
                                <textarea name="comment" placeholder="Escribe un comentario..." rows="4" cols="50"></textarea>
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit"><i class="las la-2x la-pen-alt align-middle"></i> Enviar comentario</button>
                            </div>
                        </form>    
                    @endauth                              
                </div>
            </section> 
        </div>
    </div>
@endsection