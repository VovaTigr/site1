<?php
// 3.7 - The School tasks

$school_task = round(rand(1, 13));
echo "<h2>Today's school task is: </h2>\n";

switch ($school_task) {
    case 1: echo "<p></p>Study Mathematics</p>"; break;
    case 2: echo "<p>Study Science</p>"; break;
    case 3: echo "<p>Study English</p>"; break;
    case 4: echo "<p>Study History</p>"; break;
    case 5: echo "<p>Study Geography</p>"; break;
    case 6: echo "<p>Study Art</p>"; break;
    case 7: echo "<p>Study Music</p>"; break;
    case 8: echo "<p>Study Physical Education</p>"; break;
    case 9: echo "<p>Study Computer Science</p>"; break;
    case 10: echo "<p>Study Foreign Language</p>"; break;
    case 11: echo "<p>Study Economics</p>"; break;
    case 12: echo "<p>Study Psychology</p>"; break;
    case 13: echo "<p>Study Philosophy</p>"; break;
    default: echo "<p>You aren't even allowed to study</p>"; break;
}
echo "<hr>\n";