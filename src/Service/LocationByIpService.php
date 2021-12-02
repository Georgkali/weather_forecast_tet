<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class LocationByIpService
{
    /**
     * @var HttpClientInterface
     */
    private $client;
    /**
     * @var UserIpService
     */
    private $userIp;
    /**
     * @var ContainerBagInterface
     */
    private $containerBag;

    public function __construct(HttpClientInterface $client, UserIpService $userIp, ContainerBagInterface $containerBag)
    {
        $this->client = $client;
        $this->userIp = $userIp;
        $this->containerBag = $containerBag;
    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getLocation()
    {
        $apiKey = $this->containerBag->get('app.location_api_key');
        $ip = $this->userIp->getIp();
        $ApiCall = "http://api.ipstack.com/$ip?access_key=$apiKey";
        return $this->client->request('GET', $ApiCall);
    }

}