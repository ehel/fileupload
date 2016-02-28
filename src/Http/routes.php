<?php


Route::group(['middleware' => ['web'],['prefix' => 'ehelfileupload']], function () {
 //TODO
    Route::resource('upload', 'Ehel\FileUpload\Http\UploadController', ['only' => [
        'store', 'destroy'
    ]]);
});