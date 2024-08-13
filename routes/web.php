<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\Purchase\CancelPurchaseController;
use App\Http\Controllers\Cart\DeleteCartController;
use App\Http\Controllers\User\DeactivateAccountController;
use App\Http\Controllers\PurchaseDetailController;
use App\Http\Controllers\PurchaseItemController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    Route::get('/ecapp', \App\Http\Controllers\Ecapp\IndexController::class)
    ->name('ecapp.index');

    Route::get('/cart', \App\Http\Controllers\Cart\IndexController::class)
    ->name('cart.index');
    Route::post('/cart/add', \App\Http\Controllers\Cart\CreateCartController::class)
    ->name('cart.add');
    Route::post('/cart/delete', [DeleteCartController::class, 'delete'])
    ->name('cart.delete');

        
    Route::resource('/purchase_details', PurchaseDetailController::class)
    ->only(['index', 'store']);
    Route::resource('/purchase_items', PurchaseItemController::class)
    ->only(['index', 'store', 'update', 'destroy']);

    // 退会確認画面のルート
    Route::get('/user/confirm-deactivation', [DeactivateAccountController::class, 'confirm'])
    ->name('user.confirm.deactivation');

    // 退会処理のルート
    Route::post('/user/deactivate', [DeactivateAccountController::class, 'deactivate'])
    ->name('user.deactivate');

});



require __DIR__.'/auth.php';
