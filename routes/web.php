<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Hekmatinasser\Verta\Verta;


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
//front shop
Route::get('/', 'App\Http\Controllers\HomeController@index');

//profile front
Route::prefix('profile')->group(function () {
    Route::get('/', 'App\Http\Controllers\Profile\ProfileController@index')->name('profile');
    Route::get('twofactor', 'App\Http\Controllers\Profile\ProfileController@twoFactorAuth')->name('twofactorauth');
    Route::post('twofactor', 'App\Http\Controllers\Profile\ProfileController@insTwoFactorAuth')->name('ins.twofactorauth');
    Route::get('orders', 'App\Http\Controllers\Profile\ProfileController@orders');
});

//admin panel
Route::prefix('dashboard')->group(function () {
    Route::get('/', 'App\Http\Controllers\Admin\HomeController@index');
    Route::resource('/users', 'App\Http\Controllers\Admin\UserController');
    Route::resource('/comments', 'App\Http\Controllers\Admin\CommentsController');
    Route::get('/comment-unapproved', 'App\Http\Controllers\Admin\CommentsController@unapproved')->name('comments.approved');
    Route::patch('/comment-unapproved/{comment}', 'App\Http\Controllers\Admin\CommentsController@unapprovedPost')->name('unapproved.Post');
    Route::resource('/products', 'App\Http\Controllers\Admin\ProductController');
    Route::resource('/categories','App\Http\Controllers\Admin\CategoryController');
    Route::resource('/attributes','App\Http\Controllers\Admin\AttributeController');
    Route::get('/attribute/values/{attribute}','App\Http\Controllers\Admin\AttributeController@getValues')->name('attribute.get.values');
    Route::post('/attribute/values','App\Http\Controllers\Admin\AttributeController@postValues')->name('attribute.post.values');
    //permissions
    Route::resource('/permissions','App\Http\Controllers\Admin\PermissionController');
    Route::resource('/roles','App\Http\Controllers\Admin\RoleController');
    Route::get('/user/roles/{user}','App\Http\Controllers\Admin\UserController@addRole')->name('users.role');
    Route::patch('/user/roles/{user}','App\Http\Controllers\Admin\UserController@updateRole')->name('users.role.update');
    //orders
    Route::resource('/orders','App\Http\Controllers\OrderController');
    Route::get('/orders/invoice/{id}','App\Http\Controllers\OrderController@invoice')->name('invoice.index');
    Route::patch('/invoice/{id}','App\Http\Controllers\OrderController@invoiceStatus')->name('status.invoice');
});
//products cleint
Route::get('/products','App\Http\Controllers\ProductController@index');
Route::get('/product/{product}','App\Http\Controllers\ProductController@singleProduct');
Route::post('/product/comment','App\Http\Controllers\CommentController@sendComment')->name('send.comment');
Route::resource('/cart','App\Http\Controllers\CartController');
//payment
Route::get('/product/{id}/purchase','App\Http\Controllers\PurchaseController@purchase')->name('payment.product');
Route::get('/product/{id}/purchase/result','App\Http\Controllers\PurchaseController@result')->name('payment.product.result');
Auth::routes(['verify' => true]);
