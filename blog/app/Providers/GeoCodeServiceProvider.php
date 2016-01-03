<?php namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use App\Services\GeoCode;

class GeoCodeServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GeoCode\Manager::class, function($app) {
            $config = (new GeoCode\Config())->initFromArray(config('services.geo_code'));
            $req = new GeoCode\Http\Guzzle(['base_uri' => $config->apiUrl, 'verify' => false]);
            return new GeoCode\Manager($config, $req, Cache::store($config->cacheDriver));
        });
    }

    public function provides()
    {
        return [GeoCode\Manager::class];
    }
}
