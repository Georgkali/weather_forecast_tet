<?php

namespace App\Service;

use Symfony\Component\Cache\Adapter\DoctrineDbalAdapter;
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

    public function __construct(HttpClientInterface $client, UserIpService $userIp)
    {
        $this->client = $client;
        $this->userIp = $userIp;

    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getLocation()
    {
        $cache = new DoctrineDbalAdapter($_ENV['DATABASE_URL']);
        $apiKey = $_ENV['LOCATION_API_KEY'];
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