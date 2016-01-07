<?php

namespace App\Services\GeoCode;

use App\Services\GeoCode\Http\RequestContract as HttpRequest;
use Illuminate\Cache\Repository as Cache;

class Manager
{
    protected $config;
    protected $httpRequest;
    protected $cache;


    public function __construct(Config $config, HttpRequest $request, Cache $cache)
    {
        $this->config = $config;
        $this->httpRequest = $request;
        $this->cache = $cache;
    }


    public function sendRequest(Request $request)
    {
        $query = $request->getRequestString();

        $cacheKey = md5(self::class . $this->config->apiOutput . $query);

        if ($this->cache->has($cacheKey)) {
            $result = $this->cache->get($cacheKey);
        } else {
            $result = $this->httpRequest->sendRequest($this->config->apiOutput, $query);
            if (! empty($result)) {
                $this->cache->put($cacheKey, $result, $this->config->cacheTime);
            }
        }

        return $this->getResponse($result);
    }

    /**
     * @param $resultStr
     * @return Response
     */
    protected function getResponse($resultStr)
    {
        /**
         * @var Response
         */
        return app(Response::class)->setResponseString($resultStr);
    }

}
