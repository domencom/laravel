<?php

namespace App\Services\GeoCode;

use Exception;

class Response
{
    /**
     * @var string
     */
    protected $response;

    /**
     * @var string
     */
    protected $outputType;

    const TO_JSON = 'json';
    const TO_XML = 'xml';
    const TO_ARRAY = 'array';

    const API_OUTPUT_JSON = 'json';
    const API_OUTPUT_XML = 'xml';

    /**
     * Response constructor.
     *
     * @param string $output GeoCode API output type in request
     * @param string $response GeoCode API response string
     */
    public function __construct($output, $response = '')
    {
        $this->response = $response;
        $this->outputType = strtolower($output);
    }

    public function setResponseString($response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     *
     * @return null | \stdClass
     * @throws Exception
     */
    public function toJson()
    {
        $this->check();

        if (empty($this->response)) {
            return null;
        }

        if ($this->outputType === self::API_OUTPUT_JSON) {
            return $this->response;
        } else {
            throw new Exception (
                "Converting from {$this->outputType} to json not implemented"
            );
        }
    }

    /**
     * @throws Exception
     */
    public function toArray()
    {
        throw new Exception('not implemented');
    }

    /**
     * @throws Exception
     */
    public function toXml()
    {
        throw new Exception('not implemented');
    }

    /**
     *
     * @return boolean
     * @throws Exception
     */
    protected function check()
    {
        if (! in_array($this->outputType, [self::API_OUTPUT_JSON, self::API_OUTPUT_XML])) {
            throw new Exception(
                "Incorrect or not implemented geocode api output '{$this->outputType}' "
            );
        }
    }
}
