<?php

namespace App\Services\GeoCode\Query;

use App\Services\GeoCode\Query;
use Exception;

class ReverseGeocoding extends Query
{
    protected $latitude = 0;
    protected $longitude = 0;
    protected $placeId = 0;

    /**
     * @param numeric $latitude
     * @param numeric $longitude
     * @return $this
     * @throws Exception
     */
    public function setLatLong($latitude, $longitude)
    {
        if (! is_numeric($latitude) || ! is_numeric($longitude)) {
            throw new Exception('params must be an numeric type');
        }

        $this->latitude = $latitude;
        $this->longitude = $longitude;

        $this->placeId = 0;

        return $this;
    }

    /**
     * @param string $placeId
     * @return $this
     */
    public function setPlaceId($placeId)
    {
        $this->placeId = $placeId;
        $this->latitude = 0;
        $this->longitude = 0;

        return $this;
    }

    /**
     * @return array
     * @throws Exception
     */
    protected function getSpecificRequestInfo()
    {
        if (empty($this->placeId)
            && (empty($this->latitude || empty($this->longitude)))
        ) {
            throw new Exception('Set lattitude and longitude or placeId');
        }

        $res = [];

        if (! empty($this->longitude) && ! empty($this->latitude)) {
            $res['latlng'] = $this->latitude . ',' . $this->longitude;
        } else {
            $res['place_id'] = $this->placeId;
        }

        return $res;
    }

}