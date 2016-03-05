<?php

return [
    "max_size" => 5242880, // 5 mb
    "path"    => public_path('uploads/'),
    "mimes"   => ['pdf','doc','docx','odf','png','jpg','jpeg'],
    "route_prefix" => 'ehelfileupload',
    "route_name"   => 'upload'
];