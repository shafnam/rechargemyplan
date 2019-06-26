<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

//Basic pages
Route::get('/', 'PagesController@index')->name('index');
//Route::get('/blog', 'PagesController@blog')->name('blog');
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::post('/contact', 'PagesController@postContactus')->name('contactus');
//for testing purposes
Route::get('/test', 'PagesController@testEmail')->name('test');

//Top-ups
Route::prefix('carriers')->group(function () {
    Route::get('/', 'CarriersController@index')->name('carriers');
    Route::get('/view/{id}','CarriersController@carrierPlanView')->name('carriers.view.get');
});

//Blogs
Route::prefix('blog')->group(function () {
    Route::get('/', 'BlogsController@index')->name('blog');
    Route::get('/view/{id}','BlogsController@show')->name('blog.view.get');
});

//Route::resource('carriers', 'CarriersController'); //to all the crud methods in CarriersController

Route::post('/add_to_cart/{item_id}', 'CartsController@addItem')->name('addTocart');
Route::post('removeItem/{productId}', 'CartsController@removeItem')->name('removeFromCart');
Route::get('/cart', 'CartsController@showCart')->name('cart');

Route::prefix('paypal')->group(function () {
    Route::get('/express-checkout', 'PaypalController@expressCheckout')->name('paypal.express-checkout');
    Route::get('/express-checkout-success', 'PaypalController@expressCheckoutSuccess');
    Route::post('/notify', 'PaypalController@notify');
});


Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::post('/users/edit/{id}','HomeController@accountUpdate')->name('user.edit.post');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');
Route::get('/changePassword','HomeController@changePassword')->name('changePassword.get');
Route::get('/user/logout','Auth\LoginController@userLogout')->name('user.logout');

//admin route for our multi-auth system

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout','Auth\AdminLoginController@logout')->name('admin.logout');
    Route::post('/logout','Auth\AdminLoginController@logout')->name('admin.logout');

    //admin password reset routes
    Route::post('/password/email','Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset','Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset','Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}','Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

    /**
     *  Carrier routes
    **/
    Route::get('/carriers/list','Admin\CarriersController@carriersList')->name('admin.carriers.list');
    Route::get('/carriers/list/{id}','Admin\CarriersController@carriersList')->name('admin.carriers.list.id');
    Route::get('/carriers/add','Admin\CarriersController@carrierAdd')->name('admin.carriers.add.get');
    Route::post('/carriers/add','Admin\CarriersController@carrierSave')->name('admin.carriers.add.post');
    Route::get('/carriers/edit/{id}','Admin\CarriersController@carrierEdit')->name('admin.carriers.edit.get');
    Route::post('/carriers/edit/{id}','Admin\CarriersController@carrierUpdate')->name('admin.carriers.edit.post');
    Route::delete('carriers/deactivate/{id}','Admin\CarriersController@carrierDeactivate')->name('admin.carriers.deactivate');
    Route::delete('carriers/activate/{id}','Admin\CarriersController@carrierActivate')->name('admin.carriers.activate');

    /**
     *  Plan routes
    **/
    Route::get('/plans/list','Admin\PlansController@plansList')->name('admin.plans.list');
    Route::get('/plans/list/{id}','Admin\PlansController@plansList')->name('admin.plans.list.id');
    Route::get('/plans/add','Admin\PlansController@planAdd')->name('admin.plans.add.get');
    Route::post('/plans/add','Admin\PlansController@planSave')->name('admin.plans.add.post');
    Route::get('/plans/edit/{id}','Admin\PlansController@planEdit')->name('admin.plans.edit.get');
    Route::post('/plans/edit/{id}','Admin\PlansController@planUpdate')->name('admin.plans.edit.post');
    Route::delete('plans/deactivate/{id}','Admin\PlansController@planDeactivate')->name('admin.plans.deactivate');
    Route::delete('plans/activate/{id}','Admin\PlansController@planActivate')->name('admin.plans.activate');

    /**
     *  Blog routes
    **/
    Route::get('/blogs/list','Admin\BlogsController@blogsList')->name('admin.blogs.list');
    Route::get('/blogs/list/{id}','Admin\BlogsController@blogsList')->name('admin.blogs.list.id');
    Route::get('/blogs/add','Admin\BlogsController@blogAdd')->name('admin.blogs.add.get');
    Route::post('/blogs/add','Admin\BlogsController@blogSave')->name('admin.blogs.add.post');
    Route::get('/blogs/edit/{id}','Admin\BlogsController@blogEdit')->name('admin.blogs.edit.get');
    Route::post('/blogs/edit/{id}','Admin\BlogsController@blogUpdate')->name('admin.blogs.edit.post');
    Route::get('/blogs/view/{id}','Admin\BlogsController@blogView')->name('admin.blogs.view.get');
    Route::delete('blogs/deactivate/{id}','Admin\BlogsController@blogDeactivate')->name('admin.blogs.unpublish');
    Route::delete('blogs/activate/{id}','Admin\BlogsController@blogActivate')->name('admin.blogs.publish');


});

//Route::get('backend', 'AdminController@index')->name('admin.dashboard');