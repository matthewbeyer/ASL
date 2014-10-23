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

Route::get('/', ['uses' => 'HomeController@index']); // Homepage (may redirect to the dashboard if the user is logged in)

Route::get('/dashboard', ['uses' => 'DashboardController@index', 'before' => 'auth', 'as' => 'dashboard']); // Dashboard page

// route to show the login form
Route::get('login', [
    'as' => 'login',
    'uses' => 'UsersController@showLogin',
]);
// route to process the form
Route::post('login', ['uses' => 'UsersController@doLogin']);

// Login using Social networks
Route::get(
    'login/{network}',
    ['as' => 'sociallogin', 'uses' => 'SocialAuthController@SocialLogin']
)->where('network', 'twitter|google|facebook');

// Social login callback
Route::get('login/social/callback', ['as' => 'sociallogincallback', 'uses' => 'SocialAuthController@SocialLoginCallback']);

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

// My account page
Route::get('myaccount', [
    'as' => 'myaccount',
    'uses' => 'UsersController@showMyAccount',
    'before' => 'auth'
]);
Route::post('myaccount', [
    'uses' => 'UsersController@doAccountUpdate',
    'before' => 'auth'
]);

// Terms page
Route::get('terms', ['as' => 'terms', 'uses' => 'UsersController@terms']);

/** --------------------------- HONEYS ------------------------------------ **/

Route::group([
    'prefix' =>'honeys',
    'before' => 'auth'
], function() {
    // Honeys index view
    Route::get('', ['as' => 'honeys', 'uses' => 'HoneyController@index']);

    // Add a Honey as a friend
    Route::get('add', ['as' => 'honeyAdd', 'uses' => 'HoneyController@showAdd']);
    Route::post('add', ['as' => 'honeyAdd', 'uses' => 'HoneyController@doAdd']);

    // Show the requests page
    Route::get('requests', ['as' => 'honeyRequests', 'uses' => 'HoneyController@showRequests']);

    // Accept/Decline requests
    Route::get('requests/{userID}/{response}', ['as' => 'honeys.answer', 'uses' => 'HoneyController@answerRequest'])
        ->where(['response' => 'accept|decline']);

    // Delete a Honey link
    Route::delete('{userID}', ['as' => 'honeyLinkDestroy', 'uses' => 'HoneyController@delete']);
});

/**  -------------------------- QUESTIONS --------------------------------- **/
Route::group([
    'before' => 'auth'
], function() {
    Route::group([
        'prefix' => 'questions',
    ], function() {
        Route::get('{question}/ask', [
            'as' => 'questions.ask',
            'uses' => 'QuestionsController@showAsk'
        ]);
        Route::post('{question}/ask', [
            'as' => 'questions.ask',
            'uses' => 'QuestionsController@doAsk'
        ]);
        // Inbox
        Route::get('inbox', [
            'as' => 'questions.inbox',
            'uses' => 'QuestionsController@showInbox'
        ]);
        // Say Yes/No to a Question
        Route::get('inbox/{questionAsked}/{answer}', [
            'as' => 'questions.answer',
            'uses' => 'QuestionsController@answer'
        ])
            ->where(['answer' => 'yes|no']);

        // /questions/{question}/users/{user} - SHOW information about a given user who has answered a given question
        Route::get('{question}/users/{user}', [
            'as' => 'questions.users.show',
            'uses' => 'QuestionsUsersController@show'
        ]);

        // Show the questions answered page
        Route::get('answered', [
            'as' => 'questions.answered',
            'uses' => 'QuestionsController@showAnswered'
        ]);
    }); // END ROUTE GROUP //

    Route::resource('questions', 'QuestionsController', [
        'except' => [
            'edit',
            'update'
        ]
    ]);
}); // END ROUTE GROUP //
// Show a given Question Asked (useful for social sharing) ANYONE CAN SEE THIS
Route::get('questions/asked/{questionAskedID}', [
    'as' => 'questions.asked.show',
    'uses' => 'QuestionsAskedController@show'
]);