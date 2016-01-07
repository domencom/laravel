<?php

namespace App\Services\GeoCode\Http;

use GuzzleHttp\Client;

class Guzzle extends Client implements RequestContract
{

    public function sendRequest($output, $requestStr)
    {
        $result = $this->get($output, ['query' => $requestStr]);
        return $result->getBody()->getContents();
    }
}
