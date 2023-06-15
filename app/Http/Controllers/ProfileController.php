<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class ProfileController extends Controller
{
    public function index(Request $request)
    {
        if(!Auth::check())
        {
            //El usuario no está logado
            return redirect()->back();
        }

        $user = DB::table('users');
             
        $reviews = DB::table('reviews')
                    ->join('users', 'users.id', '=', 'reviews.user')
                    ->join('films', 'films.id', '=', 'reviews.film')
                    ->select('reviews.*', 'users.name as user', 'films.name as film', 'films.id as film_id')
                    ->where("reviews.user", Auth::user()->id)
                    ->get();

        foreach ($reviews as $review) {
            $review->comments = DB::table('comments')
                                    ->where('review', $review->id)
                                    ->get();
            
            $review->films = DB::table('films')
                                    ->where('id', $review->film)
                                    ->get();                         
        }

          
        return view('pages.dedicated.profile', [
            'user' => $user,
            'reviews' => $reviews,
        ]);
              
    }

    public function update(Request $request)
    {
        if(!Auth::check())
        {
            //El usuario no está logado
            return redirect()->back();
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->bio = $request->bio;
        $user->save();

        return redirect()->back();
    }
}
