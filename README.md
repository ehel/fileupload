#Laravel Ajax File Upload

## Installation

Begin by installing this package through Composer:

```
composer require ehel/laravelfileupload
```

Next, add FileUploadServiceProvider to the providers array of config/app.php:

```php
'providers' => [
    //...
    Ehel\FileUpload\FileUploadServiceProvider::class,
    //...
];
```

Next, add class alias to the aliases array of config/app.php:

```php
  'aliases' => [
    // ...
      'FileUpload' => Ehel\FileUpload\FileUploadFacade::class
    // ...
  ],
```

Finnaly, run :

```
php artisan vendor:publish
```

## Usage
###Step 1: Generate Buttons
```php
{!!FileUpload::buttons($uploadDirectory, $className) !!}
```
###Step 2: Generate Script
```php
{!!FileUpload::script($uploadSuccess, $uploadFail, $deleteSuccess, $deleteFail) !!}
```
##Config
    "max_size" - Maximum file size.

##Example
```html
<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="bootstrap.min.css" rel="stylesheet"">     
    </head>
    <body>
        <div class="container">
                {!!FileUpload::buttons('photos','uploadButtons') !!}
        </div>
    </body>
    <script src="jquery-2.2.1.js"></script>
    <script>$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        {!!FileUpload::script('console.log("Success");','console.log("Error");', 'console.log("Deleted");', 'console.log("Can\'t delete");') !!}
    </script>
</html>
```