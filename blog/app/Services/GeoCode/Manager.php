<?php

namespace App\Services\GeoCode;

use App\Services\GeoCode\Http\Request as HttpRequest;
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
        $reqArr = ['language' => $request->language, 'key' => $this->config->apiKey];

        if ($request->isReverse()) {
            $reqArr['latlng'] = $request->latitude . ',' . $request->longitude;
        } else {
            $reqArr['address'] = $request->address;
        }

        $query = http_build_query($reqArr);
        $cacheKey = md5($query);

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
        return new Response($this->config->apiOutput, $resultStr);
    }

}
