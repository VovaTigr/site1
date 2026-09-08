<?php
// 3.8 - Table
$iterations = rand(10, 20);
echo "<table style=' border-collapse: collapse;'>\n";
for ($i = 1; $i <= $iterations; $i+=2) {
    echo "<tr>\n";
    for ($j = 0; $j < 2; $j++) {
        if ($j == 1) {
            echo "<td style='border: black solid 2px; width: 50px; height: 50px'><img src='img_" . $i . ".jpg'></td>";
        } else {
            echo "<td style='border: black solid 2px; width: 50px; height: 50px'> " . $i . "</td>";
        }
    }
    echo "</tr>\n";
}
echo "</table>\n";

// 3.10 - Dynamic References
$q = 11;
for ($i = 0; $i < $q; $i++) {
    $x1 = "x".$i;
    $$x1 = $i;
    echo "". "x".$i . " = " . $i . "; ";
} 