<?php
    $arr = [
        "Roland (롤랑, Lollang) is one of the main protagonists, a playable character in Library Of Ruina and the servant of Angela.",
        "Malkuth (말쿠트, Malkuteu) is the Patron Librarian of the Library's Floor of History, and the former Sephirah of the Control Team of Lobotomy Corporation's headquarters.",
        "Yesod (예소드, Yesodeu) is the Patron Librarian of the Floor of Technological Sciences in the Library, and former Sephirah of the Information Team of Lobotomy Corporation.",
        "Hod (호드, Hodeu) is the Patron Librarian of the Floor of Literature in the Library, and former Sephirah of the Training Team in Lobotomy Corporation.",
        "Netzach (네짜흐, Nejjaheu) is the Patron Librarian of the Floor of Art in the Library, and former Sephirah of the Safety Team in Lobotomy Corporation.",
        "Tiphereth (티페리트, Tipeliteu) is the Patron Librarian of the Floor of Natural Sciences in the Library, and former Sephirah of the Central Command Team in Lobotomy Corporation.",
        "Gebura (게부라, Gebula) is the Patron Librarian of the Floor of Language in the Library, and formerly the Sephirah of Lobotomy Corporation's Disciplinary Team.",
        "Chesed (헤세드, Hesedeu) is the Patron Librarian of the Floor of Social Sciences in the Library, and former Sephirah of the Welfare Team in Lobotomy Corporation.",
        "Binah (비나, Bina) is the Patron Librarian of the Library's Floor of Philosophy, formerly the Sephirah of Lobotomy Corporation's Extraction Team, and a former Arbiter of the Head.",
        "Hokma (호크마, Hokeuma) is the Patron Librarian of the Floor of Religion in the Library, and former Sephirah of the Record Team in Lobotomy Corporation."
    ];
    function lowerCase($array) {
        return strtolower($array);
    }
    $lowered = array_map('lowerCase', $arr);
    function concat($carry, $item) {
        $item .= " ->\n";
        $carry .= $item;
        return $carry;
    }
    print_r(array_reduce($lowered, "concat", "- \n"));
?>