<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CashierController;
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

route::get('/', [HomeController::class,'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


route::get('/redirect', [HomeController::class,'redirect'])->middleware('auth','verified');

route::get('/redirect', [HomeController::class,'userChart']);

route::get('/products', [HomeController::class,'products']);
route::get('/product_details/{id}', [HomeController::class,'product_details']);
route::post('/add_cart/{id}', [HomeController::class,'add_cart']);
route::get('/show_cart', [HomeController::class,'show_cart']);
route::get('/remove_cart/{id}', [HomeController::class,'remove_cart']);
route::get('/show_order', [HomeController::class,'show_order']);
route::get('/cash_order', [HomeController::class,'cash_order']);
route::get('/cancel_order/{id}', [HomeController::class,'cancel_order']);
route::get('/remove_order/{id}', [HomeController::class,'remove_order']);
route::post('/update_cart/{id}', [HomeController::class,'update_cart']);
route::get('/cartshow', [HomeController::class,'cartshow']);

Route::group(['middleware' => ['auth', 'admin']], function () {
    route::get('/view_category', [AdminController::class,'view_category']);
    route::post('/add_category', [AdminController::class,'add_category']);
    route::get('/delete_category/{id}', [AdminController::class,'delete_category']);
    // route::get('/redirect', [AdminController::class,'transactionChart']);
    route::get('/view_product', [AdminController::class,'view_product']);
    route::post('/add_product', [AdminController::class,'add_product']);
    route::get('/show_product', [AdminController::class,'show_product']);
    route::get('/delete_product/{id}', [AdminController::class,'delete_product']);
    Route::get('/trashed-product', [AdminController::class, 'trash_product'])->name('trash_product');
    Route::get('/restore-product/{id}', [AdminController::class, 'restore_product'])->name('restore_product');
    Route::get('/delete-product-perma/{id}', [AdminController::class, 'ProductdeletePermanently'])->name('deletePerma_product');


    route::get('/update_product/{id}', [AdminController::class,'update_product']);
    route::post('/update_product_confirm/{id}', [AdminController::class,'update_product_confirm']);
    route::get('/order', [AdminController::class,'order']);

    route::get('/show_transaction', [AdminController::class,'show_transaction']);
    route::get('/print_pdf_transaction/{id}', [AdminController::class,'print_pdf_transaction']);

    route::get('/delivered/{id}', [AdminController::class,'delivered']);
    route::get('/delete_order/{id}', [AdminController::class,'delete_order']);
    route::get('/print_pdf/{id}', [AdminController::class,'print_pdf']);
    route::get('/send_email/{id}', [AdminController::class,'send_email']);
    route::post('/send_user_email/{id}', [AdminController::class,'send_user_email']);
    route::get('/select_delete_order/{id}', [AdminController::class,'select_delete_order']);
    route::get('/delete_selected_orders', [AdminController::class,'delete_selected_orders']);
    Route::delete('/selected_order',[AdminController::class,'selected_order'])->name('order.delete');
    Route::delete('/selected_transaction',[AdminController::class,'selected_transaction'])->name('transaction.delete');
    Route::get('/trashed-Transcation', [AdminController::class, 'trash_transaction'])->name('trash_transaction');
    Route::get('/restore-Transcation/{id}', [AdminController::class, 'restore'])->name('restore_transaction');
    Route::get('/delete-Transcation-perma/{id}', [AdminController::class, 'deletePermanently'])->name('deletePerma_transaction');
    route::post('/selected_order/{id}', [AdminController::class,'selected_order']);

    Route::get('/sort-by-date', [AdminController::class,'orderByDate'])->name('order.sort-by-date');

    Route::get('/update_delivery_status/{id}/{status}',  [AdminController::class,'updateDeliveryStatus'])
    ->where(['status' => 'delivered|processing|pending|cancelled']);

    Route::post('/archive-order/{id}', [AdminController::class, 'archive_order'],)->name('order.archive');

    route::get('/search', [AdminController::class,'search']);
    route::post('/walk_add_cart/{id}', [AdminController::class,'walk_add_cart']);
    route::get('/customers', [AdminController::class,'customers']);
    route::get('/user_edit/{id}', [AdminController::class,'user_edit']);
    route::post('/update_user/{id}', [AdminController::class,'update_user']);
    route::get('/add_customer', [AdminController::class,'add_customer']);
    route::post('/adding_customer', [AdminController::class,'adding_customer']);
    // route::get('/pos', [AdminController::class,'pos']);
    // route::post('/pos_add_cart/{id}', [AdminController::class,'pos_add_cart']);
    route::get('/delivered_orders', [AdminController::class,'delivered_orders']);

    Route::group(['middleware' => ['admin', 'cashier']], function () {
        route::post('/add_product', [CashierController::class,'add_product']);
        route::get('/pos', [CashierController::class,'pos']);
        route::post('/walkinName', [CashierController::class,'walkinName']);
        Route::post('/delivery', [CashierController::class, 'delivery']);
        route::post('/walkInOrder/{id}', [CashierController::class,'walkInOrder']);
        Route::post('/update_quantity/{id}',[CashierController::class,'update_quantity']);
        route::get('/remove_order_walkIn/{id}', [CashierController::class,'remove_order_walkIn']);
        // Add any other routes that should be accessible to both admins and cashiers here
    });

});


