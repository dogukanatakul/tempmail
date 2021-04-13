<?php
Route::middleware(['language'])->group(function () {
    Route::get('/', 'MailController@index')->name("index");
    Route::get('/view/{uuid}', 'MailController@view')->name("view");
    Route::get('/new', 'MailController@newMail')->name("new_mail");
    Route::get('/refreshStatus', 'MailController@refreshStatus')->name("refreshStatus");
    Route::get('/get/{mail}', 'MailController@get');
});