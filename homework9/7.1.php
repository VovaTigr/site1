<?php
$books = [
    [
        "title"  => "Wings",
        "author" => "Yi Sang",
        "year"   => 1936,
    ],
    [
        "title"  => "Faust",
        "author" => "Johann Wolfgang von Goethe",
        "year"   => 1808,
    ],
    [
        "title"  => "Don Quixote",
        "author" => "Miguel de Cervantes",
        "year"   => 1605,
    ],
    [
        "title"  => "Hell Screen",
        "author" => "Ryūnosuke Akutagawa",
        "year"   => 1918,
    ],
    [
        "title"     => "The Stranger",
        "author"    => "Albert Camus",
        "year"      => 1942,
        "publisher" => "Gallimard",
    ],
    [
        "title"  => "Dream of the Red Chamber",
        "author" => "Cao Xueqin",
        "year"   => 1791,
    ],
    [
        "title"     => "Wuthering Heights",
        "author"    => "Emily Brontë",
        "year"      => 1847,
        "publisher" => "Thomas Cautley Newby",
    ],
    [
        "title"     => "Moby-Dick",
        "author"    => "Herman Melville",
        "year"      => 1851,
        "publisher" => "Richard Bentley",
    ],
    [
        "title"     => "Crime and Punishment",
        "author"    => "Fyodor Dostoevsky",
        "year"      => 1866,
        "publisher" => "The Russian Messenger",
    ],
    [
        "title"  => "The Divine Comedy",
        "author" => "Dante Alighieri",
        "year"   => 1320,
    ],
    [
        "title"     => "Demian",
        "author"    => "Hermann Hesse",
        "year"      => 1919,
        "publisher" => "S. Fischer Verlag",
    ],
    [
        "title"  => "Odyssey",
        "author" => "Homer",
        "year"   => -800,
    ],
    [
        "title"     => "The Metamorphosis",
        "author"    => "Franz Kafka",
        "year"      => 1915,
        "publisher" => "Kurt Wolff Verlag",
    ],
];
// Function 
// function library($book_title = "- ", $author_name = "- ", $year = "- ", $publisher = "- ") {
//     return $book_title, $author_name, $year, $publisher
// }
// How I wanted that function to work and "echo" books
function print_book($index, $title, $author, $year, $publisher = "- ") {
    echo "$index. $title was written by $author in $year"; 
    print ($publisher != "- " ? " and published by $publisher.\n" : ".\n");
}
function library($arr)
{
    foreach ($arr as $book_number => $book) {
        $index  = ($book_number + 1) ?? "- ";
        $title  = $book['title'] ?? "- ";
        $author = $book['author'] ?? "- ";
        $year   = $book['year'] ?? "- ";
        $publisher = $book['publisher'] ?? "- ";
        if ($year < 0) {
            $formatted_year = $year / 100 * -1; // 8
            $bc_year = "$formatted_year" . "th" . " century BC"; // 8th century BC
            print_book($index, $title, $author, $bc_year, $publisher);
        } else {
            print_book($index, $title, $author, $year, $publisher);
        }
    }
}
echo library($books);
?>