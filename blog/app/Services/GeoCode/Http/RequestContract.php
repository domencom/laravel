<?php

namespace App\Services\GeoCode\Http;

interface RequestContract
{
    /**
     *
     * @param string $ouput
     * @param string $requestStr
     * @return string
     */
    public function sendRequest($output, $requestStr);
}
