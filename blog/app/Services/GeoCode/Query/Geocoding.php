<?php

namespace App\Services\GeoCode\Query;

use App\Services\GeoCode\Query;
use Exception;

class Geocoding extends Query
{
    protected $address = '';
    protected $bounds = array();
    protected $components = array();
    protected $region = '';

    /**
     * @param $address
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * Setting bounds info - boundig box coords
     *
     * should be array like [[34.54, -118.23], [34.236,-118.50]]
     *
     * @param array $bounds
     * @return $this
     * @throws Exception
     */
    public function setBounds(array $bounds)
    {
        if (empty($bounds)
            || count($bounds) != 2
            || ! is_array($bounds[0])
            || ! is_array($bounds[1])
            || count($bounds[0]) != 2
            || count($bounds[1]) != 2
        ) {
            throw new Exception('bounds param incorrect');
        }

        $this->bounds = $bounds;
        return $this;
    }

    /**
     * @param string | array $region
     * @return $this
     */
    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    /**
     * Adding component info to components array
     * @param $name
     * @param $val
     * @throws Exception
     * @return $this
     */
    public function addComponent($name, $val)
    {
        if (empty($name) || empty($val)) {
            throw new Exception('Params could not be empty');
        }

        $this->components[$name] = $val;
        return $this;
    }

    /**
     * @return array
     * @throws Exception
     */
    protected function getSpecificRequestInfo()
    {
        $res = [];

        if (empty($this->address) && empty($this->components)) {
            throw new Exception('Params "address" or "components" are reqired');
        }

        if (! empty($this->address)) {
            $res['address'] = $this->address;
        }

        if ($compStr = $this->getComponentsString()) {
            $res['components'] = $compStr;
        }

        if (! empty($this->region)) {
            $res['region'] = $this->region;
        }

        if ($boundsStr = $this->getBoundsString()) {
            $res['bounds'] = $boundsStr;
        }

        return $res;
    }

    /**
     * @return string
     */
    public function getComponentsString()
    {
        if (! empty($this->components)) {
            $components = [];
            foreach ($this->components as $name => $val) {
                $components[] = $name . ':' . $val;
            }

            return implode('|', $components);
        }

        return '';
    }

    /**
     * @return string
     */
    public function getBoundsString()
    {
        if (! empty($this->bounds)) {
            return implode(',', $this->bounds[0]) . '|' . implode(',', $this->bounds[1]);
        }

        return '';
    }
}
