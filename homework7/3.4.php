<?php
    $sentence = "My favourite AI is Gemini it is currently is one of the best models for researching and learning but still if you use AI then use it to your advantage to learn something";
    $words = preg_split('/[\s,]+/', $sentence);
    $i = [];
    foreach ($words as $word) {
        $i[] .= $word;
    }
   $res = array_unique($i);
   print_r($res)
?>