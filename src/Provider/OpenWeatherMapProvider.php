<?php
declare(strict_types=1);

namespace PhpTest\Provider;

use PhpTest\Entity\WeatherInfo;
use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\Exception as OWMException;
use Http\Factory\Guzzle\RequestFactory;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

/**
 * Class OpenWeatherMapProvider
 *
 * @author Oleksii Kozeka <kozeka.alex@gmail.com>
 */
class OpenWeatherMapProvider implements WeatherProviderInterface
{
    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var OpenWeatherMap
     */
    protected $client;

    /**
     * OpenWeatherMapProvider constructor.
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;

        $httpRequestFactory = new RequestFactory();
        $httpClient = GuzzleAdapter::createWithConfig([]);

        $this->client = new OpenWeatherMap($this->apiKey, $httpClient, $httpRequestFactory);
    }

    /**
     * @param string $city
     * @return WeatherInfo
     * @throws OWMException
     */
    public function getInfo(string $city): WeatherInfo
    {
        $weather = $this->client->getWeather($city, 'metric');

        return new WeatherInfo(
            $weather->temperature->now->getValue(),
            $weather->wind->speed->getValue()
        );
    }
}
