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
        Route::get('dialy-report', 'ChartsController@dailyReport')->name('dialy.report');
        Route::post('/daily_report', 'ChartsController@ajaxDaily');

        Route::get('dialy-monthly', 'ChartsController@monthlyReport')->name('monthly.report');
        Route::post('/monthly_report', 'ChartsController@ajaxMonthly');
        
        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::get('logout', 'AdminController@logout')->name('logout');
        Route::get('settings', 'AdminController@settings')->name('settings');
        Route::post('check-current-password', 'AdminController@checkCurrentPassword');
        Route::post('update-current-password', 'AdminController@updateCurrentPassword')->name('update.current.password');
        Route::match(['get', 'post'], 'update-admin-details', 'AdminController@updateAdminDetails')->name('update.admin.details');

        Route::get('order', 'OrderController@orderView')->name('order');
        Route::get('kitchen', 'OrderController@kitchen')->name('kitchen');
        Route::get('kitchen-update/{id}', 'OrderController@kitchenUpdate')->name('kitchen.update');
        Route::get('kitchen-innovice/{id}', 'OrderController@kitchenInnovice')->name('kitchen.innovice');
        Route::post('update-kitchen-status', 'OrderController@updateKitchenStatus');
        Route::get('bar', 'OrderController@bar')->name('bar');
        Route::get('bar-update/{id}', 'OrderController@barUpdate')->name('bar.update');
        Route::get('bar-innovice/{id}', 'OrderController@barInnovice')->name('bar.innovice');
        Route::get('bar-detail/{id}', 'OrderController@orderDetails')->name('order.detail');
        Route::post('update-cancel-status', 'OrderController@updateOrderCancel');
        Route::post('update-order-status/{id?}', 'OrderController@updateOrderStatus')->name('update.order.status');
        Route::get('order-innovice/{id}', 'OrderController@orderInnovice')->name('order.innovice');
        Route::get('delete-order/{id}', 'OrderController@delete');
        Route::post('update-order', 'OrderController@updateOrder')->name('update.order');
        Route::get('view-cancel-order', 'OrderController@viewCancelOrder')->name('cancel.order');

            // user route 
        Route::group(['middleware'=>'ChekcRole:admin'], function(){
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
    

            // Route::get('post', 'PostController@item')->name('post');
            // Route::post('update-item-status', 'PostController@updatePostStatus');
            // Route::post('add-post', 'PostController@add')->name('add.post');
            // Route::post('edit-post/{id}', 'PostController@edit')->name('edit.post');
            // Route::get('delete-post/{id}', 'PostController@delete')->name('delete.post');
//kishr i am adding route here

             Route::get('ingredient-categories', 'ingredientCategoryController@ingredientCategories')->name('ingredientCategory');
             Route::match(['get', 'post'], 'add-edit-ingredientCategory/{id?}', 'ingredientCategoryController@addEditIngredientCategory')->name('add.edit.ingredient.category');
             Route::get('delete-ingredientCategory/{id?}', 'ingredientCategoryController@deleteIngredientCategory')->name('delete.ingredient.category');
    
    //kishor i am ending route here.

    //kishr i am adding route here

    Route::get('ingredient-units', 'ingredientUnitsController@ingredientUnits')->name('ingredientUnit');
    Route::match(['get', 'post'], 'add-edit-ingredientUnit/{id?}', 'ingredientUnitsController@addEditIngredientUnit')->name('add.edit.ingredient.unit');
    Route::get('delete-ingredientUnit/{id?}', 'ingredientUnitsController@deleteIngredientUnit')->name('delete.ingredient.unit');

//kishor i am ending route here.

   //kishr i am adding route here

   Route::get('ingredient-items', 'IngredientItemsController@ingredientItems')->name('ingredientItem');
   Route::match(['get', 'post'], 'add-edit-ingredientItem/{id?}', 'IngredientItemsController@addEditIngredientItem')->name('add.edit.ingredient.item');
   Route::get('delete-ingredientItem/{id?}', 'IngredientItemsController@deleteIngredientItem')->name('delete.ingredient.item');

//kishor i am ending route here.
//kishr i am adding route here

Route::get('food-categories', 'FoodCategoryController@foodCategories')->name('foodCategory');
Route::match(['get', 'post'], 'add-edit-foodCategory/{id?}', 'FoodCategoryController@addEditFoodCategory')->name('add.edit.food.category');
Route::get('delete-foodCategory/{id?}', 'FoodCategoryController@deleteFoodCategory')->name('delete.food.category');

//kishor i am ending route here.
//kishr i am adding route here

Route::get('food-menus', 'FoodMenuController@foodMenus')->name('foodMenu');
Route::match(['get', 'post'], 'add-edit-foodMenu/{id?}', 'FoodMenuController@addEditFoodMenu')->name('add.edit.food.menu');
Route::get('delete-foodMenu/{id?}', 'FoodMenuController@deleteFoodMenu')->name('delete.food.menu');

//kishor i am ending route here.

Route::get('purchase', 'PurchaseController@purchase')->name('purchase');
Route::match(['get', 'post'], 'add-edit-purchase/{id?}', 'PurchaseController@addEditPurchase')->name('add.edit.purchase');
Route::get('delete-purchase/{id?}', 'PurchaseController@deletePurchase')->name('delete.purchase');

//kishor i am ending route here.
//kishor i am ending route here.

Route::get('customer', 'CustomerController@customer')->name('customer');
Route::match(['get', 'post'], 'add-edit-customer/{id?}', 'CustomerController@addEditCustomer')->name('add.edit.customer');
Route::get('delete-customer/{id?}', 'CustomerController@deleteCustomer')->name('delete.customer');

//kishor i am ending route here.
//kishor i am ending route here.

Route::get('supplier', 'SupplierController@Supplier')->name('supplier');
Route::match(['get', 'post'], 'add-edit-supplier/{id?}', 'SupplierController@addEditSupplier')->name('add.edit.supplier');
Route::get('delete-supplier/{id?}', 'SupplierController@deleteSupplier')->name('delete.supplier');

//kishor i am ending route here.
//kishor i am ending route here.

Route::get('waste', 'WasteController@Waste')->name('waste');
Route::match(['get', 'post'], 'add-edit-waste/{id?}', 'WasteController@addEditWaste')->name('add.edit.waste');
Route::get('delete-waste/{id?}', 'WasteController@deleteWaste')->name('delete.waste');

//kishor i am ending route here.
//kishor i am ending route here.

Route::get('table', 'TableController@table')->name('table');
Route::match(['get', 'post'], 'add-edit-table/{id?}', 'TableController@addEditTable')->name('add.edit.table');
Route::get('delete-table/{id?}', 'TableController@deleteTable')->name('delete.table');

//kishor i am ending route here.
//kishor i am ending route here.

Route::get('sale', 'SaleController@Sale')->name('sale');
Route::match(['get', 'post'], 'add-edit-sale/{id?}', 'SaleController@addEditSale')->name('add.edit.sale');
Route::get('delete-sale/{id?}', 'SaleController@deleteSale')->name('delete.sale');
Route::post('/delete-cart/{id}','SaleController@deleteCart')->name('delete.cart');
Route::get('ajax-get-item', 'SaleController@ajaxGetItem');
Route::post('ajax-food-table', 'SaleController@ajaxFoodTable');
//kishor i am ending route here.

//kishor i am ending route here.

Route::get('waiter', 'WaiterController@Waiter')->name('waiter');
Route::match(['get', 'post'], 'add-edit-waiter/{id?}', 'WaiterController@addEditWaiter')->name('add.edit.waiter');
Route::get('delete-waiter/{id?}', 'WaiterController@deleteWaiter')->name('delete.waiter');

//kishor i am ending route here.
//kishor i am ending route here.

Route::get('order', 'OrderController@Order')->name('order');
Route::match(['get', 'post'], 'add-edit-order/{id?}', 'OrderController@addEditOrder')->name('add.edit.order');
Route::get('delete-order/{id?}', 'OrderController@deleteOrder')->name('delete.order');

//kishor i am ending route here.
//kishor i am ending route here.

Route::get('user', 'UserController@User')->name('user');
Route::match(['get', 'post'], 'add-edit-user/{id?}', 'UserController@addEditUser')->name('add.edit.user');
Route::get('delete-user/{id?}', 'UserController@deleteUser')->name('delete.user');

//kishor i am ending route here.





            Route::get('addon/{id}', 'AddOnController@addOn')->name('addon');
            Route::post('add-addon/{id}', 'AddOnController@addAddOn')->name('add.addon');
            Route::post('edit-addon/{id}', 'AddOnController@editAddOn')->name('edit.addon');
            Route::get('addon/delete-attribute/{id}', 'AddOnController@delete')->name('delete.addon');
    
            Route::get('size/{id}', 'SizeController@size')->name('size');
            Route::post('add-size/{id}', 'SizeController@addSize')->name('add.size');
            Route::post('edit-size/{id}', 'SizeController@editSize')->name('edit.size');
            Route::get('size/delete-attribute/{id}', 'SizeController@delete')->name('delete.size');
    
            
    
           
            
            Route::get('payment', 'PaymentController@payment')->name('payment');
            Route::post('add-payment', 'PaymentController@add')->name('add.payment');
            Route::post('edit-payment/{id}', 'PaymentController@edit')->name('edit.payment');
            Route::get('delete-payment/{id}', 'PaymentController@delete')->name('delete.payment');
    
            
    
    
            Route::get('payment', 'PaymentController@payment')->name('payment');
            Route::post('add-payment', 'PaymentController@add')->name('add.payment');
            Route::post('edit-payment/{id}', 'PaymentController@edit')->name('edit.payment');
            Route::get('delete-payment/{id}', 'PaymentController@delete');
        });
        // routes for checkin and checkout
        Route::get('checkin-room', 'RoomController@checkinView')->name('checkin.room');
        Route::post('add-checkin-room', 'RoomController@addCheckin')->name('add.checkin.room');
        Route::post('edit-checkin-room/{id}', 'RoomController@editCheckin')->name('edit.checkin.room');
        Route::get('checkout-room', 'RoomController@checkoutView')->name('checkout.room');
        Route::get('room-detail/{id}', 'RoomController@roomDetail')->name('room.detail');
        Route::post('checkout-user-bill/{id}', 'RoomController@checkoutUserBill')->name('checkout.user.bill');


        
        
        Route::get('checkout-room', 'RoomController@checkoutView')->name('checkout.room');
        Route::get('checkout-bill/{id}', 'RoomController@bill')->name('bill.print.checkout');

        
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


