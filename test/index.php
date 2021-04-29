<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use PhpTest\Service\WeatherService;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$city = $argv[1] ?? $_GET['city'] ?? '';

if (empty($city)) {
    die('Please specify city as first argument.' . PHP_EOL);
}

$containerBuilder = new ContainerBuilder();
$locator = new FileLocator(__DIR__ . '/config');
$loader = new YamlFileLoader($containerBuilder, $locator);

try {
    $loader->load('services.yaml');
} catch (Exception $ex) {
    print_r($ex->getMessage() . PHP_EOL);
    die("File services.yaml can't be loaded" . PHP_EOL);
}

/** @var WeatherService $weatherService */
$weatherService = $containerBuilder->get('weather.service');

try {
    $info = $weatherService->getAverageInfo($city);

    print "City: {$city}" . PHP_EOL;
    print "Temperature: {$info->getTemperature()}" . PHP_EOL;
    print "Wind speed: {$info->getWindSpeed()}" . PHP_EOL;
} catch (Exception $e) {
    print "Exception while getting weather info: {$e->getMessage()} (Code {$e->getCode()})";
}
