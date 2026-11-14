<?php
$a = array("a"=>"aa", "b"=>"bb", "c"=>array("x"=>"xx"));
$st = serialize($a);
echo $st;
$h = fopen('db.txt', "r+");
$content = fread($h, filesize('db.txt'));
fwrite(serialize($content));
fclose()
?>
