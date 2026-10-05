<?php
$date = "31/12/2027";
function matchReplace($months)
{
    switch ($months[1]) {
        case 1:$month = "of January";
            break;
        case 2:$month = "of February";
            break;
        case 3:$month = "of March";
            break;
        case 4:$month = "of April";
            break;
        case 5:$month = "of May";
            break;
        case 6:$month = "of June";
            break;
        case 7:$month = "of July";
            break;
        case 8:$month = "of August";
            break;
        case 9:$month = "of September";
            break;
        case 10:$month = "of October";
            break;
        case 11:$month = "of November";
            break;
        default: $month = "of December";
            break;
    }
    return " $month ";
}
echo preg_replace_callback("/\/(\d{2})\//", "matchReplace", $date);