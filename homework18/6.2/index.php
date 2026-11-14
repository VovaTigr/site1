<?php
$library = [
    "William Shakespeare" => "Hamlet",
    "Jane Austen" => "Pride and Prejudice",
    "George Orwell" => "1984",
    "Ernest Hemingway" => "The Old Man and the Sea"
];

$path = __DIR__ . DIRECTORY_SEPARATOR . "placeholder.txt";
$handle = fopen($path, "w");

if ($handle === false) {
    echo "Error has occurred";
    exit;
}

$serialized = serialize($library);
$bytesWritten = fwrite($handle, $serialized);
fclose($handle);

if ($bytesWritten === false) {
    echo "Error has occurred";
} else {
    echo "Successful";
}
?>