<?php
echo "<h3>Wybierz technologie, które znasz:</h3>
<form method='post' action='dopisz.php' style='padding: 3px'>
<div style='background: lightblue; padding: 5px'>";
$tech = ["C", "CPP", "Java", "C#", "Html", "CSS", "XML", "PHP", "JavaScript"];
foreach ($tech as $tec) {
    print("<input type='checkbox' name='tech[]' value='$tec'>$tec <br>");
}
echo "<input type='submit' value='Wyślij', name='submit'>";
echo "</div></form>";