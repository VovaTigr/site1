<?php
// 5.6 - Repetative User Logins

$users1 = ["John" => "qwerty", "Nicole" => "asdf", "Mark" => "ww"];
$users2 = ["Joan" => "1234", "Mark" => "poiu", "Nicole" => "ggg"];

$intersect1 = array_intersect_key($users1, $users2);
$intersect2 = array_intersect_key($users2, $users1);

$duplicates = array_merge_recursive($intersect1, $intersect2);

$unique1 = array_diff_key($users1, $users2);
$unique2 = array_diff_key($users2, $users1);

$unique_users = array_merge($unique1, $unique2);

$result = $unique_users + $duplicates;

print_r($result);

