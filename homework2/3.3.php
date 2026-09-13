<?php
// 3.3 - Temperature Outside
$temp = round(rand(-20, 50));
echo "<h2>It's " . $temp . " degrees outside</h2>\n";
if ($temp >= -20 && $temp <= 0) {
    echo "<p>This is freezing! Won't even gonna go outside!</p>\n";
} elseif ($temp >= 1 && $temp <= 10) {
    echo "<p>It's chilly! Gotta grab a jacket!</p>\n";
} elseif ($temp >= 11 && $temp <= 20) {
    echo "<p>It's cool outside! I like it. I shall go for walk!</p>\n";
} elseif ($temp >= 21 && $temp <= 30) {
    echo "<p>Today is a nice temperature! Let's hang out!!</p>\n";
} elseif ($temp >= 31 && $temp <= 40) {
    echo "<p>Woah! This summer is really cruel. I would rather stay at home</p>\n";
} else {
    echo "<p>I... am... melting...</p> \n";
}
echo "<hr>\n";