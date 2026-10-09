<?php
    require ("data.php");

    $quote_jayson = "If life is a call, I will call you back\n";
    echo reverbStr($quote_jayson);
    $quote_jenghizhan = "If thou dost fear, attempt it not; if thou attempt, fear not; for if thou falter, thou art undone.\n";
    echo deleteEverySecondWord($quote_jenghizhan);
    echo "\n";
    $characters = [
        "Crimson God [Adulthood]",
        "Hong Lu",
        "Annete",
        "Panther",
        "Lowell",
        "Angela",
        "Iori",
        "Nikolai"
    ];
    echo secretWord($characters);
    echo "<img src='./img/chaplain.gif' alt='Haven't loaded' width='400'>"
?>