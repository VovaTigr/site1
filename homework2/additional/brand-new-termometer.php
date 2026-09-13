<?php

$ipApiUrl = "https://ipapi.co/json/";
$ipResponse = file_get_contents($ipApiUrl);

$ipData = json_decode($ipResponse, true);
$lat = $ipData['latitude'] ?? null;
$lon = $ipData['longitude'] ?? null;

$apiKey = "f66280bed15ede06a64f3127fb668a15";

$url = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=$apiKey&units=metric&lang=en";

$response = @file_get_contents($url);
if ($response !== false) {
    // Декодируем JSON в ассоциативный массив
    $data = json_decode($response, true); 

    $temp = round($data['main']['temp']);
    $weather = $data['weather'][0]['main'];
    $emoji = "";
    if ($weather == 'Rain') {
        $weather = 'Raining';
        $emoji = '🌧️';
    } elseif ($weather == 'Fog') {
        $weather = 'Foggy';
        $emoji = '🌫️';
    } elseif ($weather == 'Clouds') {
        $weather = 'Cloudy';
        $emoji = '☁️';
    } elseif ($weather == 'Wind') {
        $weather = 'Windy';
        $emoji = '🍃';
    } elseif ($weather == 'Sun' || $weather == 'Sunny') {
        $emoji = '☀️';
        $weather = 'Sunny';
    } elseif ($weather == 'Snow') {
        $emoji = '🌨️';
        $weather = 'Snowy';
    }
    // switch ($weather) {
    //     case 'Rain': $weather = 'Raining'; $emoji = '🌧️'; break
    // }
    echo "<h2>The weather in Odesa is quite great. It's " . $weather ." right now $emoji</h2>\n";
    echo "<table>\n";
    for ($i = 40; $i >= -40; $i--) {
        echo "<tr>\n";
        for ($j = 0; $j < 2; $j++) {
            if ($j == 1) {
                echo "<td style='border: solid 1px black; width: 30px; height: 30px; background-color: " . ($i <= $temp ? "red" : "yellow") . ";'></td>\n";
            } else {
                echo "<td style='border: solid 1px black; width: 30px; height: 30px;'>$i</td>\n";
            }
        }
        echo "</tr>\n";
    }
    echo "</table>\n";
} else {
    echo "Не удалось получить данные. Проверьте API-ключ или координаты.";
}