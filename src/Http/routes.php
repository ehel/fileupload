<?php

//TODO token
// 'middleware' => ['web'],
Route::group(['prefix' => 'ehelfileupload'], function () {
    Route::post('upload', 'Ehel\FileUpload\Http\UploadController@store');
    Route::delete('upload', 'Ehel\FileUpload\Http\UploadController@destroy');

});