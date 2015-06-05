<?php
use Illuminate\Support\Facades\Route;
use \Config;
use \Redirect;
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

Route::get('/custom-search' , 'Shivergard\CustomSearch\CustomSearchController@init');
Route::get('/custom-search/list' , 'Shivergard\CustomSearch\CustomSearchController@listFields');
Route::get('/custom-search/individual' , 'Shivergard\CustomSearch\CustomSearchController@getInstance');
Route::get('/custom-search/template' , 'Shivergard\CustomSearch\CustomSearchController@getMust');


Route::get('/custom-search/{method}', function($method)
{
    $controller = new Shivergard\CustomSearch\CustomSearchController;
    if (method_exists ( $controller , $method ))
    	return $controller->{$method}();
    else
    	return Redirect::to('/');
});

Route::get('/custom-search/{method}/{param}', function($method , $param)
{
    $controller = new Shivergard\CustomSearch\CustomSearchController;
    if (method_exists ( $controller , $method ))
    	return $controller->{$method}($param);
    else
    	return Redirect::to('/');
});
