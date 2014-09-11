<?php

namespace Smoya\Component\Omniata;

use Smoya\Component\Omniata\Exception\ClientException;

/**
 * This is a lightweight implementation of a curl client for the Omniata HTTP API
 *
 * @author Sergio Moya <smoya89@gmail.com>
 */
class Client
{
    /**
     * @var string
     */
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param int   $baseUrl
     * @param int   $uid
     * @param array $parameters
     * @param int   $timeout Time in ms
     * @return string The response content
     * @throws Exception\ClientException
     */
    public function doGet($baseUrl, $uid, array $parameters, $timeout = null)
    {
        $parameters['api_key'] = $this->apiKey;
        $parameters['uid'] = $uid;

        $url = $this->getEndPoint($baseUrl, $parameters);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (null !== $timeout) {
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, $timeout);
        }

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }

    /**
     * @param string $baseUrl
     * @param array  $parameters
     * @return string
     */
    private function getEndPoint($baseUrl, array $parameters)
    {
        array_walk(
            $parameters,
            function (&$value, $key) {
                $value = $key . '=' . urlencode($value);
            }
        );

        $url = $baseUrl . '?' . implode('&', $parameters);

        return $url;
    }
}
