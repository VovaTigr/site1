<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

$apiKey = '5d22f36eb0bc6918f7684f49757813c5'; // Замените на ваш ключ
$url = "https://api.themoviedb.org/3/movie/popular?api_key={$apiKey}&language=ru-RU";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// Обязательный заголовок User-Agent:
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
// Отключение проверки SSL на время теста
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo "HTTP код: " . $httpCode . "<br>";
if ($error) {
    echo "cURL Ошибка: " . $error;
} else {
    echo "Ответ сервера:<br>";
    var_dump(json_decode($response, true));
}