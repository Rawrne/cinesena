<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\PanelController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/peliculas', [HomeController::class, 'films'])->name('films');

Route::get('/peliculas/todas', [HomeController::class, 'allFilms'])->name('films.all');

Route::get('/peliculas/{id}', [HomeController::class, 'film'])->name('films.dedicated');

Route::get('/peliculas/{id}/review/{review}', [SocialController::class, 'index'])->name('films.dedicated.review');

Route::post('/peliculas/{id}', [SocialController::class, 'insertReview'])->name('films.dedicated.reviews.post');

Route::post('/peliculas/{id}/review/{review}', [SocialController::class, 'insertComment'])->name('films.dedicated.review.comment');

Route::get('/directores', [HomeController::class, 'directors'])->name('directors');

Route::get('/guionistas', [HomeController::class, 'writers'])->name('writers');

Route::get('/actores', [HomeController::class, 'actors'])->name('actors');

Route::get('/reseñas', [HomeController::class, 'reviews'])->name('reviews');


Route::get('/inicio', [LoginController::class, 'index'])->name('login');

Route::post('/inicio', [LoginController::class, 'login'])->name('login.post');

Route::get('/salir', [LoginController::class, 'logout'])->name('logout');


Route::get('/registro', [RegisterController::class, 'index'])->name('register');

Route::post('/registro', [RegisterController::class, 'register'])->name('register.post');


Route::get('/perfil', [ProfileController::class, 'index'])->name('profile');

Route::put('/perfil', [ProfileController::class, 'update'])->name('profile.put');

//Panel
Route::get('/panel', [PanelController::class, 'index'])->name('panel');

Route::get('/panel/users', [PanelController::class, 'users'])->name('panel.users');
Route::post('/panel/users', [PanelController::class, 'create_users'])->name('panel.users.post');
Route::delete('/panel/users', [PanelController::class, 'delete_users'])->name('panel.users.delete');

Route::get('/panel/films', [PanelController::class, 'films'])->name('panel.films');
Route::post('/panel/films', [PanelController::class, 'create_films'])->name('panel.films.post');
Route::delete('/panel/films', [PanelController::class, 'delete_films'])->name('panel.films.delete');

Route::get('/panel/directors', [PanelController::class, 'directors'])->name('panel.directors');
Route::post('/panel/directors', [PanelController::class, 'create_directors'])->name('panel.directors.post');
Route::delete('/panel/directors', [PanelController::class, 'delete_directors'])->name('panel.directors.delete');

Route::get('/panel/writers', [PanelController::class, 'writers'])->name('panel.writers');
Route::post('/panel/writers', [PanelController::class, 'create_writers'])->name('panel.writers.post');
Route::delete('/panel/writers', [PanelController::class, 'delete_writers'])->name('panel.writers.delete');

Route::get('/panel/actors', [PanelController::class, 'actors'])->name('panel.actors');
Route::post('/panel/actors', [PanelController::class, 'create_actors'])->name('panel.actors.post');
Route::delete('/panel/actors', [PanelController::class, 'delete_actors'])->name('panel.actors.delete');



