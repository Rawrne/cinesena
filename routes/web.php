<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialController;


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




