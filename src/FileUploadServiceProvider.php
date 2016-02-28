<?php

namespace Ehel\FileUpload;

use Illuminate\Support\ServiceProvider;

class FileUploadServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/Http/routes.php';
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFileUploader();
    }

    /**
     * Register the File uploader instance
     * @return void
     */
    protected function registerFileUploader()
    {
        $this->app->singleton('fileUpload', function ($app) {
            return new FileUpload($app['path']);
        });
    }
}
