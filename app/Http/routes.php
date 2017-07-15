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

Route::get('/getcolumndata', 'ColumnDataController@GetColumnData');

Route::get('/home', 'HomeController@index');

Route::get('/checkquantity', 'QuantityController@CheckQuantity');



Route::get('change-password', 'Auth\UpdatePasswordController@ShowUserProfile');
Route::post('change-password', 'Auth\UpdatePasswordController@update');
Route::post('change-profile', 'Auth\UpdatePasswordController@UpdateUserProfile');

Route::auth();
//////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////common(some features only)


 Route::resource('items','ItemsController');

Route::resource('orders','OrdersController');

Route::resource('cats','CatsController');

Route::resource('suppliers','SuppliersController');

Route::resource('itemorders','ItemOrdersController');

Route::get('/requestselected/{id}', 'ItemsReportrequestController@seedinfo');
Route::get('/stores/current', 'QuantityController@GetCurrentStore');
Route::get('/to_request_report', 'QuantityController@GetDataSelectedForReport');

Route::get('/request_report_list', 'QuantityController@AllRequestReports');


///////////////////////////////////////////////////////////////////////////////////////////////////////




/////////////////////////////////////////////////////////////////////////storekeeper only

Route::group(['middleware' => 'App\Http\Middleware\StockMiddleware'], function()
{
    Route::resource('items','ItemsController',['except' => ['index','show']]);


    Route::resource('officers','OfficersController');

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

    Route::get('/reports/requestmonthly/{id}', 'ReportsController@ShowMonthlyRequestReport');
    Route::get('/reports/grn/{id}', 'ReportsController@ShowGrnReport');
    Route::get('/reports/issue/{id}', 'ReportsController@ShowIssueReport');

    Route::post('itemrequestreportsupdate', 'ItemsReportrequestController@update');//update route for itemsreportrequest ajax
    Route::post('itemrequestreportsadd', 'ItemsReportrequestController@store');//aadd route for itemsreportrequest ajax
    Route::post('itemrequestreportsdelete', 'ItemsReportrequestController@destroy');//delet route for itemsreportrequest ajax

    Route::post('item_receive_update', 'ItemreceivesController@update');//update route for itemsreportrequest ajax
    Route::post('item_receive_store', 'ItemreceivesController@add');//aadd route for itemsreportrequest ajax
    Route::post('item_receive_destroy', 'ItemreceivesController@destroy');//delet route for itemsreportrequest ajax

    Route::delete('/destroy_request_report/{reportrequests}', 'QuantityController@DestroyRequestReport');
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
