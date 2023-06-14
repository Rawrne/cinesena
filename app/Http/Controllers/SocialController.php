<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SocialController extends Controller
{
    public function insertReview(Request $request)
    {
        if(!Auth::check())
        {   
            //El usuario no está logado
            return redirect()->back();
        }
                
        DB::table('reviews')->insert([
            'user' => Auth::user()->id,
            'film' => $request->id,
            'content' => $request->review,
            'score' => $request->rating,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        return redirect()->route('films.dedicated', [
            'id' => $request->id,
        ])->with('#reviews');
    }

    public function insertComment(Request $request)
    {
        if(!Auth::check())
        {   
            //El usuario no está logado
            return redirect()->back();
        }
                
        DB::table('comments')->insert([
            'user' => Auth::user()->id,
            'review' => $request->review_id,
            'content' => $request->comment,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        return redirect()->route('films.dedicated.review.comment', [
            'id' => $request->id,
            'review' => $request->review_id,
        ]);
    }

    public function index(Request $request)
    {
        $film = DB::table('films')
                        ->where('films.id', $request->id)
                        ->join('countries', 'countries.id', '=', 'films.country')
                        ->select('films.*', 'countries.name as country')
                        ->first();

        $film->genre = DB::table('films_genres')
                        ->where('films_genres.film', $film->id)
                        ->join('genres', 'genres.id', '=', 'films_genres.genre')
                        ->select('genres.name')
                        ->get();

        $review = DB::table('reviews')
                        ->where('reviews.film', $film->id)
                        ->where('reviews.id', $request->review)
                        ->leftJoin('users', 'users.id', '=', 'reviews.user')
                        ->select('reviews.*', 'users.name as user')
                        ->first();

        $review->comments = DB::table('comments')
                                ->where('review', $review->id)
                                ->leftJoin('users', 'users.id', '=', 'comments.user')
                                ->select('comments.*', 'users.name as user')
                                ->get();

        foreach ($review->comments as $comment) {
                    $review->comment = DB::table('comments')
                                            ->where('content')
                                            ->get();                         
                }
                
        return view('pages.dedicated.review', [
            'film' => $film,
            'review' => $review
        ]);
    }
}
