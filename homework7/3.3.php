<?php
    $emails = [
        "Email 1" => "andriykotz228@gmail.com",
        "Email 2" => "ilya_mazelov_432@gmail.com",
        "Email 3" => "sviridenkov@chernomorsky.com",
        "Email 4" => "3434%4@gmail.com"
    ];
    $reg = '/^([a-zA-Z0-9._]||[a-zA_Z])+@gmail+\.com$/';
    $res = [];
    foreach ($emails as $key => $value) {
        if (preg_match_all($reg, $value)) {
            $res[] = $value;
        } 
    }
    print_r($res)
?>