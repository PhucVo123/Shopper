<?php
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/trang_chu','App\Http\Controllers\HomeController@index');
Route::get('/login','App\Http\Controllers\HomeController@login');
Route::post('/save-login','App\Http\Controllers\HomeController@save_login');
Route::post('/save-logup','App\Http\Controllers\HomeController@save_logup');
Route::get('/logout_user','App\Http\Controllers\HomeController@logout');
Route::get('/danh-muc-san-pham/{category_product_name}/{category_product_id}','App\Http\Controllers\HomeController@category');



Route::get('/admin', 'App\Http\Controllers\AdminController@index');

Route::get('/dasboard', 'App\Http\Controllers\AdminController@home_admin');

Route::get('/logout', 'App\Http\Controllers\AdminController@logout');

Route::post('/admin-dasboard', 'App\Http\Controllers\AdminController@insert_account');

//Category Product
Route::get('/add-category-product', 'App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/all-category-product', 'App\Http\Controllers\CategoryProduct@all_category_product');
Route::post('/save-category-product', 'App\Http\Controllers\CategoryProduct@save_category_product');
Route::get('/active-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@active_category_product');
Route::get('/unactive-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@unactive_category_product');
Route::post('/update-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@update_category_product');
Route::get('/delete-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@delete_category_product');

//Brand
Route::get('/add-brand', 'App\Http\Controllers\BrandController@add_brand');
Route::get('/edit-brand/{brand_id}', 'App\Http\Controllers\BrandController@edit_brand');
Route::get('/all-brand', 'App\Http\Controllers\BrandController@all_brand');
Route::post('/save-brand', 'App\Http\Controllers\BrandController@save_brand');
Route::get('/active-brand/{brand_id}', 'App\Http\Controllers\BrandController@active_brand');
Route::get('/unactive-brand/{brand_id}', 'App\Http\Controllers\BrandController@unactive_brand');
Route::post('/update-brand/{brand_id}', 'App\Http\Controllers\BrandController@update_brand');
Route::get('/delete-brand/{brand_id}', 'App\Http\Controllers\BrandController@delete_brand');

//Product
Route::get('/add-product', 'App\Http\Controllers\ProductController@add_product');
Route::get('/edit-product/{product_id}', 'App\Http\Controllers\ProductController@edit_product');
Route::get('/all-product', 'App\Http\Controllers\ProductController@all_product');
Route::post('/save-product', 'App\Http\Controllers\ProductController@save_product');
Route::get('/active-product/{product_id}', 'App\Http\Controllers\ProductController@active_product');
Route::get('/unactive-product/{product_id}', 'App\Http\Controllers\ProductController@unactive_product');
Route::post('/update-product/{product_id}', 'App\Http\Controllers\ProductController@update_product');
Route::get('/delete-product/{product_id}', 'App\Http\Controllers\ProductController@delete_product');
Route::get('/chi-tiet-san-pham/{product_id}','App\Http\Controllers\ProductController@detail_product');
Route::post('/load-comment', 'App\Http\Controllers\ProductController@load_comment');
Route::post('/send-comment', 'App\Http\Controllers\ProductController@send_comment');
Route::get('/all-comment', 'App\Http\Controllers\ProductController@all_comment');
Route::post('/confirm-comment', 'App\Http\Controllers\ProductController@confirm_comment');
Route::post('/reply-comment', 'App\Http\Controllers\ProductController@reply_comment');
//Menu
Route::get('/trang-chu', 'App\Http\Controllers\Menu@menu');
Route::get('/add-menu', 'App\Http\Controllers\Menu@add_menu');
Route::get('/add-sub-menu', 'App\Http\Controllers\Menu@add_sub_menu');

//Cart
Route::post('/add-cart', 'App\Http\Controllers\CartController@add_cart');
Route::get('/cart', 'App\Http\Controllers\CartController@cart');
Route::get('/delete-cart/{session_id}', 'App\Http\Controllers\CartController@delete_cart');
Route::post('/update-cart', 'App\Http\Controllers\CartController@update_cart');

//Order
Route::get('/order-product', 'App\Http\Controllers\CartController@order');
Route::post('/checkout-product', 'App\Http\Controllers\OrderController@checkout');
Route::get('/order-status', 'App\Http\Controllers\OrderController@order_status');
Route::get('/rating/{pro_id}', 'App\Http\Controllers\OrderController@rating');
Route::post('/send-rating', 'App\Http\Controllers\OrderController@send_rating');
Route::get('/all-order', 'App\Http\Controllers\OrderController@all_order');
Route::post('/confirm-shipping', 'App\Http\Controllers\OrderController@confirm_shipping');
Route::post('/delete-order', 'App\Http\Controllers\OrderController@delete_order');
Route::get('/completed-order/{pro_id}', 'App\Http\Controllers\OrderController@complete_order');
//Search
Route::post('/search', 'App\Http\Controllers\ProductController@search');
Route::get('/result-search/{keyword}', 'App\Http\Controllers\ProductController@result_search');
