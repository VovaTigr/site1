<?php
    $str1 = "User rights: Administrator, Editor, Subscriber. Info: details.";
    preg_match_all('/\b\w+(?=:)/', $str1, $matches);
    print_r($matches[0]);
    $str2 = "Cost $100, discount 20, altogether: $80 for 1 item.";
    preg_match_all('/(?<!\$)\b\w+\b/', $str2, $matches);
    print_r($matches[0]);
?>