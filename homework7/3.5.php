<?php
    $string = 'Variables called $ str are mostly used to store a string while $int are used for integers. The $ symbol is used to define a standard variable in PHP.';
    $pattern = '/(\$ \w+)/u';
    $replacements = '<b>$1</b>';
    print_r(preg_replace($pattern, $replacements, $string));
?>