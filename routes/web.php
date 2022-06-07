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

        // // route for  choose 
        Route::get('choose', 'ChooseController@choose')->name('choose');
        Route::post('add-edit-choose/{id?}', 'ChooseController@addEditChoose')->name('add.edit.choose');
        Route::get('delete-choose/{id?}', 'ChooseController@deleteChoose')->name('delete.choose');

        // // route for  tour type 
        Route::get('tour-type', 'TourTypeController@tourType')->name('tour.type');
        Route::post('add-edit-tour-type/{id?}', 'TourTypeController@addEditTourType')->name('add.edit.tour.type');
        Route::get('delete-tour-type/{id?}', 'TourTypeController@deleteTourType')->name('delete.tour.type');


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
         Route::post('update-testimonial-status', 'TestimonialController@updateTestimonialStatus');
         Route::match(['get', 'post'], 'add-edit-testimonial/{id?}', 'TestimonialController@addEditTestimonail')->name('add.edit.testimonial');
         Route::get('delete-testimonial/{id?}', 'TestimonialController@deleteTestimonail')->name('delete.testimonial');


        //  route for post 
        Route::get('post-request', 'PostController@showPostRequest')->name('post.request');
        Route::get('post-detail/{id}', 'PostController@showPostDetail')->name('post.detail');
        Route::post('post-update-status/{id}', 'PostController@updateStatus')->name('post.update.status');



        // route for contact 
        Route::match(['get', 'post'], 'edit-contact/{id?}', 'ContactController@editContact')->name('edit.contact');


 
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
     
        // post 
        Route::get('post', 'PostController@post')->name('post');
        Route::match(['get', 'post'], 'add-edit-post/{id?}', 'PostController@addEditPost')->name('add.edit.post');
        Route::match(['get', 'post'], 'add-post/{id?}', 'PostController@add')->name('add.post');
        Route::match(['get', 'post'], 'edit-post/{id?}', 'PostController@edit')->name('edit.post');
        Route::post('update-post-status', 'PostController@updatePostStatus');
        Route::get('delete-post/{id?}', 'PostController@edit');
        Route::match(['get', 'post'], 'add-images/{id?}', 'PostController@addImages')->name('add.post.images');
        Route::get('add-images/delete-image/{id}', 'PostController@deleteImages');

        // route for order controller 
        Route::get('order', 'OrderController@order')->name('order');
        Route::match(['get', 'post'], 'order-detail/{id?}', 'OrderController@orderDetail')->name('order.detail');
        Route::get('order-invoice/{id}', 'OrderController@orderInnovice')->name('order.invoice');
        Route::get('order-bill/{id}', 'OrderController@orderBill')->name('order.bill');



  
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
    Route::get('/cart', 'OrderController@cart')->name('cart');
    Route::post('/cart-delete/{id?}', 'OrderController@cartDelete')->name('cart-delete');
    Route::post('update-cart-item-quantity', 'OrderController@updateCart');
    Route::post('add-cart', 'OrderController@addCart')->name('add.cart');
    Route::match(['get', 'post'],'checkout', 'OrderController@checkout')->name('checkout');
    Route::post('/place-order', 'OrderController@placeOder')->name('place.order');



    // route for account 
    Route::get('account', 'UserController@account')->name('account');
    Route::post('update-user-password', 'UserController@updateCurrentPassword')->name('update.user.password');
    Route::post('update-user-detail', 'UserController@updateUserDetail')->name('update.user.detail');
    Route::get('/logout','UserController@logout')->name('logout');
    
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


Route::get('qr-code-g', function () {
  
    $qr_code = rand(111,99999);
    $file = "image/$qr_code.png";

    $link = "https://qrmenu.summitp.com.np/menu/$qr_code";
      \QRCode::text($link)->setErrorCorrectionLevel("H")->setOutfile($file)->png();

});


