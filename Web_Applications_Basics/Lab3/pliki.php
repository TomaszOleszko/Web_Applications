<?php
echo "<h3>Przykładowy formularz HTML:</h3>
<form method='post' action='pliki.php' style='padding: 3px'>
<div style='background: lightblue; padding: 5px'>
<table>
<tr><td><label for='nazwisko'>Nazwisko:*</label></td>
<td><input type='text' name='nazwisko' id='nazwisko' placeholder='Kowalski' title='Podaj swoje nazwisko' pattern='^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ]{2,20}(-[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ]{2,20}$)?' required></td>
<tr><td><label for='wiek'>Wiek:</label></td>
<td><input type='number' min='0' max='120' step='1' name='wiek' id='wiek' title='Podaj swój wiek'></td></tr>
<tr><td><label for='panstwo'>Państwo:*</label></td>
<td><select required id='panstwo' name='panstwo'><option disabled selected value=''> Wybierz kraj </option>
<option value='Polska'>Poland</option>
<option value='Anglia'>England</option>
<option value='Niemcy'>Germany</option>
<option value='Włochy'>Italy</option></select></td>
</tr><tr><td><label for='mail'>Adres e-mail:*</label></td>
<td><input type='email' name='mail' id='mail' placeholder='kowalski@gmail.com' title='Podaj swój adres e-mail' pattern='[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$' required></td>
</tr></table><span>* - pola wymagane</span><h4>Zamawiam tutorial z języka</h4>";

$jezyki = ["C", "CPP", "Java", "C#", "HTML", "CSS", "XML", "PHP", "JavaScript"];
foreach ($jezyki as $jezyk) {
    print("<input type='checkbox' name='jezyk[]' value='$jezyk'>$jezyk ");
}
echo "<h4>Sposób zapłaty:</h4>";
echo "<input type='radio' name='zaplata' id='eurocard' value='eurocard' required><label for='eurocard'>eurocard</label>
        <input type='radio' name='zaplata' id='visa' value='visa' required><label for='visa'>visa</label>
        <input type='radio' name='zaplata' id='przelew' value='przelew' required><label for='przelew'>przelew bankowy</label><br><br>
        <input type='reset' value='Wyczyść' name='reset'>
        <input type='submit' value='Zapisz' name='submit'>
        <input type='submit' value='Zapisz2' name='submit'>
        <input type='submit' value='Pokaż' name='submit'>
        <input type='submit' value='PHP' name='submit'>
        <input type='submit' value='CPP' name='submit'>
        <input type='submit' value='Java' name='submit'>";

echo "</div></form>";

include_once "funkcje.php";

if (isset($_REQUEST["submit"])) { //jeśli kliknięto przycisk o name=submit
    $akcja = $_REQUEST["submit"]; //odczytaj jego value
    switch ($akcja) {
        case "Zapisz":dodaj();break;
        case "Zapisz2":dodaj_poza();break;
        case "Pokaż":pokaz();break;
        case "Java":pokaz_zamowienie("Java");break;
        case "PHP":pokaz_Zamowienie("PHP");break;
        case "CPP":pokaz_Zamowienie("CPP");break;
    }
}

