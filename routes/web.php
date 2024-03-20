<?php

use App\Http\Controllers\GuestroomsController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UsertypeController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\RoombookingController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('rental-room.rental-room');
// });

Route::get('/', [GuestroomsController::class, 'viewrentalroom']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');   
    })->name('dashboard');

    Route::get('/checkusers/{id?}', [RoomController::class, 'view_details']);
}); 

Route::resource('/houseowner', UsertypeController::class);
    
Route::resource('/guestroom', GuestroomsController::class);

Route::get('/rentalroom', [GuestroomsController::class, 'viewrentalroom']);

Route::get('/checkuser', [RoomController::class, 'checkusers']);

Route::get('/alltypefilter', [FilterController::class, 'alltypefilters']);

Route::get('/bookroom/{id?}', [RoombookingController::class,'bookrooms']);