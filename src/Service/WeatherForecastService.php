<?php

namespace App\Service;

use App\Repository\ForecastRepositoryInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherForecastService
{

    /**
     * @var LocationByIpService
     */
    private $locationByIp;
    /**
     * @var ForecastRepositoryInterface
     */
    private $forecastRepository;


    public function __construct(LocationByIpService $locationByIp, ForecastRepositoryInterface $forecastRepository)
    {
        $this->locationByIp = $locationByIp;
        $this->forecastRepository = $forecastRepository;
    }

    public function weatherForecast()
    {
        $city = $this->locationByIp->getLocation();
        return $this->forecastRepository->getForecast($city);
    }
}