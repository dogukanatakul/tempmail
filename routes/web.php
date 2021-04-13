<?php
Route::middleware(['language'])->group(function () {
    Route::get('/', 'MailController@index')->name("index");
    Route::get('/view/{uuid}', 'MailController@view')->name("view");
    Route::get('/new', 'MailController@newMail')->name("new_mail");
    Route::get('/refreshStatus', 'MailController@refreshStatus')->name("refreshStatus");
    Route::get('/bot2516', 'MailController@bot');
    Route::get('/get/{mail}', 'MailController@get');
});
Route::group([
    'prefix' => 'api',
    'as' => 'api.',
//    'namespace' => 'Appointment'
], function () {
    Route::get('/twitter/login', 'ApiController@login')->name("login");
    Route::get('/twitter/{mail}', 'ApiController@twitter')->name("twitter");
});
