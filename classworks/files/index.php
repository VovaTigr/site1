<?php
// $h    = fopen("my_file.html", "w"); // Буде відкритий файл нульової довжини "my_file.html" для записи.
// $text = "Цей текст запишемо в файл.";
// if (fwrite($h, $text)) {
//     echo "Запис зроблено успішно";
//     fread("my_file.html", "16");
// } else {
//     echo "Виникла помилка при запису даних";
// }
// $file = fopen("test.txt", "r");
//  Выводит строки файла до тех пор, пока не будет достигнут конец файла 
// while(!feof($file)) 
// { 
//     echo fgets($file); 
// }

$file = fopen("contacts.csv","r"); 
 print_r(fgetcsv($file)); 
 fclose($file);
