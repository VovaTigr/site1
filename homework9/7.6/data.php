<?php
    function reverbStr(string $string) {
        $res = "";
        for ($i = strlen($string) - 1; $i >= 0; $i--) {
            $res .= $string[$i];
        }
        return "$res\n";
    }

    function deleteEverySecondWord(string $string) {
        $res = [];
        $exp_str = explode(" ", $string);
        foreach ($exp_str as $number => $value) {
            if ($number % 2 != 0) {
                $res[] = $value;
            } else {
                continue;
            }
        }
        return implode(" ", $res);
    }

    function secretWord(array $array) {
        $res = "";
        foreach ($array as $index => $value) {
            $res .= $value[0];
        }
        return "<h2>$res</h2>\n";
    }
?>