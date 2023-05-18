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

$weatherData = $obOpenWeatherMap->accessCurrentWeather($city, $stateCode, $countryCode);

echo 'Cidade: ' . $city . '/' . $stateCode . '-' . $countryCode . "\n";

echo 'Temperatura: ' . ($weatherData['main']['temp'] ?? 'Desconhecido') . "\n";
echo 'Sensação Térmica: ' . ($weatherData['main']['feels_like'] ?? 'Desconhecido') . "\n";

echo 'Temperatura Miníma: ' . ($weatherData['main']['temp_min'] ?? 'Desconhecido') . "\n";
echo 'Temperatura Máxima: ' . ($weatherData['main']['temp_max'] ?? 'Desconhecido') . "\n";

echo 'Clima: ' . ($weatherData['weather'][0]['description'] ?? 'Desconhecido') . "\n";
