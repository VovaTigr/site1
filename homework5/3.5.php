<?php
    $letter = "Ми будемо раді бачити Вашого сина на нашому заході. Чекаємо на нього 25 жовтня. Оргкомітет.";
    $sources = ["Ми", "Вашого", "сина", "нього", "Оргкомітет"];
    $replacements = ["ми", "Вашу", "доньку", "неї", "Адміністрація"];
    $replaced = str_replace($sources, $replacements, $letter);
    $final_letter = "Шановний Євгено Васильовичу, ".$replaced;
    $exploded_letter = explode(". ", $final_letter);
    print_r(implode(". ", $exploded_letter));
?>