<?php

namespace Ehel\FileUpload;

use Illuminate\Support\ServiceProvider;

class FileUploadServiceProvider extends ServiceProvider
{


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

        $this->publishes([
            __DIR__.'/config/config.php' => config_path('fileupload.php'),
        ]);
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
        $this->app->singleton(FileUpload::class, function ($app) {
            return new FileUpload('foo');
        });
    }
}
