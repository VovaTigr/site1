<?php
$path = __DIR__ . DIRECTORY_SEPARATOR . "placeholder.txt";

if (!is_file($path) || !is_readable($path)) {
    echo "Error has occurred";
    exit;
}

$handle = fopen($path, "r");
if ($handle === false) {
    echo "Error has occurred";
    exit;
}

$size = filesize($path);
$file_content = ($size > 0) ? fread($handle, $size) : "";
fclose($handle);

$data = unserialize($file_content);
if ($data === false && $file_content !== serialize(false)) {
    echo "Error has occurred";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        td {
            border: black solid 2px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <table>
        <?php
            foreach($data as $key => $value) {
                echo "<tr><td>$key</td><td>$value</td></tr>\n\t";
            }
        ?>
    </table>
</body>
</html>