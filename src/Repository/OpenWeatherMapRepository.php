<?php

namespace App\Repository;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class OpenWeatherMapRepository implements ForecastRepositoryInterface
{
    /**
     * @var HttpClientInterface
     */
    private $client;

    public function __construct(HttpClientInterface $client)
    {

        $this->client = $client;
    }

    public function getForecast(string $city)
    {
        $apiKey = $_ENV['WEATHER_API_KEY'];
        $apiCall = "https://api.openweathermap.org/data/2.5/weather?q=$city&units=metric&appid=$apiKey";
        return $this->client->request('GET', $apiCall)->getContent();
    }
}