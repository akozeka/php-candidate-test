<?php
declare(strict_types=1);

namespace PhpTest\Provider;

use PhpTest\Entity\WeatherInfo;

/**
 * Class RandomInfoProvider
 *
 * @author Vladimir Cherednichenko <vovacherednichenko@o-s-i.org>
 */
class RandomInfoProvider implements WeatherProviderInterface
{
    /**
     * @var int
     */
    protected $minTemperature;

    /**
     * @var int
     */
    protected $maxTemperature;

    /**
     * @var int
     */
    protected $minWindSpeed;

    /**
     * @var int
     */
    protected $maxWindSpeed;

    /**
     * RandomInfoProvider constructor.
     *
     * @param int $minTemperature
     * @param int $maxTemperature
     * @param int $minWindSpeed
     * @param int $maxWindSpeed
     */
    public function __construct(int $minTemperature, int $maxTemperature, int $minWindSpeed, int $maxWindSpeed)
    {
        $this->minTemperature = $minTemperature;
        $this->maxTemperature = $maxTemperature;
        $this->minWindSpeed = $minWindSpeed;
        $this->maxWindSpeed = $maxWindSpeed;
    }

    /**
     * @param string $zipCode
     *
     * @return WeatherInfo
     */
    public function getInfo(string $zipCode): WeatherInfo
    {
        return new WeatherInfo(
            rand($this->minTemperature, $this->maxTemperature),
            rand($this->minWindSpeed, $this->maxWindSpeed)
        );
    }
}
