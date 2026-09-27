<?php

$en_de_dict = [
    "Table" => [
        "Tisch",
        "Verzeichniss",
        "Aufstellung"
    ],
    "Painting" => [
        "Malerei",
        "Bild",
        "Anstrich",
        "Bemalung"
    ],
    "Star" => "Stern",
    "Cat" => "Katze",
    "Light" => [
        "Licht",
        "Leicht",
        "Beleuchten"
    ]
];

$de_en_dict = [];

foreach ($en_de_dict as $english => $deutsch) {
    if (is_array($deutsch)) {
        foreach ($deutsch as $de_wort) {
            $de_en_dict[$de_wort][] = $english;
        }
    } else {
        $de_en_dict[$deutsch][] = $english;
    }
}


print_r($en_de_dict);
print_r($de_en_dict);
?>