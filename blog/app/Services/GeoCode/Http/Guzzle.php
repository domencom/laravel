<?php

namespace App\Services\GeoCode\Http;

class Guzzle extends Request
{

    public function sendRequest($output, $requestStr)
    {
        $result = $this->get($output, ['query' => $requestStr]);
        return $result->getBody()->getContents();
    }
}
