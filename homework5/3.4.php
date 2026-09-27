<?php
    $html_string = "    <p><abbr title='Hypertext Proccesor'>PHP</abbr> is a <strong>programming language</strong> that is <b>strongly</b> 'bound' with so-called <em>'Web Development'</em> ©</p>   ";
    echo htmlentities(trim(strip_tags($html_string)))
?>