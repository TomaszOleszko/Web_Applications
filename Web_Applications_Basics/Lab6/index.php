<?php
echo "<h3>Przykładowy formularz HTML:</h3>
<form method='post' action='index.php' style='padding: 3px'>
<div style='background: lightblue; padding: 5px'>
<table>
<tr><td><label for='nazwisko'>Nazwisko:*</label></td>
<td><input type='text' name='nazwisko' id='nazwisko' placeholder='Kowalski' title='Podaj swoje nazwisko' pattern='^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ]{2,20}(-[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ]{2,20}$)?' ></td>
<tr><td><label for='wiek'>Wiek:</label></td>
<td><input type='number' min='1' max='120' step='1' name='wiek' id='wiek' title='Podaj swój wiek'></td></tr>
<tr><td><label for='panstwo'>Państwo:*</label></td>
<td><select  id='panstwo' name='panstwo'><option disabled selected value=''> Wybierz kraj </option>
<option value='Polska'>Poland</option>
<option value='Wielka Brytania'>England</option>
<option value='Niemcy'>Germany</option>
<option value='Czechy'>Czechy</option></select></td>
</tr><tr><td><label for='mail'>Adres e-mail:*</label></td>
<td><input type='email' name='mail' id='mail' placeholder='kowalski@gmail.com' title='Podaj swój adres e-mail' pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$' ></td>
</tr></table><span>* - pola wymagane</span><h4>Zamawiam tutorial z języka</h4>";

$jezyki = ["C", "CPP", "Java", "C#", "HTML", "CSS", "XML", "PHP", "JavaScript"];
foreach ($jezyki as $jezyk) {
    print("<input type='checkbox' name='jezyk[]' value='$jezyk'>$jezyk ");
}
echo "<h4>Sposób zapłaty:</h4>";
echo "<input type='radio' name='zaplata' id='Master Card' value='Master Card' ><label for='Master Card'>eurocard</label>
        <input type='radio' name='zaplata' id='Visa' value='Visa' ><label for='Visa'>visa</label>
        <input type='radio' name='zaplata' id='Przelew' value='Przelew' ><label for='Przelew'>przelew bankowy</label><br><br>
        <input type='reset' value='Wyczyść' name='reset'>
        <input type='submit' value='Dodaj' name='submit'>
        <input type='submit' value='Pokaż' name='submit'>
        <input type='submit' value='PHP' name='submit'>
        <input type='submit' value='CPP' name='submit'>
        <input type='submit' value='Java' name='submit'>
        <input type='submit' value='Statystyki' name='submit'>";

echo "</div></form>";
include_once "funkcje.php";
include_once "klasy/Baza.php";
include_once "klasy/BazaPDO.php";
//tworzymy uchwyt do bazy danych:
//$bd = new Baza("localhost", "root", "", "klienci");
$bd = new BazaPDO("mysql:host=localhost;dbname=klienci","root","");
if (filter_input(INPUT_POST, "submit")) {
    $akcja = filter_input(INPUT_POST, "submit");
    switch ($akcja) {
        case "Dodaj" :
            dodajdoBD($bd);
            break;
        case "Pokaż" :
            echo $bd->select("select Nazwisko,Wiek,Email,Zamowienie,Platnosc from klienci", ["Nazwisko","Wiek","Email","Zamowienie","Platnosc"]);
            break;
        case "PHP" :
            pokaz_Zamowienie("PHP",$bd);
            break;
        case "CPP" :
            pokaz_Zamowienie("CPP",$bd);
            break;
        case "Java" :
            pokaz_Zamowienie("Java",$bd);
            break;
    }
}
