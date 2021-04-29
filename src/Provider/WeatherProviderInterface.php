<?php
declare(strict_types=1);

namespace PhpTest\Provider;

use PhpTest\Entity\WeatherInfo;

/**
 * Interface ProviderInterface
 *
 * @author Vladimir Cherednichenko <vovacherednichenko@o-s-i.org>
 */
interface WeatherProviderInterface
{
    /**
     * @param string $city
     *
     * @return WeatherInfo
     */
    public function getInfo(string $city): WeatherInfo;
}
