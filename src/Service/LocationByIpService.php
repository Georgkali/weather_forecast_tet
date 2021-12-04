<?php

namespace App\Service;

use Symfony\Component\Cache\Adapter\DoctrineDbalAdapter;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Contracts\Cache\CacheInterface;
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
    /**
     * @var CacheInterface
     */
    private $cache;

    public function __construct(HttpClientInterface $client, UserIpService $userIp, ContainerBagInterface $containerBag, CacheInterface $cache)
    {
        $this->client = $client;
        $this->userIp = $userIp;
        $this->containerBag = $containerBag;
        $this->cache = $cache;
    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getLocation()
    {
        $cache = new DoctrineDbalAdapter($_ENV['DATABASE_URL']);
        $apiKey = $this->containerBag->get('app.location_api_key');
        $ip = $this->userIp->getIp();
        $ApiCall = "http://api.ipstack.com/$ip?access_key=$apiKey";
        return $cache->get('city_'.$ip, function () use ($ApiCall){
            return json_decode($this->client->request('GET', $ApiCall)->getContent(), 1)['city'];
        });

    }
    public function refreshLocation() {
        $cache = new DoctrineDbalAdapter($_ENV['DATABASE_URL']);
        $ip = $this->userIp->getIp();
        $cache->delete('city_'.$ip);
    }

}