<?php
// 5.9 - Films
$movies = [
    "Interstellar" => [
        "director" => "Nolan",
        "year" => 2014,
        "bg_image" => "/img/film-1-banner"
    ],
    "The Shawshank Redemption" => [
        "director" => "Darabont",
        "year" => 1994,
        "bg_image" => "/img/film-2-banner"
    ],
    "Pulp Fiction" => [
        "director" => "Tarantino",
        "year" => 1994,
        "bg_image" => "/img/film-3-banner"
    ],
    "The Last Samurai" => [
        "director" => "Zwick",
        "year" => 2004,
        "bg_image" => "/img/film-4-banner"
    ]
];

function sortByTitleFirstLetter(array &$array): bool {
    return uksort($array, function ($keyA, $keyB) {
        $charA = substr($keyA, 0, 1);
        $charB = substr($keyB, 0, 1);
        return $charA <=> $charB;
    });
}

function sortByDirectorFirstLetter(array &$array): bool {
    return uasort($array, function ($a, $b) {
        $charA = substr($a['director'] ?? '', 0, 1);
        $charB = substr($b['director'] ?? '', 0, 1);
        return $charA <=> $charB;
    });
}

function sortByYear(array &$array): bool {
    return uasort($array, function ($a, $b) {
        $yearA = $a['year'] ?? null;
        $yearB = $b['year'] ?? null;

        $aIsNum = is_numeric($yearA);
        $bIsNum = is_numeric($yearB);

        if ($aIsNum && !$bIsNum) return 1;
        if (!$aIsNum && $bIsNum) return -1;

        return $yearA <=> $yearB;
    });
}

function printMoviesRating(array $array): void {
    $number = 1;
    foreach ($array as $title => $info) {
        echo "{$number}: {$title} ({$info['director']}, {$info['year']})\n";
        $number++;
    }
}

function getRanks(array $originalMovies): array {
    $ranks = [];

    $byTitle = $originalMovies;
    sortByTitleFirstLetter($byTitle);
    $rank = 1;
    foreach ($byTitle as $title => $data) {
        $ranks[$title]['title_rank'] = $rank++;
    }

    $byDirector = $originalMovies;
    sortByDirectorFirstLetter($byDirector);
    $rank = 1;
    foreach ($byDirector as $title => $data) {
        $ranks[$title]['director_rank'] = $rank++;
    }

    $byYear = $originalMovies;
    sortByYear($byYear);
    $rank = 1;
    foreach ($byYear as $title => $data) {
        $ranks[$title]['year_rank'] = $rank++;
    }

    return $ranks;
}

$ranks = getRanks($movies);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Рейтинг Фильмов</title>
    <style>
        
    </style>
</head>
<body>