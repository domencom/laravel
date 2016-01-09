<?php

namespace App\Services\GeoCode;

use Exception;

abstract class Query
{

    protected $language = 'en';

    public function __get($name)
    {
        if (isset($this->{$name})) {
            return $this->{$name};
        } else {
            throw new Exception("Param {$name} does not exists");
        }
    }


    public function setLanguage($lang)
    {
        $this->language = $lang;
        return $this;
    }


    public function getRequestString()
    {
        $config = app(Config::class);

        $reqArr = ['language' => $this->language, 'key' => $config->apiKey];
        $reqArr = array_merge($reqArr, $this->getSpecificRequestInfo());

        return http_build_query($reqArr);
    }

    /**
     * array of request params for specific Request class implementation
     * @return array
     */
    abstract protected function getSpecificRequestInfo();
}
