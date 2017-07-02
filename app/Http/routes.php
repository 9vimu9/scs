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

Route::get('/','HomeController@index');
Route::get('/suggest', 'SuggestsController@suggest');
Route::get('/checkreorder', 'ItemsController@CheckReorder');
Route::get('/checkquantity', 'QuantityController@CheckQuantity');
Route::get('/home', 'HomeController@index');

Route::auth();

Route::resource('suppliers','SuppliersController');

Route::resource('officers','OfficersController');

Route::resource('items','ItemsController');

Route::resource('orders','OrdersController');

Route::resource('itemorders','ItemOrdersController');
Route::get('/itemorders/create/{id}', 'ItemOrdersController@create');

Route::resource('receives','ReceivesController');

Route::resource('itemreceives','itemreceivesController');

Route::resource('issues','IssuesController');

Route::resource('issueitems','IssueItemsController');
Route::get('/issueitems/create/{id}', 'IssueItemsController@create');

Route::resource('loanissues','LoanIssuesController');

