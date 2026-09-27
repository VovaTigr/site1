<?php
    $img_url = [
        "Image 1" => "./images/img-1.png",
        "Image 2" => "./images/img-532939149443.gif",
        "Image 3" => "./images/poetry.svg",
        "Image 4" => "./folder/IMG-4.jpg"
    ];
    $res = [];
    foreach ($img_url as $key => $value) {
        if (preg_match_all('/^\.\/images\/img-\d+\.(jpg|png|gif)$/i', $value)) {
            $res[] = $value;
        }
    }
    echo "<h2>The correct files, that belong to the page have this url:</h2>\n";
    print_r($res);
?>