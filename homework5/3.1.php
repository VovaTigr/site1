<?php
$str = "[   34  555   8 9 9  ]";
while (strpos($str, "  ") !== false) {
    $str = str_replace("  ", " ", $str);
}
echo $str;