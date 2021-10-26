<?php
$n = 5678;
$x=10.123456789;
echo "<h1>Pierwszy skrypt<h1><h3>Domyślny format $n, $x<br>Zaokrąglenie do liczby całkowitej ",number_format($x),",<br>z trzema cyframi po kropce x=",number_format($x,3),"</h3>";
