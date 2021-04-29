<?php
declare(strict_types=1);

namespace PhpTest\Provider;

use PhpTest\Entity\WeatherInfo;
use Attogram\Weatherbit\Weatherbit;

/**
 * Class WeatherBitProvider
 *
 * @author Oleksii Kozeka <kozeka.alex@gmail.com>
 */
class WeatherBitProvider implements WeatherProviderInterface
{
    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var Weatherbit
     */
    protected $client;

    /**
     * WeatherBitProvider constructor.
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;

        $this->client = new Weatherbit();
        $this->client->setKey($apiKey);

    }

    /**
     * @param string $city
     * @return WeatherInfo
     *@throws \Attogram\Weatherbit\WeatherbitException
     */
    public function getInfo(string $city): WeatherInfo
    {
        $this->client->setLocationByCity($city);

        $currentWeather = $this->client->getCurrent();

        return new WeatherInfo(
            (float)$currentWeather['data'][0]['temp'],
            (float)$currentWeather['data'][0]['wind_spd']
        );
    }
}
