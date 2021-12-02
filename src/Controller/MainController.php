<?php

namespace App\Controller;

use App\Service\WeatherForecastService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{

    public function index(WeatherForecastService $forecast): Response
    {
        return new Response($forecast->weatherForecast());
    }
}