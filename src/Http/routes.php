<?php


Route::group(['middleware' => ['web'],['prefix' => 'ehelfileupload']], function () {
 //TODO
    Route::resource('upload', 'UploadController', ['only' => [
        'store', 'destroy'
    ]]);
});