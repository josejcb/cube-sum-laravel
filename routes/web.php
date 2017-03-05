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

Route::get('/',
function () {
    return view('welcome');
});


// Route::post('/solve', ['uses' => 'MainController@solve', 'as' => 'solve']);
   // Route::controller('/main', 'MainController');
   
Route::post('/solve',['as' => 'solve', 'uses' => 'MainController@solve']); 
// function () {
    // return view('welcome');
// });
