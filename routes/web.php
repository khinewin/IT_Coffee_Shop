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

Route::get('/', [
    'uses'=>'HomeController@getWelcome',
    'as'=>'/'
]);
Route::get('/coffeeImage/{file_name}',[
    'uses'=>'HomeController@showImage',
    'as'=>'coffeeImage'
]);

Route::get('/search-coffee',[
    'uses'=>'HomeController@showSearch',
    'as'=>'search-coffee'
]);
Route::get('/get-by-category',[
    'uses'=>'HomeController@getByCategory',
    'as'=>'get-by-category'
]);
Route::get('/add-to-cart',[
    'uses'=>'HomeController@getAddToCart',
    'as'=>'add-to-cart'
]);
Route::get('/show-cart',[
    'uses'=>'HomeController@getShowCart',
    'as'=>'show-cart'
]);
Route::get('/clear-cart',[
    'uses'=>'HomeController@getClearCart',
    'as'=>'clear-cart'
]);
Route::get('getCart',[
    'uses'=>'HomeController@getCart',
    'as'=>'getCart'
]);

Route::get('remove-item/{id}',[
    'uses'=>'HomeController@getRemoveItem',
    'as'=>'remove-item'
]);
Route::get('reduce-one/{id}',[
    'uses'=>'HomeController@getReduceOne',
    'as'=>'reduce-one'
]);
Route::post('/check-out',[
    'uses'=>'HomeController@postCheckOut',
    'as'=>'check-out'
]);

Route::group(['middleware'=>'auth'],function (){

        Route::get('/dashboard',[
            'uses'=>'HomeController@getDashboard',
            'as'=>'dashboard'
        ]);

        Route::get('getCart',[
            'uses'=>'HomeController@getCart',
            'as'=>'getCart'
        ]);


        Route::get('/coffee-list',[
            'uses'=>'CoffeeController@getCoffeeList',
            'as'=>'coffee-list'
        ]);
        Route::post('/new-category',[
            'uses'=>'CoffeeController@postNewCategory',
            'as'=>'new-category'
        ]);
        Route::post('/delete-category',[
            'uses'=>'CoffeeController@postDeleteCategory',
            'as'=>'delete-category'
        ]);
        Route::get('/new-coffee',[
            'uses'=>'CoffeeController@getNewCoffee',
            'as'=>'new-coffee'
        ]);
        Route::get('/close-new-coffee',[
            'uses'=>'CoffeeController@getCloseNewCoffee',
            'as'=>'close-new-coffee'
        ]);
        Route::post('/add-new-coffee',[
            'uses'=>'CoffeeController@postAddNewCoffee',
            'as'=>'add-new-coffee'
        ]);
        Route::get('/get-coffee-image/{file_name}',[
            'uses'=>'CoffeeController@getCoffeeImage',
            'as'=>'get-coffee-image'
        ]);

        Route::get('/orders',[
            'uses'=>'OrderController@getOrders',
            'as'=>'orders'
        ]);

        Route::get('/getOrders',[
        'uses'=>'OrderController@getGetOrders',
        'as'=>'getOrders'
        ]);

        Route::get('/print-order',[
            'uses'=>'OrderController@getPrintOrder',
            'as'=>'print-order'
        ]);
        Route::get('/order-update',[
            'uses'=>'OrderController@getOrderUpdate',
            'as'=>'order-update'
        ]);
        Route::get('/change-order',[
            'uses'=>'OrderController@getChangeOrder',
            'as'=>'change-order'
        ]);

        Route::get('/profit',[
            'uses'=>'OrderController@getProfit',
            'as'=>'profit'
        ]);
        Route::get('/profit-by-month',[
            'uses'=>'OrderController@getProfitByMonth',
            'as'=>'profit-by-month'
        ]);



});

Route::group(['prefix'=>'auth'],function (){
    Route::get('/register',[
        'uses'=>'AuthController@getRegister',
        'as'=>'register'
    ]);
    Route::get('/login',[
        'uses'=>'AuthController@getLogin',
        'as'=>'login'
    ]);
    Route::post('/register',[
        'uses'=>'AuthController@postRegister',
        'as'=>'register'
    ]);
    Route::post('/login',[
        'uses'=>'AuthController@postLogin',
        'as'=>'login'
    ]);
    Route::get('/logout',[
        'uses'=>'AuthController@getLogout',
        'as'=>'logout'
    ]);
});