<?php
$books = [
    [
        "Name" => "Ivan",
        "Surname" => "Franko",
        "Books" => [
            "Zakhar Berkut",
            "Moses"
        ]
    ],
    [
        "Name" => "Taras",
        "Surname" => "Shevchenko",
        "Books" => [
           "Testament",
            "My thoughts, my thoughts..."
        ] 
    ],
    [
        "Name" => "Panas",
        "Surname" => "Myrnij",
        "Books" => [
            "Do Oxen Low When the Barn is Full?",
            "Drunkard"
        ]
    ]
];

function search($books, $data) {
            $result = array();
            foreach ($books as $book_number => $book) {
                foreach ($book as $key => $value) {
                    if (!is_array($value)) {
                        if (stristr($value, $data)) {
                            $result[] = $book_number;
                        }
                    } else {
                        foreach ($value as $k => $v) {
                            if (stristr($v, $data) || stristr($k, $data)) {
                                $result[] = $book_number;
                            }
                        }
                    }
                }
            }
            // return array_unique($result);
            $search_result = array_flip($result);
            $books_search_result = array_intersect_key($books, $search_result);
            return $books_search_result;
            
        }
        function print_book($book, $key_book, $data)
{
    static $i = 1; // статическая глобальная переменная-счетчик
    echo $data . $i . " ";
    foreach ($book as $key => $value) {
        if (! is_array($value)) {
            echo "$key:$value,\n\t";
        } else {
            echo "$key:";
            foreach ($value as $k => $v) {
                echo " $v";
            }
        }
    }
    echo "\n";
    $i++;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ukrainian Books</title>
    <style>
        table {
            border-collapse: collapse;
        }
        img {
            width: 150px;
        }
        td {
            border: black solid 2px;
            padding: 20px;
            text-align: center;
        }
        ul {
            list-style-type: none;
        }
    </style>
</head>
<body>
    <h2><?php $temp = search($books, "Ox");
    array_walk($temp, "print_book", "№"); ?></h2>
    <table>
        <tr>
            <td>
                <figure><img src="./img/img-1.jpg" alt=""></figure>
                <figcaption>Ivan Franko</figcaption>
            </td>
            <td>
                <h2>Famous Books</h2>
                <ul>
                    <li><?php echo $books[0]["Books"][0]; ?></li>
                    <li><?php echo $books[0]["Books"][1] ?></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>
                <figure><img src="./img/img-2.jpg" alt=""></figure>
                <figcaption>Taras Shevchenko</figcaption>
            </td>
            <td>
                <h2>Famous Books</h2>
                <ul>
                    <li><?php echo $books[1]["Books"][0] ?></li>
                    <li><?php echo $books[1]["Books"][1] ?></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>
                <figure><img src="./img/img-3.jpg" alt=""></figure>
                <figcaption>Panas Myrnij</figcaption>
            </td>
            <td>
                <h2>Famous Books</h2>
                <ul>
                    <li><?php echo $books[2]["Books"][0] ?></li>
                    <li><?php echo $books[1]["Books"][1] ?></li>
                </ul>
            </td>
        </tr>
    </table>
</body>
</html>