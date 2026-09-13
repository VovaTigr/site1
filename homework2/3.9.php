<?php
// 3.9 - The Termometer*

$t = rand(-20, 20);
echo "<h2>The termometer is set to " . $t . " degrees Celsius</h2><br>\n";
echo "<table>\n";
for ($i = 20; $i >= -20; $i--) {
    echo "<tr>\n";
    for ($j = 0; $j < 2; $j++) {
        if ($j == 1) {
            echo "<td style='border: solid 1px black; width: 30px; height: 30px; background-color: " . ($i <= $t ? "red" : "yellow") . ";'></td>\n";
        } else {
            echo "<td style='border: solid 1px black; width: 30px; height: 30px;'>$i</td>\n";
        }
    }
    echo "</tr>\n";
}
echo "</table>\n";