<?php

use App\Models\Order;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\paypalController;
use App\Http\Controllers\ContactController;
use App\Models\Product;

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

/*--home page--*/
Route::get('/', function () {
    return view('front-end.index');
})->name('homepage');
/*----------------------*/

/*---contact---*/
Route::post('/contact', [ContactController::class,'send'])->name('contact.send');
Route::view('/contact-us', 'front-end.contact')->name('contact');
/*------------*/

/*---------product controller-----------*/

Route::get('/singlepage/{name}', [ProductController::class,'showproduct'])->name('singlepage');
Route::resource('products', ProductController::class);
Route::post('/cart/add/{productId}', [ProductController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{productId}', [ProductController::class, 'updateQuantity'])->name('cart.update');
Route::delete('/cart/remove/{productId}', [ProductController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart', [ProductController::class, 'showCart'])->name('cart.show');
/*------------------*/

/*----paymentbypaypal/strpe-------------*/
Route::controller(PaymentController::class)
    ->prefix('paypal')
    ->group(function () {
        Route::post('handle-payment', 'handlePayment')->name('make.payment');
        Route::get('cancel-payment', 'paymentCancel')->name('cancel.payment');
        Route::get('payment-success', 'paymentSuccess')->name('success.payment');
    });
    Route::post('/charge', [PaymentController::class,'charge'])->name('paymentstripe');
/*------------------------------------*/



/*---------------admins----------------*/
Route::get('/admins', [userController::class, 'index'])->name('admin');
Route::delete('/users/{user}', [userController::class, 'destroy'])->name('users.destroy');
Route::get('/users/create', [userController::class, 'create'])->name('users.create');
Route::post('/users', [userController::class, 'store'])->name('users.store');
/*----------------------------*/

/*-----------------dashboard--------------------*/

Route::get('/products', function () {
    $products = Product::all();
    return view('dashboard.products', compact('products'));
})->name('products.index');
Route::get('/orders', function () {
    $orders = Order::all();
    return view('dashboard.orders', compact('orders'));
})->name('orders');
/*------------------------------*/
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
