<?php
$str = "'Python (Питон)) is one of the easiest programming languages to learn as a 'beginner'";
switch ($str) {
    case substr_count($str, "'") % 2 == 0: echo "Syntax Error. Close your brackets"; break;
    case substr_count($str, "(") % 2 == 0: echo "Syntax Error. Close your brackets"; break;
    case substr_count($str, ")") % 2 == 0: echo "Syntax Error. Close your brackets"; break;
    default: echo "Your string is okay";
}
