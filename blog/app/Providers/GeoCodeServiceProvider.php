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
        $config = (new GeoCode\Config())->initFromArray(config('services.geo_code'));

        $this->app->singleton(GeoCode\Manager::class, function($app) use ($config) {
            $req = new GeoCode\Http\Guzzle(['base_uri' => $config->apiUrl, 'verify' => false]);
            return new GeoCode\Manager($config, $req, Cache::store($config->cacheDriver));
        });

        $this->app->bind(GeoCode\Response::class, function($app) use ($config) {
            return new GeoCode\Response($config->apiOutput, '');
        });

        $this->app->bind(GeoCode\Request::class, function($app) use ($config) {
            return new GeoCode\Request($config->apiOutput, '');
        });

        $this->app->instance(GeoCode\Config::class, $config);
    }

    public function provides()
    {
        return [
            GeoCode\Manager::class, GeoCode\Response::class,
            GeoCode\Request::class, GeoCode\Config::class
        ];
    }
}
