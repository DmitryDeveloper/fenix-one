<?php

namespace App\Services;

use GuzzleHttp;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class GuzzleService
 * @package App\Services
 */
class GuzzleService
{
    /**
     * Describing the timeout of the request in seconds.
     */
    protected const REQUEST_TIMEOUT = 5.0;

    /**
     * @param  string  $url
     * @param  array  $options
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public static function get(string $url, array $options = []): ResponseInterface
    {
        try {
            $client = new Client(['timeout' => self::REQUEST_TIMEOUT]);
            return self::decode($client->get($url, $options));
        } catch (GuzzleException $exception) {
            $exception->getMessage();
        }
    }

    /**
     * @param  string  $url
     * @param  array  $options
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public static function post(string $url, array $options = []): ResponseInterface
    {
        try {
            $client = new Client(['timeout' => self::REQUEST_TIMEOUT]);
            return self::decode($client->post($url, $options));
        } catch (GuzzleException $exception) {
            $exception->getMessage();
        }
    }

    /**
     * @param $var
     * @return mixed
     */
    public static function decode($var)
    {
        return GuzzleHttp\json_decode($var, true);
    }
}
