#Laravel Ajax File Upload

# Installation

Begin by installing this package through Composer:

```
composer require ehel/laravelfileupload
```

Next, add FileUploadServiceProvider to the providers array of config/app.php:

```php
'providers' => [
    '...',
    Ehel\FileUpload\FileUploadServiceProvider::class
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

