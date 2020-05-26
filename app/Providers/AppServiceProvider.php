<?php

namespace App\Providers;

use Aws\S3\S3Client;
use Aws\S3\StreamWrapper;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(255);

        // Register an s3 StreamWrapper for getting cached images
        $options = [
            'credentials' => [
                'key' => config('filesystems.disks.s3.key'),
                'secret' => config('filesystems.disks.s3.secret')
            ],
            'endpoint' => config('filesystems.disks.s3.url'),
            'region' => config('filesystems.disks.s3.region'),
            'version' => '2006-03-01'
        ];
        StreamWrapper::register(new S3Client($options), 's3');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
