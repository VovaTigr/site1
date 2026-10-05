<?php

$apiKey = "5d22f36eb0bc6918f7684f49757813c5";

$categories = [
    'space' => '🚀 Космос',
    'detective' => '🕵️ Детективи',
    'robot' => '🤖 Роботи',
    'future' => '🌆 Майбутнє',
    'magic' => '🔮 Магія',
    'thriller' => '🌒 Трилери',
    'love' => '❤️ Романтика',
    'cyberpunk' => '🦾 Кіберпанк',
    'time travel' => '⏳ Подорожі у часі'
];


$category = $_GET['cat'] ?? 'space';

if ($category === 'random') {
    $randomKey = array_rand($categories);
    $category = $randomKey;
}

if (!array_key_exists($category, $categories)) {
    $category = 'space';

}

$sortMode = $_GET['sort'] ?? 'pop';
$filterMode = $_GET['filter'] ?? 'all';

$url = 'https://api.themoviedb.org/3/search/movie?' . http_build_query([
    'api_key' => $apiKey,
    'query' => $category,
    'language' => 'uk-UA',
    'page' => 1

]);

$response = file_get_contents($url);


if ($response === false) {
    die('Помилка під час звернення до TMDB API.');

}
$data = json_decode($response, true);

if (!isset($data['results'])) {
    die('Не вдалося отримати дані про фільми.');
}

$movies = [];
foreach ($data['results'] as $item) {
    if (empty($item['release_date'])) {
        continue;
    }
    $year = (int)substr(
        $item['release_date'],
        0,
        4
    );
    if (empty($item['poster_path'])) {
        continue;
    }
    $movie = [
        'title' => $item['title'] ?? 'Без назви',
        'year' => $year,
        'vote' => (float)($item['vote_average'] ?? 0),
        'votes' => (int)($item['vote_count'] ?? 0),
        'pop' => (float)($item['popularity'] ?? 0),
        'poster' =>
            'https://image.tmdb.org/t/p/w500'
            . $item['poster_path'],
        'is_gem' =>
            (
                (float)($item['vote_average'] ?? 0) >= 7.0
                &&
                (int)($item['vote_count'] ?? 0) < 1000
            )

    ];
    $movies[] = $movie;
}

$movies = array_filter(
    $movies,
    function ($movie) use ($filterMode) {
        if ($filterMode === 'modern') {
            return $movie['year'] >= 2000;
        }

        if ($filterMode === 'classic') {
            return $movie['year'] < 2000;
        }
        return true;
    }
);

match ($sortMode) {
    'vote' => uasort(
        $movies,
        fn($a, $b) =>
            $b['vote'] <=> $a['vote']
    ),
    'year' => uasort(
        $movies,
        fn($a, $b) =>
            $b['year'] <=> $a['year']
    ),
    'gems' => uasort(
        $movies,
        fn($a, $b) =>
            [$b['is_gem'], $b['vote']]
            <=>
            [$a['is_gem'], $a['vote']]
    ),


    // По популярности

    default => uasort(

        $movies,

        fn($a, $b) =>
            $b['pop'] <=> $a['pop']

    )

};


// ==========================================
// 11. Генерация карточек через array_walk()
// ==========================================

$movieCards = '';


array_walk(

    $movies,

    function ($movie) use (&$movieCards) {

        $title = htmlspecialchars(
            $movie['title'],
            ENT_QUOTES,
            'UTF-8'
        );


        $poster = htmlspecialchars(
            $movie['poster'],
            ENT_QUOTES,
            'UTF-8'
        );


        $gemBadge = '';


        if ($movie['is_gem'] === true) {

            $gemBadge = '
                <div class="gem">
                    🎯 Прихована перлина
                </div>
            ';

        }


        $movieCards .= '

            <article class="movie-card">

                ' . $gemBadge . '

                <img
                    class="poster"
                    src="' . $poster . '"
                    alt="' . $title . '"
                >

                <div class="movie-info">

                    <div class="movie-title">
                        ' . $title . '
                    </div>

                    <div class="year">
                        ' . $movie['year'] . '
                    </div>

                    <div class="rating">
                        ⭐ ' . number_format(
                            $movie['vote'],
                            1
                        ) . '

                        <span class="votes">
                            (' . $movie['votes'] . ' голосів)
                        </span>
                    </div>

                </div>

            </article>

        ';

    }

);


// ==========================================
// 12. Название текущей категории
// ==========================================

$categoryName = $categories[$category];

?>

<!DOCTYPE html>

<html lang="uk">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        CineGap Explorer
    </title>


    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #111827;
            color: white;
            min-height: 100vh;

        }

        .container {
            width: 90%;
            max-width: 1300px;
            margin: 0 auto;
            padding: 40px 0;
        }

        h1 {
            text-align: center;
            font-size: 42px;
            margin-bottom: 10px;
        }

        .description {
            text-align: center;
            color: #9ca3af;
            margin-bottom: 35px;
        }

        .categories {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .category {
            text-decoration: none;
            color: white;
            background: #1f2937;
            border: 1px solid #374151;
            padding: 12px 18px;
            border-radius: 10px;
            transition: 0.2s;
        }

        .category:hover {
            background: #374151;
            transform: translateY(-2px);
        }


        .random {
            background: #7c3aed;
        }


        /* Настройки */

        .settings {

            background: #1f2937;

            padding: 20px;

            border-radius: 15px;

            margin-bottom: 35px;

            display: flex;

            justify-content: center;

        }


        form {

            display: flex;

            flex-wrap: wrap;

            gap: 15px;

            align-items: end;

        }


        .field {

            display: flex;

            flex-direction: column;

            gap: 7px;

        }


        label {

            font-size: 14px;

            color: #d1d5db;

        }


        select {

            padding: 11px 15px;

            border-radius: 8px;

            border: 1px solid #4b5563;

            background: #111827;

            color: white;

            font-size: 15px;

        }


        button {

            padding: 11px 20px;

            border: none;

            border-radius: 8px;

            background: #2563eb;

            color: white;

            cursor: pointer;

            font-size: 15px;

        }


        button:hover {

            background: #3b82f6;

        }


        /* Результаты */

        .result-title {

            margin-bottom: 20px;

            font-size: 24px;

        }


        /* Сетка */

        .movies {

            display: grid;

            grid-template-columns:
                repeat(
                    auto-fill,
                    minmax(200px, 1fr)
                );

            gap: 25px;

        }


        /* Карточка */

        .movie-card {

            position: relative;

            background: #1f2937;

            border-radius: 14px;

            overflow: hidden;

            transition: 0.25s;

        }


        .movie-card:hover {

            transform: translateY(-7px);

            box-shadow:
                0 15px 30px
                rgba(0, 0, 0, 0.4);

        }


        .poster {

            width: 100%;

            height: 300px;

            object-fit: cover;

            display: block;

        }


        .movie-info {

            padding: 15px;

        }


        .movie-title {

            font-size: 18px;

            font-weight: bold;

            margin-bottom: 8px;

        }


        .year {

            color: #9ca3af;

        }


        .rating {

            margin-top: 12px;

            color: #fbbf24;

        }


        .votes {

            color: #9ca3af;

            font-size: 13px;

        }


        /* Бейдж */

        .gem {

            position: absolute;

            top: 10px;

            left: 10px;

            background: #f59e0b;

            color: #111827;

            padding: 6px 9px;

            border-radius: 7px;

            font-size: 12px;

            font-weight: bold;

            z-index: 2;

        }


        @media (max-width: 600px) {

            h1 {

                font-size: 30px;

            }


            .container {

                width: 94%;

            }


            .movies {

                grid-template-columns:
                    repeat(2, 1fr);

                gap: 12px;

            }


            .poster {

                height: 240px;

            }

        }

    </style>

</head>


<body>


<div class="container">


    <h1>
        🎬 CineGap Explorer
    </h1>


    <p class="description">
        Тематичний аналізатор кіно на основі TMDB
    </p>


    <!-- =====================================
         КАТЕГОРИИ
         ===================================== -->

    <div class="categories">

        <?php

        foreach ($categories as $key => $name) {

            echo '
                <a
                    class="category"
                    href="?cat=' . urlencode($key) . '"
                >
                    ' . $name . '
                </a>
            ';

        }

        ?>


        <a
            class="category random"
            href="?cat=random"
        >
            🎲 Здивуй мене!
        </a>

    </div>


    <!-- =====================================
         ФОРМА
         ===================================== -->

    <div class="settings">

        <form method="GET">


            <!-- Категория -->

            <input
                type="hidden"
                name="cat"
                value="<?= htmlspecialchars($category) ?>"
            >


            <!-- Сортировка -->

            <div class="field">

                <label for="sort">
                    Сортувати за
                </label>

                <select
                    name="sort"
                    id="sort"
                >

                    <option
                        value="pop"
                        <?= $sortMode === 'pop'
                            ? 'selected'
                            : ''
                        ?>
                    >
                        🔥 За популярністю
                    </option>


                    <option
                        value="vote"
                        <?= $sortMode === 'vote'
                            ? 'selected'
                            : ''
                        ?>
                    >
                        ⭐ За рейтингом
                    </option>


                    <option
                        value="year"
                        <?= $sortMode === 'year'
                            ? 'selected'
                            : ''
                        ?>
                    >
                        📅 За роком
                    </option>


                    <option
                        value="gems"
                        <?= $sortMode === 'gems'
                            ? 'selected'
                            : ''
                        ?>
                    >
                        🎯 Приховані перлини
                    </option>

                </select>

            </div>


            <!-- Фильтр -->

            <div class="field">

                <label for="filter">
                    Фільтр епохи
                </label>

                <select
                    name="filter"
                    id="filter"
                >

                    <option
                        value="all"
                        <?= $filterMode === 'all'
                            ? 'selected'
                            : ''
                        ?>
                    >
                        🌐 Усі роки
                    </option>


                    <option
                        value="modern"
                        <?= $filterMode === 'modern'
                            ? 'selected'
                            : ''
                        ?>
                    >
                        🔥 XXI століття
                    </option>


                    <option
                        value="classic"
                        <?= $filterMode === 'classic'
                            ? 'selected'
                            : ''
                        ?>
                    >
                        📜 Класика
                    </option>

                </select>

            </div>


            <button type="submit">
                🔎 Застосувати
            </button>

        </form>

    </div>


    <!-- =====================================
         РЕЗУЛЬТАТЫ
         ===================================== -->

    <h2 class="result-title">

        <?= $categoryName ?>

        —
        <?= count($movies) ?>

        фільмів

    </h2>


    <div class="movies">

        <?php

        if (empty($movies)) {

            echo '
                <p>
                    Фільмів за заданими параметрами не знайдено.
                </p>
            ';

        } else {

            // ВАЖЛИВО:
            // HTML-картки були сформовані
            // саме через array_walk()

            echo $movieCards;

        }

        ?>

    </div>


</div>


</body>

</html>
