<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PanelController extends Controller
{
    public function index() {
        if(!Auth::check() || Auth::user()->type != 1)
        {
            //El usuario no está logado o no es Admin
            return redirect()->back();
        }

        return redirect()->route('panel.users');
    }

    public function users() {
        if(!Auth::check() || Auth::user()->type != 1)
        {
            //El usuario no está logado o no es Admin
            return redirect()->back();
        }

        $users = DB::table('users')
                    ->where('id', '!=', Auth::user()->id)
                    ->orderBy('id', 'desc')
                    ->get();

        return view('pages.panel.users', [
            'users' => $users
        ]);
    }

    public function create_users(Request $request) {
        if(!Auth::check() || Auth::user()->type != 1)
        {
            //El usuario no está logado o no es Admin
            return redirect()->back();
        }

        if($request->has(['name', 'email'])) {
            $check = DB::table('users')->orWhere('name', trim($request->user))->orWhere('email', trim($request->email))->count(); // Comprobamos si el alias o el email ya existe

            if($check) {
                return back()->withErrors([
                    'name' => 'El nombre de usuario y/o email ya está(n) en uso',
                ])->withInput();
            }
            // Insertamos al usuario
            // Si la contraseña viene vacía, 12345 se usa en su lugar.
            // (En realidad debería generarse aleatoriamente y notificar al usuario vía email, pero TFG)
            User::create([
                'name' => trim($request->name),
                'email' => trim($request->email),
                'type' => $request->type,
                'password' => Hash::make($request->password ?? "12345"),
            ]);
        }

        return redirect()->route('panel.users');
    }

    public function delete_users(Request $request) {
        if(!Auth::check() || Auth::user()->type != 1)
        {
            //El usuario no está logado o no es Admin
            return redirect()->back();
        }

        User::find($request->id)->delete();

        return redirect()->route('panel.users');
    }

    public function films() {
        if(!Auth::check() || Auth::user()->type != 1)
        {
            //El usuario no está logado o no es Admin
            return redirect()->back();
        }

        $films = DB::table('films')
                ->join('countries', 'countries.id', '=', 'films.country')
                ->orderBy('films.id', 'desc')
                ->select('films.*', 'countries.name AS country')
                ->get();

        $directors = DB::table('directors')->orderBy('id', 'desc')->get();
        $writers = DB::table('writers')->orderBy('id', 'desc')->get();
        $actors = DB::table('actors')->orderBy('id', 'desc')->get();
        $countries = DB::table('countries')->get();

        return view('pages.panel.films', [
            'films' => $films,
            'directors' => $directors,
            'writers' => $writers,
            'actors' => $actors,
            'countries' => $countries
        ]);
    }

    public function create_films(Request $request) {
        if(!Auth::check() || Auth::user()->type != 1)
        {
            //El usuario no está logado o no es Admin
            return redirect()->back();
        }

        $image = $request->file('image');

        $id = DB::table('films')->insertGetId([
            'name' => $request->name,
            'length' => $request->length,
            'country' => $request->country,
            'year' => $request->year,
            'image' => $image->getClientOriginalName() ?? null,
            'description' => $request->description,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        if($image) { // Si existe, guardamos el archivo en la carpeta /public/img/directors/
            $image->move(public_path('/img/films/'), $image->getClientOriginalName());
        }

        foreach($request->directors as $director) {
            DB::table('filmographies')->insert([
                'film' => $id,
                'director' => $director,
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP')
            ]);
        }

        foreach($request->writers as $writer) {
            DB::table('writing_teams')->insert([
                'film' => $id,
                'writer' => $writer,
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP')
            ]);
        }

        foreach($request->actors as $actor) {
            DB::table('casts')->insert([
                'film' => $id,
                'actor' => $actor,
                'character' => "",
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP')
            ]);
        }

        return redirect()->route('panel.films');
    }

    public function delete_films(Request $request) {
        if(!Auth::check() || Auth::user()->type != 1)
        {
            //El usuario no está logado o no es Admin
            return redirect()->back();
        }

        // Eliminamos antes los registros asociados a esa película en las distintas tablas
        // Se puede hacer también automágicamente con un onDelete('cascade') en las migraciones
        DB::table('casts')->where('film', $request->id)->delete();
        DB::table('filmographies')->where('film', $request->id)->delete();
        DB::table('writing_teams')->where('film', $request->id)->delete();
        DB::table('films_genres')->where('film', $request->id)->delete();

        DB::table('films')->where('id', $request->id)->delete();

        return redirect()->route('panel.films');
    }

    public function directors() {
        if(!Auth::check() || Auth::user()->type != 1)
        {
            //El usuario no está logado o no es Admin
            return redirect()->back();
        }

        $directors = DB::table('directors')
                ->join('countries', 'countries.id', '=', 'directors.country')
                ->orderBy('directors.id', 'desc')
                ->select('directors.*', 'countries.name AS country')
                ->get();

        $countries = DB::table('countries')->get();

        return view('pages.panel.directors', [
            'directors' => $directors,
            'countries' => $countries
        ]);
    }

    public function create_directors(Request $request) {
        if(!Auth::check() || Auth::user()->type != 1)
        {
            //El usuario no está logado o no es Admin
            return redirect()->back();
        }

        if($request->has(['name', 'country'])) {
            $image = $request->file('image');

            DB::table('directors')->insert([
                'name' => $request->name,
                'country' => $request->country,
                'birthdate' => $request->birthdate,
                'image' => $image->getClientOriginalName() ?? null,
                'description' => $request->description,
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP')
            ]);
            
            if($image) { // Si existe, guardamos el archivo en la carpeta /public/img/directors/
                $image->move(public_path('/img/directors/'), $image->getClientOriginalName());
            }
        }

        return redirect()->route('panel.directors');
    }

    public function delete_directors(Request $request) {
        if(!Auth::check() || Auth::user()->type != 1)
        {
            //El usuario no está logado o no es Admin
            return redirect()->back();
        }

        // Eliminamos antes los registros asociados a este director en las distintas tablas
        // Se puede hacer también automágicamente con un onDelete('cascade') en las migraciones
        DB::table('filmographies')->where('director', $request->id)->delete();

        DB::table('directors')->where('id', $request->id)->delete();

        return redirect()->route('panel.directors');
    }

    public function writers() {
        if(!Auth::check() || Auth::user()->type != 1)
        {
            //El usuario no está logado o no es Admin
            return redirect()->back();
        }

        $writers = DB::table('writers')
                ->join('countries', 'countries.id', '=', 'writers.country')
                ->orderBy('writers.id', 'desc')
                ->select('writers.*', 'countries.name AS country')
                ->get();

        $countries = DB::table('countries')->get();

        return view('pages.panel.writers', [
            'writers' => $writers,
            'countries' => $countries
        ]);
    }

    public function create_writers(Request $request) {
        if(!Auth::check() || Auth::user()->type != 1)
        {
            //El usuario no está logado o no es Admin
            return redirect()->back();
        }

        if($request->has(['name', 'country'])) {
            $image = $request->file('image');

            DB::table('writers')->insert([
                'name' => $request->name,
                'country' => $request->country,
                'birthdate' => $request->birthdate,
                'image' => $image->getClientOriginalName() ?? null,
                'description' => $request->description,
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP')
            ]);
            
            if($image) { // Si existe, guardamos el archivo en la carpeta /public/img/writers/
                $image->move(public_path('/img/writers/'), $image->getClientOriginalName());
            }
        }

        return redirect()->route('panel.writers');
    }

    public function delete_writers(Request $request) {
        if(!Auth::check() || Auth::user()->type != 1)
        {
            //El usuario no está logado o no es Admin
            return redirect()->back();
        }

        // Eliminamos antes los registros asociados a este director en las distintas tablas
        // Se puede hacer también automágicamente con un onDelete('cascade') en las migraciones
        DB::table('writing_teams')->where('writer', $request->id)->delete();

        DB::table('writers')->where('id', $request->id)->delete();

        return redirect()->route('panel.writers');
    }

    public function actors() {
        if(!Auth::check() || Auth::user()->type != 1)
        {
            //El usuario no está logado o no es Admin
            return redirect()->back();
        }

        $actors = DB::table('actors')
                ->join('countries', 'countries.id', '=', 'actors.country')
                ->orderBy('actors.id', 'desc')
                ->select('actors.*', 'countries.name AS country')
                ->get();

        $countries = DB::table('countries')->get();

        return view('pages.panel.actors', [
            'actors' => $actors,
            'countries' => $countries
        ]);
    }

    public function create_actors(Request $request) {
        if(!Auth::check() || Auth::user()->type != 1)
        {
            //El usuario no está logado o no es Admin
            return redirect()->back();
        }

        if($request->has(['name', 'country'])) {
            $image = $request->file('image');

            DB::table('actors')->insert([
                'name' => $request->name,
                'country' => $request->country,
                'birthdate' => $request->birthdate,
                'image' => $image->getClientOriginalName() ?? null,
                'description' => $request->description,
                'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' => DB::raw('CURRENT_TIMESTAMP')
            ]);
            
            if($image) { // Si existe, guardamos el archivo en la carpeta /public/img/actors/
                $image->move(public_path('/img/actors/'), $image->getClientOriginalName());
            }
        }

        return redirect()->route('panel.actors');
    }

    public function delete_actors(Request $request) {
        if(!Auth::check() || Auth::user()->type != 1)
        {
            //El usuario no está logado o no es Admin
            return redirect()->back();
        }

        // Eliminamos antes los registros asociados a este director en las distintas tablas
        // Se puede hacer también automágicamente con un onDelete('cascade') en las migraciones
        DB::table('casts')->where('actor', $request->id)->delete();

        DB::table('actors')->where('id', $request->id)->delete();

        return redirect()->route('panel.actors');
    }
}
