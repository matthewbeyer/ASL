<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['uses' => 'HomeController@index']);

// route to show the login form
Route::get('login', ['as' => 'login', 'uses' => 'UsersController@showLogin']);
// route to process the form
Route::post('login', ['uses' => 'UsersController@doLogin']);

// Login using FB
Route::get('login/fb', ['as' => 'fblogin', 'uses' => 'SocialAuthController@FBLogin']);
Route::get('login/fb/callback', ['as' => 'fblogincallback', 'uses' => 'SocialAuthController@FBLoginCallback']);

// Log the user out
Route::get('logout', ['uses' => 'UsersController@doLogout']);

// Show the signup page
Route::get('signup', ['as' => 'signup', 'uses' => 'UsersController@showSignup']);
// Process the signup request
Route::post('signup', ['uses' => 'UsersController@doSignup']);

// Show the forgotten password page
Route::get('forgot', ['as' => 'forgot', 'uses' => 'UsersController@showForgot']);
// Send the reset email to reset user's password
Route::post('forgot', ['uses' => 'UsersController@doForgot']);

// Show the reset password page
Route::get('resetpassword/{resetcode}', ['as' => 'resetpassword', 'uses' => 'UsersController@showReset']);
// Reset the user's password with their code and new stuff
Route::post('resetpassword/{resetcode}', ['uses' => 'UsersController@doReset']);

Route::get('questions', ['as' => 'questions', 'uses' => 'QuestionsController@index']);