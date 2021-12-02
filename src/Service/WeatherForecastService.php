<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherForecastService
{
    /**
     * @var HttpClientInterface
     */
    private $client;
    /**
     * @var LocationByIpService
     */
    private $locationByIp;
    /**
     * @var ContainerBagInterface
     */
    private $containerBag;

    public function __construct(HttpClientInterface $client, LocationByIpService $locationByIp, ContainerBagInterface $containerBag)
    {
        $this->client = $client;
        $this->locationByIp = $locationByIp;
        $this->containerBag = $containerBag;
    }

    public function weatherForecast()
    {
        $apiKey = $this->containerBag->get('app.weather_api_key');
        $city = (json_decode($this->locationByIp->getLocation()->getContent(), 1))['city'];
        $apiCall = "https://api.openweathermap.org/data/2.5/weather?q=$city&units=metric&appid=$apiKey";
        return $this->client->request('GET', $apiCall)->getContent();
    }
}