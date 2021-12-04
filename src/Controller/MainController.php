<?php

namespace App\Controller;

use App\Service\LocationByIpService;
use App\Service\WeatherForecastService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{

    public function index(WeatherForecastService $forecast): Response
    {
        return $this->render('base.html.twig', ['forecast' => $forecast->weatherForecast()]);
    }

    public function refresh(LocationByIpService $locationByIp)
    {

        $locationByIp->refreshLocation();
        return $this->redirect('/');
    }

}