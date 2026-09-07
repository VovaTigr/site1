<?php
// 3.2 - HTML File Template
$head = <<<EOD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Title</title>
</head>
EOD;
$body_open = <<<EOD
<body>
EOD;
$nav_menu = <<<EOD
    <nav>
        <ul class="nav-links">
            <li><a href="#your-link-1">List item 1</a></li>
            <li><a href="#your-link-2">List item 2</a></li>
            <li><a href="#your-link-3">List item 3</a></li>
            <li><a href="#your-link-4">List item 4</a></li>
        </ul>
    </nav>
EOD;
$header = <<<EOD
    <header>
        <h1>Your heading</h1>
        <p>Your paragraph</p>
        <button id="cta">Call to action</button>
    </header>
EOD;
$main = <<<EOD
     <main>
        <aside>
            <figure><img src="your-image-1.jpg" alt="Your picture1"></figure>
            <figcaption>Your Figure Caption 1</figcaption>
            <figure><img src="your-image-2.jpg" alt="Your picture2"></figure>
            <figcaption>Your Figure Caption 2</figcaption>
            <figure><img src="your-image-3.jpg" alt="Your picture3"></figure>
            <figcaption>Your Figure Caption 3</figcaption>
            <figure><img src="your-image-4.jpg" alt="Your picture4"></figure>
            <figcaption>Your Figure Caption 4</figcaption>
            <figure><img src="your-image-5.jpg" alt="Your picture5"></figure>
            <figcaption>Your Figure Caption 5</figcaption>
        </aside>
        <section>
            <h2>Your heading</h2>
            <img src="your-image-1.jpg" alt="Your picture1">
            <p>Your paragraph</p>
        </section>
        <section>
            <h2>Your heading</h2>
            <img src="your-image-2.jpg" alt="Your picture2">
            <p>Your paragraph</p>
        </section>
        <section>
            <h2>Your heading</h2>
            <img src="your-image-3.jpg" alt="Your picture3">
            <p>Your paragraph</p>
        </section>
        <section>
            <h2>Your heading</h2>
            <img src="your-image-4.jpg" alt="Your picture4">
            <p>Your paragraph</p>
        </section>
    </main>
EOD;
$footer = <<<EOD
    <footer>
        <img src="your-logo.jpg" alt="Your logo">
        <p>Your copyright</p>
        <a href="your-link-1.html">Your link 1</a>
        <a href="your-link-2.html">Your link 2</a>
        <a href="your-link-3.html">Your link 3</a>
        <a href="your-link-4.html">Your link 4</a>
    </footer>
EOD;
$body_close = <<<EOD
</body>
</html>
EOD;
echo $head . "\n" .$body_open . "\n" . $nav_menu . "\n" . $header . "\n" . $main . "\n" . $footer . "\n" . $body_close . "\n";
echo "<hr>\n";

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

// 3.4 - On a Doctor's Inspection
$body_temp = rand(350, 400)/10;

echo "<h2>Your body temperature is " . $body_temp . " degrees Celsius</h2>\n";
echo ($body_temp < 36.5 ? "<p>You're too cold! You should wear a coat, stay at home and drink hot tea!</p>" : "<p>You're not too cold!</p>\n");
echo ($body_temp > 37.5 ? "<p>You're too hot! You should stay at home drink water and stay in bed</p>" : "<p>You're not too hot!</p>\n");

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

//3.7 - The School tasks

$school_task = round(rand(1, 13));
echo "<h2>Today's school task is: </h2>\n";

switch ($school_task) {
    case 1: echo "<p></p>Study Mathematics</p>"; break;
    case 2: echo "<p>Study Science</p>"; break;
    case 3: echo "<p>Study English</p>"; break;
    case 4: echo "<p>Study History</p>"; break;
    case 5: echo "<p>Study Geography</p>"; break;
    case 6: echo "<p>Study Art</p>"; break;
    case 7: echo "<p>Study Music</p>"; break;
    case 8: echo "<p>Study Physical Education</p>"; break;
    case 9: echo "<p>Study Computer Science</p>"; break;
    case 10: echo "<p>Study Foreign Language</p>"; break;
    case 11: echo "<p>Study Economics</p>"; break;
    case 12: echo "<p>Study Psychology</p>"; break;
    case 13: echo "<p>Study Philosophy</p>"; break;
    default: echo "<p>You aren't even allowed to study</p>"; break;
}
echo "<hr>\n";

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