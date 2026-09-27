<?php
// 5.11 - Students
$students = [
	      [
		"name" => "Vladislav",
		"surname" => "Pryahin",
		"year" => 2012,
		"marks" => [
				"PHP" => 5,
				"JS" => 4,
				"HTML" => 5,
                "Tailwind" => 3
			    ] 
	      ],
	      [
		"name" => "Pavel",
		"surname" => "Laich",
		"year" => 2007,
		"marks" => [
				"PHP" => 2,
				"JS" => 3,
				"HTML" => 5,
                "Tailwind" => 4
			    ] 
	      ],
	      [
		"name" => "Fyokla",
		"surname" => "Burmalda",
		"year" => 2015,
		"marks" => [
				"PHP" => 5,
				"JS" => 4,
				"HTML" => 2,
                "Tailwind" => 1
			    ] 
	      ],
          [
		"name" => "Dodep",
		"surname" => "Vending",
		"year" => 2022,
		"marks" => [
				"PHP" => 2,
				"JS" => 2,
				"HTML" => 2,
                "Tailwind" => 1
			    ]
          ]
];

function sortByName(array &$array): bool {
    return uksort($array, function ($keyA, $keyB) {
        $charA = substr($keyA, 0, 1);
        $charB = substr($keyB, 0, 1);
        return $charB <=> $charA;
    });
}

function sortBySurname(array &$array): bool {
    return uasort($array, function ($a, $b) {
        $charA = substr($a['surname'], 0, 1);
        $charB = substr($b['surname'], 0, 1);
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

function sortByMarks(array &$array): bool {
    return uasort($array, function ($a, $b) {
        $markA = number_format(array_sum($a['marks']) / count($a['marks']), 2);
        $markB = number_format(array_sum($a['marks']) / count($b['marks']), 2);

        $aIsNum = is_numeric($markA);
        $bIsNum = is_numeric($markB);

        if ($aIsNum && !$bIsNum) return 1;
        if (!$aIsNum && $bIsNum) return -1;

        return $markB <=> $markA;
    });
}

function printStudents(array $array): void {
    foreach ($array as $item) {
        $averageMark = array_sum($item['marks']) / count($item['marks']);
        $averageMarkFormatted = number_format($averageMark, 2);
        echo "Name: {$item['name']}, Surname: {$item['surname']}, Year: {$item['year']}, Average Mark: {$averageMarkFormatted}\n";
    }
}

echo "=== 1. Сортировка по имени  ===\n";
$list1 = $students;
sortByName($list1);
printStudents($list1);

echo "\n=== 2. Сортировка по фамилии ===\n";
$list2 = $students;
sortBySurname($list2);
printStudents($list2);

echo "\n=== 3. Сортировка по году рождения ===\n";
$list3 = $students;
sortByYear($list3);
printStudents($list3);

echo "\n=== 4. Сортировка по средней оценке ===\n";
$list4 = $students;
sortByMarks($list4);
printStudents($list4);