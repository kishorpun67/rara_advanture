<?php

use App\Admin\Banner;
use App\Admin\Category;
use App\Http\Controllers\Admin\TestimonialController;
use Illuminate\Support\Facades\Route;
use Whoops\Run;
// use Mail;
use App\Mail\SendMail;
use App\Jobs\ProcessPodcast;
use Carbon\Carbon;


// use Auth;
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
Route::group(['namespace' => 'SuperAdmin', 'prefix' => 'superAdmin', 'as' => 'superAdmin.'],function() {
    Route::match(['get', 'post'], '/', 'SuperAdminController@login')->name('login');
    Route::group(['middleware' => ['superAdmin']], function() {
        Route::get('dashboard', 'SuperAdminController@dashboard')->name('dashboard');
        Route::get('logout', 'SuperAdminController@logout')->name('logout');
        Route::get('settings', 'SuperAdminController@settings')->name('settings');
        Route::post('check-current-password', 'SuperAdminController@checkCurrentPassword');
        Route::post('update-current-password', 'SuperAdminController@updateCurrentPassword')->name('update.current.password');
        Route::match(['get', 'post'], 'update-admin-details', 'SuperAdminController@updateAdminDetails')->name('update.admin.details');

        // route for  admin 
        Route::get('all-admins', 'SuperAdminController@admin')->name('details');
        Route::post('add-edit-admin/{id?}', 'SuperAdminController@addEditAdmin')->name('add.edit.admin');
        Route::post('add-edit-access/{id?}', 'SuperAdminController@access')->name('add.edit.access');


        // Category
        Route::get('categories', 'CategoryController@categories')->name('categories');
        Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
        Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory')->name('add.edit.category');
        Route::post('append-categories-level', 'CategoryController@appendCategoryLevel');
        Route::get('delete-category/{id?}', 'CategoryController@deleteCategory')->name('delete-category');

        // banner 
        Route::get('banner', 'BannerController@banner')->name('banner');
        Route::post('update-banner-status', 'BannerController@updateBannerStatus');
        Route::post('add-banner', 'BannerController@add')->name('add.banner');
        Route::post('edit-banner/{id}', 'BannerController@edit')->name('edit.banner');
        Route::get('delete-banner/{id}', 'BannerController@delete')->name('delete.banner');

         // testimonial 
         Route::get('tesimonial', 'TestimonialController@testimonial')->name('testimonial');
         Route::match(['get', 'post'], 'add-edit-testimonial/{id?}', 'TestimonialController@addEditTestimonail')->name('add.edit.testimonial');
         Route::get('delete-testimonial/{id?}', 'TestimonialController@deleteTestimonail')->name('delete.testimonial');


        //  route for post 
        Route::get('post-request', 'PostController@showPostRequest')->name('post.request');
        Route::get('post-detail/{id}', 'PostController@showPostDetail')->name('post.detail');
        Route::post('post-update-status/{id}', 'PostController@updateStatus')->name('post.update.status');


 
    });
});


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'],function() {
    Route::match(['get', 'post'], '/', 'AdminController@login')->name('login');
    Route::match(['get', 'post'], '/register', 'AdminController@register')->name('register'); 
    Route::group(['middleware' => ['admin']], function() {
        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::get('logout', 'AdminController@logout')->name('logout');
        Route::get('settings', 'AdminController@settings')->name('settings');
        Route::post('check-current-password', 'AdminController@checkCurrentPassword');
        Route::post('update-current-password', 'AdminController@updateCurrentPassword')->name('update.current.password');
        Route::match(['get', 'post'], 'update-admin-details', 'AdminController@updateAdminDetails')->name('update.admin.details');

        // user route 
        Route::get('user', 'AdminController@viewUser')->name('user');
        Route::post('add', 'AdminController@add')->name('add.user');
        Route::post('edit/{id}', 'AdminController@edit')->name('edit.user');
        Route::get('delete-user/{id}', 'AdminController@deleteUser');

        Route::get('all-admins', 'AdminController@admin')->name('details');
        Route::post('add-edit-admin/{id?}', 'AdminController@addEditAdmin')->name('add.edit.admin');
        Route::get('delete-admin/{id?}', 'AdminController@delete');
        Route::post('add-edit-access/{id?}', 'AdminController@access')->name('add.edit.access');

        // banner 
        Route::get('banner', 'BannerController@banner')->name('banner');
        Route::post('update-banner-status', 'BannerController@updateBannerStatus');
        Route::post('add-banner', 'BannerController@add')->name('add.banner');
        Route::post('edit-banner/{id}', 'BannerController@edit')->name('edit.banner');
        Route::get('delete-banner/{id}', 'BannerController@delete')->name('delete.banner');

        // category
        Route::get('categories', 'CategoryController@categories')->name('categories');
        Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
        Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory')->name('add.edit.category');
        Route::post('append-categories-level', 'CategoryController@appendCategoryLevel');
        Route::get('delete-category/{id?}', 'CategoryController@deleteCategory')->name('delete-category');
        Route::get('add-edit-category/delete-category-image/{id?}', 'CategoryController@deleteCategoryImage');

        // testimonial 
        Route::get('tesimonial', 'TestimonialController@testimonial')->name('testimonial');
        Route::match(['get', 'post'], 'add-edit-testimonial/{id?}', 'TestimonialController@addEditTestimonail')->name('add.edit.testimonial');
        Route::get('delete-testimonial/{id?}', 'TestimonialController@deleteTestimonail')->name('delete.testimonial');

        Route::get('read-all-notification', function(){
            auth('admin')->user()->unreadNotifications->markAsRead(); 
            return redirect()->back();
        })->name('read.all.notification');

    });

});

Route::get('/','HomeController@home')->name('home');

Route::post('search-post', 'HomeController@searchPost')->name('post.search');
Route::get('category/{url?}', 'PostController@postList')->name('post.list');
Route::post('search-post-area' , 'PostController@searhPostArea')->name('search.post.area');
Route::get('detail/{url}', 'PostController@postDetails')->name('post.detail');
Route::post('/comment', 'PostController@addComment')->name('comment');


Route::group(['middleware' => ['auth']], function() {
    Route::post('/call-waiter', 'HomeController@callWaiter');
    Route::get('/logout','UserController@logout')->name('logout');
    Route::get('/cart', 'CartController@cart')->name('cart');
    Route::post('/cart-delete/{id?}', 'CartController@cartDelete')->name('cart-delete');
    Route::post('update-cart-item-quantity', 'CartController@updateCart');
    Route::post('add-cart', 'CartController@addCart')->name('add.cart');
    // Route::post('add-order', 'OrderController@addOrder')->name('add.order');
    // Route::post('payment', 'OrderController@payment')->name('payment');

    // Route::get('order-details', 'OrderController@orderDetails')->name('order.details');
    Route::get('read-all-notification', function(){
        auth()->user()->unreadNotifications->markAsRead(); 
        return redirect()->back();
    })->name('read.all.notification');
});

Route::match(['get', 'post'],'/login-register','UserController@login')->name('login');
Route::match(['get', 'post'],'register','UserController@register')->name('register');
// Route::group(['middleware' => ['auth']], function() {
//     Route::get('/', 'HomeController@home')->name('home');
//     Route::get('/price', 'HomeController@price');
//     Route::get('/calculate', 'HomeController@calculate');
//     Route::post('add-cart', 'CartController@addCart')->name('add.cart');
//     Route::post('update-quantity/{id}', 'CartController@updateQuantity')->name('update.quantity');
//     Route::get('delete-cart/{id}', 'CartController@delete');
//     Route::post('add-order', 'OrderController@addOrder')->name('add.order');
//     Route::get('order-cancel/{id}', 'OrderController@cancelOrder')->name('order.cancel');
//     Route::get('logout', 'UserController@logout')->name('logout');

// });
// Route::match(['get', 'post'],'login', 'UserController@login')->name('login');


// Route::get('verify', 'UserController@register');


// Route for front end 

Route::get('qr-code-g', function () {
  
    $qr_code = rand(111,99999);
    $file = "image/$qr_code.png";

    $link = "https://qrmenu.summitp.com.np/menu/$qr_code";
      \QRCode::text($link)->setErrorCorrectionLevel("H")->setOutfile($file)->png();




//   return view('qrCode');
});


