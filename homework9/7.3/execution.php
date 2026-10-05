<?php
    require ("data.php");

    foreach ($people as $key => $man_info) {
    $event_key = $letter[$key];
    $str .= "DATE\n";
    if ($event_key != "") {
        foreach ($man_info as $key1 => $info) {
            if ($key1 == "name")
                $str = "Уважаемый $info, ";
            if ($key1 == "email")
                $email = $info;
        }  
        switch ($event_key) {
            case "expulsion":
                $str .= "с большим сожалением передаем новость о вашем отчислении из этого учебного заведения. Ваш косяк не простителен для нас.";
                break;
            case "gratitude":
                $str .= "передаем Вам большую благодарность за успехи в учебе и ваши достижения.";
                break;
            case "bonus":
                $str .= "выдаем Вам заслуженную плату за участие в олимпиаде и значительный вклад в развитие нашего учреждения.";
                break;
            case "stipend": 
                $str .= "начисляем Вашу стипендию за месяц усердной работы.";
                break;
        }
        $str .= "\n" . SIGN . "\n";

        echo $str;
    }
}
?>