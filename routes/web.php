<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\MovePhotoController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('albums', AlbumController::class);


Route::post('albums/{id}/photos', [PhotoController::class, 'index'])->name('albums.photos.index');

Route::post('albums/{id}/photos/store', [PhotoController::class, 'store'])->name('albums.photos.store');

Route::post('albums/{id}/photos/delete', [PhotoController::class, 'destroy'])->name('albums.photos.delete');


Route::get('albums/{id}/move/photos', [MovePhotoController::class, 'move'])->name('move_photos');

Route::post('albums/{id}/move/photos', [MovePhotoController::class, 'delete_and_move'])->name('delete_and_move');

    
}); 

require __DIR__.'/auth.php';
