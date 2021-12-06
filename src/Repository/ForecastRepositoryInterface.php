<?php

namespace App\Repository;

use Symfony\Contracts\HttpClient\HttpClientInterface;

interface ForecastRepositoryInterface
{

    public function getForecast(string $city);

}