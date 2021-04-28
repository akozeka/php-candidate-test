<?php

require_once 'vendor/autoload.php';

use PhpTest\Service\WeatherService;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$zipCode = $argv[1] ?? '';

if (!$zipCode) {
    die('Please specify zipCode as first argument.' . PHP_EOL);
}

$containerBuilder = new ContainerBuilder();
$locator = new FileLocator(__DIR__ . '/config');
$loader = new YamlFileLoader($containerBuilder, $locator);

try {
    $loader->load('services.yaml');
} catch (\Exception $ex) {
    print_r($ex->getMessage() . PHP_EOL);
    die('File services.yaml can\'t be loaded' . PHP_EOL);
}

/** @var WeatherService $weatherService */
$weatherService = $containerBuilder->get('weather.service');
$info = $weatherService->getAverageInfo($zipCode);

print 'City: ' . $zipCode . PHP_EOL;
print 'Temperature: ' . $info->getTemperature() . PHP_EOL;
print 'Wind speed: ' . $info->getWindSpeed() . PHP_EOL;
