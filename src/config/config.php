<?php

return [
    "max_size" => 5242880, // 5 mb
    "path"    => 'uploads/',
    "mimes"   => ['pdf','doc','docx','odf','png','jpg','jpeg'],
    "route_prefix" => 'ehelfileupload',
    "route_name"   => 'upload',
    "ajaxUploadFail"   => 'console.log("Ajax Upload Error");',
    "ajaxDeleteFail"   => 'console.log("Ajax Delete Error");',
    /*
|--------------------------------------------------------------------------
| Rewrite File
|--------------------------------------------------------------------------
|Set to true if you want to rewrite existing file
|or set to false if you want to store the new file
|without delete existing (on re-upload).
|
*/
    "rewrite_file" => true
];