<?php

namespace App\Services\GeoCode;

use Exception;

/**
 * Class Config
 * @package App\Services\GeoCode
 * @param string $apiUrl
 */
class Config
{

    protected $params = [
        'apiKey' => array('required' => true, 'value' => ''),
        'apiUrl' => array('required' => true, 'value' => ''),
        'apiOutput' => array('required' => true, 'value' => ''),
        'cacheDriver' => array('required' => true, 'value' => ''),
        'cacheTime' => array('required' => true, 'value' => ''),
    ];

    public function __get($name)
    {
        if (array_key_exists($name, $this->params)) {
            if (! empty($this->params[$name]['value'])) {
                return $this->params[$name]['value'];
            } elseif ($this->params[$name]['required']) {
                throw new Exception("Param {$name} is required but not set");
            }
        }
    }

    /**
     * @param $name
     * @param $value
     * @throws Exception
     */
    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->params)) {
            $this->params[$name]['value'] = $value;
        } else {
            throw new Exception("Can't set parameter with name {$name}");
        }
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $res = [];

        array_walk($this->params, function($val, $key) use (&$res) {
            $res[$key] = $val['value'];
        });

        return $res;
    }

    /**
     *
     * @param array $data
     */
    public function initFromArray(array $data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }

        return $this;
    }
}
