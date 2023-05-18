<?php

namespace App\WebService;

class OpenWeatherMap
{
    /**
     * API Base URL
     * @var string
     */
    public const BASE_URL = 'http://api.openweathermap.org';

    /**
     * API access Key
     *
     * @var string
     */
    private $apiKey;

    /**
     * Sets the API key
     *
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Access the current weather
     *
     * @param string $city
     * @param string $stateCode
     * @param string $countryCode
     * @return array
     */
    public function accessCurrentWeather($city, $stateCode, $countryCode)
    {
        return $this->get('/data/2.5/weather', [
            'q' => $city . ', ' . $stateCode . ', ' . $countryCode
        ]);
    }

    /**
     * Access the weather forecast
     *
     * @param string $city
     * @param string $stateCode
     * @param string $countryCode
     * @return array
     */
    public function accessWeatherForecast($city, $stateCode, $countryCode)
    {
        return $this->get('/data/2.5/forecast', [
            'q' => $city . ', ' . $stateCode . ', ' . $countryCode
        ]);
    }


    /**
     * Exec GET on API
     *
     * @param string $resource
     * @param array $params
     * @return array
     */
    private function get($resource, $params = [])
    {
        $params['units'] = 'metric';
        $params['lang'] = 'pt_br';
        $params['appid'] = $this->apiKey;

        $endpoint = self::BASE_URL . $resource . '?' . http_build_query($params);

        $cr = curl_init();

        curl_setopt($cr, CURLOPT_URL, $endpoint);
        curl_setopt($cr, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cr, CURLOPT_CUSTOMREQUEST, "GET");

        $response = curl_exec($cr);

        curl_close($cr);

        return json_decode($response, true);
    }
}
