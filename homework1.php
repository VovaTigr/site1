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
echo $head . "\n" .$body_open . "\n" . $nav_menu . "\n" . $header . "\n" . $main . "\n" . $footer . "\n" . $body_close;