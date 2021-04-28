<?php
declare(strict_types=1);

namespace PhpTest\Service;

use PhpTest\Entity\WeatherInfo;
use PhpTest\Provider\WeatherProviderInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * Class WeatherService
 *
 * @author Vladimir Cherednichenko <vovacherednichenko@o-s-i.org>
 */
class WeatherService
{
    /**
     * @var array
     */
    protected $providers = [];

    /**
     * WeatherService constructor.
     *
     * @param ContainerInterface $container
     * @param array              $providers
     */
    public function __construct(ContainerInterface $container, array $providers)
    {
        foreach ($providers as $providerClass) {
            try {
                /** @var WeatherProviderInterface $provider */
                $provider = $container->get($providerClass);

                if ($provider instanceof WeatherProviderInterface) {
                    $this->providers[] = $provider;
                }
            } catch (ServiceNotFoundException $exception) {
                // do nothing
            }
        }
    }

    /**
     * @param string $city
     *
     * @return WeatherInfo
     */
    public function getAverageInfo(string $city): WeatherInfo
    {
        // TODO: check all registered providers and return WeatherInfo with average values.

        return $this->providers[0]->getInfo($city);
    }
}
