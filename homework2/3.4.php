<?php
// 3.4 - On a Doctor's Inspection
$body_temp = rand(350, 400)/10;

echo "<h2>Your body temperature is " . $body_temp . " degrees Celsius</h2>\n";
echo ($body_temp < 36.5 ? "<p>You're too cold! You should wear a coat, stay at home and drink hot tea!</p>" : "<p>You're not too cold!</p>\n");
echo ($body_temp > 37.5 ? "<p>You're too hot! You should stay at home drink water and stay in bed</p>" : "<p>You're not too hot!</p>\n");