<?php

//TODO toke
// 'middleware' => ['web'],
//Todo Routes Refactoring
Route::group(['prefix' => 'ehelfileupload'], function () {
 //TODO
    Route::resource('upload', 'Ehel\FileUpload\Http\UploadController', ['only' => [
        'store', 'destroy'
    ]]);

});