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
Route::get('/getcolumndata', 'ColumnDataController@GetColumnData');

Route::get('/home', 'HomeController@index');


Route::get('/checkquantity', 'QuantityController@CheckQuantity');

Route::get('/stores/current', 'QuantityController@GetCurrentStore');
Route::get('/to_request_report', 'QuantityController@GetDataSelectedForReport');
Route::delete('/destroy_request_report/{reportrequests}', 'QuantityController@DestroyRequestReport');
Route::get('/request_report_list', 'QuantityController@AllRequestReports');


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

Route::resource('itemloanissues','ItemLoanIssuesController');
Route::get('/itemloanissues/create/{id}', 'ItemLoanIssuesController@create');

Route::resource('loanissuereturns','LoanIssueReturnsController');

Route::resource('itemloanissuereturns','ItemLoanIssueReturnsController');

Route::resource('cats','CatsController');



Route::get('/requestselected/{id}', 'ItemsReportrequestController@seedinfo');

//Route::resource('requestreports','ItemsReportrequestController');

Route::post('itemrequestreportsupdate', 'ItemsReportrequestController@update');//update route for itemsreportrequest ajax
Route::post('itemrequestreportsadd', 'ItemsReportrequestController@store');//aadd route for itemsreportrequest ajax
Route::delete('itemrequestreportsdelete', 'ItemsReportrequestController@destroy');//delet route for itemsreportrequest ajax
