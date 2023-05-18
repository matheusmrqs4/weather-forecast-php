<?php

use App\WebService\OpenWeatherMap;

require __DIR__ . '/vendor/autoload.php';

$obOpenWeatherMap = new OpenWeatherMap("e6d48f71c61b5154608d57daac061c3b");

if (!isset($argv[3])) {
    die('Os dados precisam ser preenchidos!');
}

$city = $argv[1];
$stateCode = $argv[2];
$countryCode = $argv[3];

$forecastData = $obOpenWeatherMap->accessWeatherForecast($city, $stateCode, $countryCode);

echo 'Cidade: ' . $city . '/' . $stateCode . '-' . $countryCode . "\n";

foreach ($forecastData['list'] as $forecast) {
    $output = [
        $forecast['dt_txt'],
        $forecast['main']['temp'],
        $forecast['main']['feels_like'],
        $forecast['weather'][0]['description']
    ];

    echo implode(' | ', $output) . "\n";
}
