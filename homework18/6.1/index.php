<?php
$path      = "poems-html";
$poemsPath = "poems";
if (! is_dir($path)) {
    mkdir($path);
}
if (is_dir($poemsPath)) {                      // якщо існує папка "poems"
    $files = scandir($poemsPath, 1);               // отримуємо масив назв файлів, що містяться в папці "poems"
    for ($i = 0; $i < count($files); $i++) {       // проходимо по масиву назв файлів
        if ($files[$i] != '.' && $files[$i] != '..') { // крім поточної та батьківської директорії
            $filename = $poemsPath . "/" . $files[$i];     // додаємо до імені файлу ім'я папки poems /
            echo $filename . "\n";
            $file         = fopen($filename, "r");                             // відкриваємо файл
            $content      = fread($file, filesize($filename));                 // читаємо вміст файлу
            $new_filename = pathinfo($files[$i], PATHINFO_FILENAME);           // отримуємо ім'я файлу без розширення
            $html         = fopen($path . "/" . $new_filename . ".php", "w");  // створюємо новий html файл
            fwrite($html, $content);                                           // пишемо туди отриманий вміст
            fclose($file);                                                     // закриваємо файл з папки poems
            fclose($html);                                                     // закриваємо файл з папки poems-html
        }
    }
}
