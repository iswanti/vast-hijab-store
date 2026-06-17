<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NotificationController;



/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/

Route::get('/', [WelcomeController::class, 'index']);


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| SUPERADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'superadmin'])->group(function () {

    // DASHBOARD
    Route::get(
    '/superadmin',
    [AdminController::class,'dashboardSuperadmin']
    )->name('superadmin.dashboard');

    Route::get(
    '/superadmin/laporan-penjualan',
    [AdminController::class, 'laporanPenjualanOwner']
)   ->name('superadmin.laporan');

    /*
    |--------------------------------------------------------------------------
    | DATA ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/data-admin',
        [AdminController::class, 'index'])
        ->name('data.admin');

    Route::get('/data-admin/create',
        [AdminController::class, 'create'])
        ->name('data.admin.create');

    Route::post('/data-admin/store',
        [AdminController::class, 'store'])
        ->name('data.admin.store');

    Route::get('/data-admin/{id}/edit',
        [AdminController::class, 'edit'])
        ->name('data.admin.edit');

    Route::put('/data-admin/{id}/update',
        [AdminController::class, 'update'])
        ->name('data.admin.update');

    Route::delete('/data-admin/{id}/delete',
        [AdminController::class, 'destroy'])
        ->name('data.admin.delete');

});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    // DASHBOARD
    Route::get(
        '/admin',
        [AdminController::class,'dashboard']
    )->name('admin.dashboard');

     Route::get(
        '/admin/laporan-penjualan',
        [AdminController::class, 'laporanPenjualanAdmin']
    )->name('admin.laporan');

    

});


/*
|--------------------------------------------------------------------------
| OWNER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'owner'])->group(function () {

    Route::get(
        '/owner',
        [AdminController::class,'ownerDashboard']
    )->name('owner.dashboard');

    Route::get(
        '/owner/laporan-penjualan',
        [AdminController::class,'laporanPenjualanOwner']
    )->name('owner.laporan');

    Route::get(
        '/owner/laporan-penjualan/pdf',
        [AdminController::class,'exportPdfOwner']
    )->name('owner.laporan.pdf');

});


/*
|--------------------------------------------------------------------------
| DATA USER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'multirole:superadmin,admin'])->group(function () {

    Route::get('/data-user',
        [UserController::class, 'index'])
        ->name('data.user');

    Route::delete('/data-user/{id}/delete',
        [UserController::class, 'destroy'])
        ->name('data.user.delete');

});


/*
|--------------------------------------------------------------------------
| PRODUCT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'multirole:superadmin,admin,owner'])->group(function () {

    // LIST PRODUCT
    Route::get('/product',
        [ProductController::class, 'index'])
        ->name('product.index');


    // CREATE
    Route::get('/product/create',
        [ProductController::class, 'create'])
        ->name('product.create');

    Route::post('/product/store',
        [ProductController::class, 'store'])
        ->name('product.store');


    // EDIT
    Route::get('/product/{id}/edit',
        [ProductController::class, 'edit'])
        ->name('product.edit');

    Route::put('/product/{id}',
        [ProductController::class, 'update'])
        ->name('product.update');


    // DELETE
    Route::delete('/product/{id}',
        [ProductController::class, 'destroy'])
        ->name('product.destroy');

        
});


/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'user'])->group(function () {

    // HOME
    Route::get('/home',
        [UserHomeController::class, 'index'])
        ->name('user.home');


    // KATALOG
    Route::get('/katalog',
        [UserHomeController::class, 'katalog'])
        ->name('user.katalog');


    // TRANSAKSI
    Route::get('/transaksi-user',
        [UserHomeController::class, 'transaksi'])
        ->name('user.transaksi');


    // DETAIL PRODUCT
    Route::get('/product-detail/{id}',
        [HomeController::class, 'detail'])
        ->name('user.detail');
    
    Route::get('/transaksi-detail/{id}',
        [OrderController::class,'transaksiDetail'])
        ->name('transaksi.detail');

    
});


/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'user'])->group(function () {

    // ADD CART
    Route::post('/cart/{id}',
        [CartController::class, 'store'])
        ->name('cart.store');


    // LIST CART
    Route::get('/cart',
        [CartController::class, 'index'])
        ->name('cart.index');
    
    // HAPUS CART
    Route::delete('/cart/{id}',
    [CartController::class,'destroy'])
    ->name('cart.destroy');

    Route::get(
        '/notifications',
        [NotificationController::class,'index']
    )->name('notifications.index');
    

});

Route::middleware(['auth'])->group(function () {

    Route::post(
        '/checkout/{id}',
        [CheckoutController::class,'process']
    )->name('checkout.process');

    Route::post(
        '/checkout-all',
        [CheckoutController::class,'checkoutAll']
    )->name('checkout.all');

});

// ORDER
// ======================
// ORDER USER
// ======================

Route::middleware(['auth'])->group(function () {

    Route::get(
        '/transaksi-user',
        [OrderController::class,'index']
    )->name('user.transaksi');
    Route::get(
        '/pesanan/{id}',
        [OrderController::class,'detail']
    )->name('orders.detail');

    Route::get(
    '/orders/{id}/invoice',
    [OrderController::class,'invoice']
    )->name('orders.invoice');

});


// ======================
// ORDER ADMIN
// ======================

Route::middleware(['auth','multirole:admin,superadmin'])->group(function () {

    Route::get(
        '/orders',
        [OrderController::class,'adminIndex']
    )->name('orders.index');

    Route::get(
        '/orders/{id}',
        [OrderController::class,'show']
    )->name('orders.show');

    Route::put(
        '/orders/{id}/confirm',
        [OrderController::class,'confirm']
    )->name('orders.confirm');

    Route::put(
        '/orders/{id}/selesai',
        [OrderController::class,'selesai']
    )->name('orders.selesai');

    Route::put(
        '/orders/{id}/cancel',
        [OrderController::class,'cancel']
    )->name('orders.cancel');

    Route::put(
    '/orders/{id}/kirim',
    [OrderController::class,'kirim']
    )->name('orders.kirim');


});


Route::middleware('auth')->group(function () {

    Route::get(
        '/notifications',
        [NotificationController::class, 'index']
    )->name('notifications.index');

    Route::post(
        '/notifications/{id}/read',
        [NotificationController::class, 'markAsRead']
    )->name('notifications.read');

    Route::get(
        '/admin-notifications',
        [NotificationController::class,'admin']
    )->name('notifications.admin');


});




require __DIR__.'/auth.php';
