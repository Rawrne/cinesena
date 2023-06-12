<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $films = DB::table('films')
                    ->join('filmographies', 'filmographies.film', '=', 'films.id')
                    ->join('directors', 'directors.id', '=', 'filmographies.director')
                    ->select('films.id', 'films.name', 'films.image', 'directors.name as director')
                    ->orderBy('films.id', 'desc')
                    ->take(5)
                    ->get();
        
        return view('pages.home', [
            'films' => $films,
        ]);
    }

    public function allFilms()
    {
        $films = DB::table('films')->get();

        return view('pages.all.films', [
            'films' => $films,
        ]);
    }

    public function films()
    {
        $lobby1 = DB::table('films')->where('year', '<', 2000)->where('year', '>', 1899)->take(7)->get(); //Películas del siglo XX
        $lobby2 = DB::table('films')->where('year', '<', 3000)->where('year', '>', 1999)->take(7)->get(); //Películas del siglo XXI
        $lobby3 = DB::table('films')->where('length', '>=', 120)->take(7)->get(); //Películas de más de 2 horas

        return view('pages.films', [
            'lobby1' => $lobby1,
            'lobby2' => $lobby2,
            'lobby3' => $lobby3,
        ]);
    }

    public function film($id)
    {
        $film = DB::table('films')
                    ->where('films.id', $id)
                    ->join('countries', 'countries.id', '=', 'films.country')
                    ->select('films.*', 'countries.name as country')
                    ->first();
        
        $film->genre = DB::table('films_genres')
                            ->where('films_genres.film', $film->id)
                            ->join('genres', 'genres.id', '=', 'films_genres.genre')
                            ->select('genres.name')
                            ->get();
        
        $film->directors = DB::table('filmographies')
                                ->where('filmographies.film', $film->id)
                                ->join('directors', 'directors.id', '=', 'filmographies.director')
                                ->select('directors.id', 'directors.name', 'directors.image')
                                ->get();

        $film->writers = DB::table('writing_teams')
                                ->where('writing_teams.film', $film->id)
                                ->join('writers', 'writers.id', '=', 'writing_teams.writer')
                                ->select('writers.id', 'writers.name', 'writers.image')
                                ->get();

        $film->actors = DB::table('casts')
                                ->where('casts.film', $film->id)
                                ->join('actors', 'actors.id', '=', 'casts.actor')
                                ->select('actors.id', 'actors.name', 'actors.image', 'casts.character')
                                ->get();
        
        $film->reviews = DB::table('reviews')
                                ->where('reviews.film', $film->id)
                                ->leftJoin('users', 'users.id', '=', 'reviews.user')
                                ->select('reviews.*', 'users.name as user')
                                ->get();
        
        foreach ($film->reviews as $review) {
            $review->comments = DB::table('comments')
                                    ->where('review', $review->id)
                                    ->get();
        }
        
        return view('pages.dedicated.films', [
            'film' => $film,
        ]);
    }

    public function directors()
    {
        $directors = DB::table('directors')->get();
                        
        return view('pages.directors', [
            'directors' => $directors,
        ]);
    }

    public function writers()
    {
        $writers = DB::table('writers')->get();
                               
        return view('pages.writers', [
            'writers' => $writers,
        ]);
    }

    public function actors()
    {
        $actors = DB::table('actors')->get();

        return view('pages.actors', [
            'actors' => $actors,
        ]);
    }

    public function reviews()
    {
        return view('pages.reviews');
    }

    
}
