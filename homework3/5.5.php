<?php
// 5.5 - Sum of Positive Array Integers
$arr = array_sum(array_filter([[2, 5, -7, -15, 24],[4, 9, -8, -2, 0]], function ($value) {return $value > 0;}));
echo $arr;