<?php
echo "<h1 style='padding: 10px'>Dane odebrane z formularza</h1>";
if(isset($_REQUEST['nazwisko'])&&($_REQUEST['nazwisko']!="")) {
    $nazwisko = htmlspecialchars(trim($_REQUEST['nazwisko']));
    echo "Nazwisko: $nazwisko <br>";
}else echo "Nie wpisano nazwiska <br>";
if(isset($_REQUEST['wiek'])&&($_REQUEST['wiek']!="")) {
    $wiek = htmlspecialchars(trim($_REQUEST['wiek']));
    echo "Wiek: $wiek <br>";
}else echo "Nie wpisano wieku <br>";
if(isset($_REQUEST['panstwo'])&&($_REQUEST['panstwo']!="")) {
    $panstwo = htmlspecialchars(trim($_REQUEST['panstwo']));
    echo "Panstwo: $panstwo <br>";
}else echo "Nie zaznaczono państwa <br>";
if(isset($_REQUEST['mail'])&&($_REQUEST['mail']!="")) {
    $mail = htmlspecialchars(trim($_REQUEST['mail']));
    echo "Mail: $mail <br>";
}else echo "Nie wpisano maila <br>";
$tutorial = "";
if(isset($_REQUEST['PHP'])&&($_REQUEST['PHP']!="")) $tutorial = "PHP";

if (isset($_REQUEST['C'])&&($_REQUEST['C']!="")) $tutorial = $tutorial.",C";

if (isset($_REQUEST['Java'])&&($_REQUEST['Java']!="")) $tutorial = $tutorial.",Java";

if ($tutorial=="") echo "Nie wybrano tutoriala <br>";

else echo "Tutorial(e): $tutorial <br>";
if(isset($_REQUEST['zaplata'])&&($_REQUEST['zaplata']!="")) {
    $zaplata = htmlspecialchars(trim($_REQUEST['zaplata']));
    echo "Sposób zapłaty: $zaplata <br>";
}else echo "Nie wybrano zapłaty <br>";
echo "<a href='formularz.html'>Powrót do formularza</a>";