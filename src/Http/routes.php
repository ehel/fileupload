<?php

//TODO toke
// 'middleware' => ['web'],

Route::group(['prefix' => 'ehelfileupload'], function () {
 //TODO
    Route::resource('upload', 'Ehel\FileUpload\Http\UploadController', ['only' => [
        'store', 'destroy'
    ]]);
});