<?php
// 5.10 - Countries
$countries = [ 
    "France" => [
        "capital" => "Paris",
        "area" => 551695,
        "average population" => 68000000
    ],
    "Germany" => [
        "capital" => "Berlin",
        "area" => 357022,
        "average population" => 84300000
    ],
    "Japan" => [
        "capital" => "Tokyo",
        "area" => 377975,
        "average population" => 125100000
    ],
    "Canada" => [
        "capital" => "Ottava",
        "area" => 9984670,
        "average population" => 40000000
    ],
    "Ukraine" => [
        "capital" => "Kyiv",
        "area" => 603628,
        "average population" => 38000000
    ]
];

function sortByCountry(array &$array): bool {
    return uksort($array, function ($keyA, $keyB) {
        $charA = substr($keyA, 0, 1);
        $charB = substr($keyB, 0, 1);
        return $charA <=> $charB;
    });
}

function sortByCapital(array &$array): bool {
    return uasort($array, function ($a, $b) {
        $charA = substr($a['capital'] ?? '', 0, 1);
        $charB = substr($b['capital'] ?? '', 0, 1);
        return $charA <=> $charB;
    });
}

function sortByArea(array &$array): bool {
    return uasort($array, function ($a, $b) {
        $areaA = $a['area'] ?? null;
        $areaB = $b['area'] ?? null;

        $aIsNum = is_numeric($areaA);
        $bIsNum = is_numeric($areaB);

        if ($aIsNum && !$bIsNum) return 1;
        if (!$aIsNum && $bIsNum) return -1;

        return $areaB <=> $areaA;
    });
}

function sortByAP(array &$array): bool {
    return uasort($array, function ($a, $b) {
        $popA = $a['average population'] ?? null;
        $popB = $b['average population'] ?? null;

        $aIsNum = is_numeric($popA);
        $bIsNum = is_numeric($popB);

        if ($aIsNum && !$bIsNum) return 1;
        if (!$aIsNum && $bIsNum) return -1;

        return $popB <=> $popA;
    });
}

function printCountriesRating(array $array): void {
    $number = 1;
    foreach ($array as $title => $info) {
        echo "{$number}: {$title} ({$info['capital']}, {$info['area']} км²)\n";
        $number++;
    }
}

echo "=== 1. Сортировка по названию страны  ===\n";
$list1 = $countries;
sortByCountry($list1);
printMoviesRating($list1);

echo "\n=== 2. Сортировка по столице ===\n";
$list2 = $countries;
sortByCapital($list2);
printMoviesRating($list2);

echo "\n=== 3. Сортировка по площади ===\n";
$list3 = $countries;
sortByArea($list3);
printMoviesRating($list3);

echo "\n=== 4. Сортировка по среднему населению ===\n";
$list4 = $countries;
sortByAP($list4);
printMoviesRating($list4);
