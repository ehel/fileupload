<?php

return [
    /*
|--------------------------------------------------------------------------
| Route Settings
|--------------------------------------------------------------------------
|Here you can set up your file upload routes.
|
*/
    "route_prefix" => 'ehelfileupload',
    "route_name"   => 'upload',
    /*
|--------------------------------------------------------------------------
| File Validation and directory.
|--------------------------------------------------------------------------
|Here you can select file size, file extension and directory.
|
*/
    "max_size" => 5242880, // 5 mb
    "path"    => 'uploads/',
    "mimes"   => ['pdf','doc','docx','odf','png','jpg','jpeg'],



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