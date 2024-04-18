<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\LocalityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\RepresentationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRepresentationController;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/artist', [ArtistController::class, 'index'])
        ->name('artist.index');
Route::get('/artist/{id}', [ArtistController::class, 'show'])
		->where('id', '[0-9]+')->name('artist.show');
Route::get('/artist/edit/{id}', [ArtistController::class, 'edit'])
		->where('id', '[0-9]+')->name('artist.edit');
Route::put('/artist/{id}', [ArtistController::class, 'update'])
		->where('id', '[0-9]+')->name('artist.update');
Route::get('/artist/create', [ArtistController::class, 'create'])
        ->name('artist.create');
Route::post('/artist', [ArtistController::class, 'store'])
        ->name('artist.store');
Route::delete('/artist/{id}', [ArtistController::class, 'destroy'])
	    ->where('id', '[0-9]+')->name('artist.delete');
Route::get('/type', [TypeController::class, 'index'])->name('type.index');
Route::get('/type/{id}', [TypeController::class, 'show'])
		->where('id', '[0-9]+')->name('type.show');

Route::get('/locality', [LocalityController::class, 'index']) ->name('locality.index');
Route::get('/locality/{id}', [LocalityController::class, 'show'])
		->where('id', '[0-9]+')->name('locality.show');

Route::get('/role', [RoleController::class, 'index'])->name('role.index');
Route::get('/role/{id}', [RoleController::class, 'show'])
		->where('id', '[0-9]+')->name('role.show');

Route::get('location', [LocationController::class, 'index'])->name('location.index');
Route::get('location/{id}', [LocationController::class, 'show'])
        ->where('id', '[0-9]+')->name('location.show');
              
Route::get('/show', [ShowController::class, 'index'])->name('show.index');
Route::get('/show/{id}', [ShowController::class, 'show'])
        ->where('id', '[0-9]+')->name('show.show');
        

Route::get('/representation', [RepresentationController::class, 'index'])
        ->name('representation.index');
Route::get('/representation/{id}', [RepresentationController::class, 'show'])
        ->where('id', '[0-9]+')->name('representation.show');

        
// Ajouter cette ligne pour créer une route pour le panier
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
        
Auth::routes();

Route::get('/accueil', [App\Http\Controllers\HomeController::class, 'index'])->name('accueil');
Route::get('/cart/summary', [CartController::class, 'summary'])->name('cart.summary');
Route::match(['get' , 'post'],'/reservation/confirm', 'App\Http\Controllers\CartController@confirm')->name('final.confirmation');
Route::get('/reservation/thankyou', function () {
        return view('reservation.thankyou');
    })->name('reservation.thankyou');
    
Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/panier', [CartController::class, 'summary'])->name('panier.index');

Route::get('/profile', [UserController::class, 'profile'])->name('user.profile')->middleware('auth');
Route::get('/mes-representations', [UserRepresentationController::class, 'index'])->name('user_representations.index')->middleware('auth');



