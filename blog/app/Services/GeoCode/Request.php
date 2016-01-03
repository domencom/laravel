<?php

namespace App\Services\GeoCode;

use Exception;

class Request
{
    protected $address = '';
    protected $language = 'en';
    protected $reverse = false;
    protected $latitude = 0;
    protected $longitude = 0;

    public function setAddress($address)
    {
        $this->address = $address;
        $this->reverse = false;

        return $this;
    }

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

    public function isReverse()
    {
        return $this->reverse;
    }

    public function setLatLong($latitude, $longitude)
    {
        if (! is_numeric($latitude) || ! is_numeric($longitude)) {
            throw new Exception('params must be an numeric type');
        }

        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->reverse = true;

        return $this;
    }

    public function toArray()
    {
        if ($this->isReverse()) {
            return [
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'language' => $this->language
            ];
        } else {
            return [
                'address' => $this->address,
                'language' => $this->language
            ];
        }
    }
}