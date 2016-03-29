<?php


Route::group(['middleware' => ['web'],'prefix' => config('fileupload.route_prefix')], function () {
    Route::post(config('fileupload.route_name'), 'Ehel\FileUpload\Http\UploadController@store');
    Route::delete(config('fileupload.route_name'), 'Ehel\FileUpload\Http\UploadController@destroy');

});