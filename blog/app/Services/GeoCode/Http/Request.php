<?php

namespace App\Services\GeoCode\Http;

use GuzzleHttp\Client;

abstract class Request extends Client
{
    /**
     *
     * @param string $ouput
     * @param string $requestStr
     * @return string
     */
    abstract public function sendRequest($output, $requestStr);
}