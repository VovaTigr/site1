<?php

$lat = 46.2910;
$lon = 30.4340;
$apiKey = "f66280bed15ede06a64f3127fb668a15";

// Формируем URL с параметрами (метрическая система и русский язык)
$url = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=$apiKey&units=metric&lang=en";


// Подавляем ошибки warning на случай, если сервер вернет 404 или 401
$response = @file_get_contents($url);

if ($response !== false) {
    // Декодируем JSON в ассоциативный массив
    $data = json_decode($response, true);
    
    // Извлекаем нужные переменные
    $city = $data['name'];
    $temp = $data['main']['temp'];
    $pressure = $data['main']['pressure'];
    $humidity = $data['main']['humidity'];
    $description = $data['weather'][0]['description'];
    
    // Выводим результат
    echo "<h2>The temperature is now to " . $temp . " degrees Celsius in Odesa, Ukraine</h2><br>\n";
    echo "<h2>The pressure now is " . $pressure . " pasckals</h2><br>\n";
    echo "<h2>The humidity is now is " . $humidity . " %</h2><br>\n";
    echo "<table>\n";
    for ($i = 20; $i >= -20; $i--) {
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
