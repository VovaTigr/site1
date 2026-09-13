<?php
// 3.10 - Dynamic References
$q = 11;
for ($i = 0; $i < $q; $i++) {
    $x1 = "x".$i;
    $$x1 = $i;
    echo $$x1 = $i;
} 