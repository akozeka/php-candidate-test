<?php
declare(strict_types=1);

namespace PhpTest\Entity;

/**
 * Class WeatherInfo
 *
 * @author Vladimir Cherednichenko <vovacherednichenko@o-s-i.org>
 */
class WeatherInfo
{
    /**
     * @var float
     */
    protected $temperature;

    /**
     * @var float
     */
    protected $windSpeed;

    /**
     * WeatherInfo constructor.
     *
     * @param float $temperature
     * @param float $windSpeed
     */
    public function __construct(float $temperature = 0.0, float $windSpeed = 0.0)
    {
        $this->temperature = $temperature;
        $this->windSpeed = $windSpeed;
    }

    /**
     * @return float
     */
    public function getTemperature(): float
    {
        return $this->temperature;
    }

    /**
     * @param float $temperature
     */
    public function setTemperature(float $temperature)
    {
        $this->temperature = $temperature;
    }

    /**
     * @return float
     */
    public function getWindSpeed(): float
    {
        return $this->windSpeed;
    }

    /**
     * @param float $windSpeed
     */
    public function setWindSpeed(float $windSpeed)
    {
        $this->windSpeed = $windSpeed;
    }
}