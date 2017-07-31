<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
////////////////////////////////////////////////common

Route::get('/','HomeController@index');

Route::get('/suggest', 'SuggestsController@suggest');

Route::get('/GetSingleValue', 'AjaxDataController@GetSingleValue');
Route::get('/GetLatestPrice', 'AjaxDataController@GetLatestPrice');

Route::get('/item_price_history', 'ChangePricesController@getItemPriceHistory');
Route::post('item_price_store', 'ChangePricesController@store');//ajax route

Route::get('/home', 'HomeController@index');

Route::get('/checkquantity', 'QuantityController@CheckQuantity');



Route::get('settings/user', 'Auth\UpdatePasswordController@ShowUserProfile');
Route::post('settings/user', 'Auth\UpdatePasswordController@update');
Route::post('change-profile', 'Auth\UpdatePasswordController@UpdateUserProfile');

Route::auth();
//////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////common(some features only)


Route::resource('items','ItemsController');

Route::get('/change_prices', 'ChangePricesController@index');


Route::resource('orders','OrdersController');

Route::resource('cats','CatsController');

Route::resource('suppliers','SuppliersController');

Route::resource('itemorders','ItemOrdersController');

Route::resource('quotations','QuotationsController');
Route::resource('quotationitems','QuotationItemsController');
Route::get('/quotationitems/create/{id}', 'QuotationItemsController@create');

Route::get('/stores/current', 'QuantityController@GetCurrentStore');

Route::resource('huts','HutsController');
Route::resource('hutitems','HutItemsController');
Route::get('/hutitems/create/{id}', 'HutItemsController@create');





///////////////////////////////////////////////////////////////////////////////////////////////////////




/////////////////////////////////////////////////////////////////////////storekeeper only

Route::group(['middleware' => 'App\Http\Middleware\StockMiddleware'], function()
{
    Route::resource('items','ItemsController',['except' => ['index','show']]);


    Route::resource('customers','CustomersController');

    Route::resource('grns','grnsController');

    Route::resource('itemgrns','itemgrnsController');

    Route::resource('sales','SalesController');

    Route::resource('saleitems','SaleItemsController');
    Route::get('/saleitems/create/{id}', 'SaleItemsController@create');


    Route::get('/reports/grn/{id}', 'ReportsController@ShowGrnReport');
    Route::get('/reports/sale/{id}', 'ReportsController@ShowSaleReport');


    Route::post('item_grn_update', 'ItemgrnsController@update');//update route ajax
    Route::post('item_grn_store', 'ItemgrnsController@add');//aadd route ajax
    Route::post('item_grn_destroy', 'ItemgrnsController@destroy');//delet route ajax


});




/////////////////////////////////////////////////////////////////////////////////////////////////////










/////////////////////////////////////////////////////////suplly


Route::group(['middleware' => 'App\Http\Middleware\SupplyMiddleware'], function()
{
    Route::get('/reports/order/{id}', 'ReportsController@ShowOrderReport');

    Route::resource('orders','OrdersController',['except' => ['index']]);

    Route::resource('itemorders','ItemOrdersController',['except' => ['show']]);

    Route::get('/itemorders/create/{id}', 'ItemOrdersController@create');

    Route::resource('suppliers','SuppliersController',['except' => ['index']]);
});
