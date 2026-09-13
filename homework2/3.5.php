<?php
// 3.5 - The Area of a Circle
$circle = rand(1, 20) * 10;
$radius = $circle / 2;
define("PI", 3.14);
$area = PI * $radius * $radius;

echo "<div class='circle' style='border-radius: 50%; border: solid 2px black; background-color: transparent; width: " . $circle . "px; height: " . $circle . "px;'>
        <hr style='border: none; border-top: solid 2px black; width: " . $radius . "px; margin: 0; position: relative; top: 50%; left: 0; transform: translateY(-50%);'>
    </div>;";
echo "<hr>";
echo "<p>The Radius of the circle is " . $radius . " pixels </p>\n";
echo "<p>The Area of the circle is " . $area . " squared pixels</p>\n";
echo "<hr>\n";