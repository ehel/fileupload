#Laravel Ajax File Upload

# Installation

1. Begin by installing this package through Composer:

```
composer require ehel/laravelfileupload
```

2. Add FileUploadServiceProvider to the providers array of config/app.php:

```php
'providers' => [
    '...',
    Ehel\FileUpload\FileUploadServiceProvider::class
];
```

3.  Add class alias to the aliases array of config/app.php:

```php
  'aliases' => [
    // ...
      'FileUpload' => Ehel\FileUpload\FileUploadFacade::class
    // ...
  ],
```

4. Run :

```
php artisan vendor:publish
```

