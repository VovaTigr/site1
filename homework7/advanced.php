<?php
$categories = [
    "space"       => "🚀 Космос",
    "detective"   => "🕵️ Детективи",
    "robot"       => "🤖 Роботи",
    "future"      => "🌆 Майбутнє",
    "magic"       => "🔮 Магія",
    "thriller"    => "🌒 Трилери",
    "love"        => "❤️ Романтика",
    "cyberpunk"   => "🦾 Кіберпанк",
    "time travel" => "⏳ Подорожі у часі",
];
// 1. Укажите ваш API Key
$apiKey = '5d22f36eb0bc6918f7684f49757813c5';

// 2. URL для запроса популярного кино
$url = "https://api.themoviedb.org/3/movie/popular?api_key={$apiKey}&language=ru-RU&page=1";

// 3. Выполняем запрос cURL
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL            => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
    CURLOPT_SSL_VERIFYPEER => false, // Отключает проверку SSL (для локального сервера)
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_TIMEOUT        => 15,
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// 4. Проверяем и декодируем ответ
if ($httpCode === 200 && $response) {
    // Преобразуем JSON-строку в ассоциированный массив PHP
    $data = json_decode($response, true);

    // Получаем массив результатов (фильмов)
    $movies = $data['results'];

    // Пример вывода списка фильмов
    foreach ($movies as $movie) {
        echo "<b>" . htmlspecialchars($movie['title']) . "</b> (" . $movie['release_date'] . ")<br>";
        echo "Рейтинг: " . $movie['vote_average'] . "<br>";
        echo "Описание: " . htmlspecialchars($movie['overview']) . "<br>";
        echo "<hr>";
    }
} else {
    echo "Не удалось получить данные. Код ответа: " . $httpCode;
}
?>
