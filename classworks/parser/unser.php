<?php
    $h = fopen('db.txt', "r+");
    $content = fread($h);
    unserialize($content);
?>