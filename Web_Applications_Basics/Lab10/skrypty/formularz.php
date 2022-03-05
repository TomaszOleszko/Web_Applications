<?php
function drukuj_form(){
    $zawartosc ="<h3>Przykładowy formularz HTML:</h3>
           <form method='post' action='?strona=formularz' style='padding: 3px'>
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
        $zawartosc .= "<input type='checkbox' name='jezyk[]' value='$jezyk'>$jezyk ";
    }
    $zawartosc .= "<h4>Sposób zapłaty:</h4>
           <input type='radio' name='zaplata' id='Master Card' value='Master Card' ><label for='Master Card'>eurocard</label>
           <input type='radio' name='zaplata' id='Visa' value='Visa' ><label for='Visa'>visa</label>
           <input type='radio' name='zaplata' id='Przelew' value='Przelew' ><label for='Przelew'>przelew bankowy</label><br><br>
           <input type='reset' value='Wyczyść' name='reset'>
           <input type='submit' value='Dodaj' name='submit'>
           <input type='submit' value='Pokaż' name='submit'>
           <input type='submit' value='PHP' name='submit'>
           <input type='submit' value='CPP' name='submit'>
           <input type='submit' value='Java' name='submit'>
           </div></form>";
    return $zawartosc;
}

function dodajdoBD($bd){
    if($dane = walidacja()){
        $data = ["nazwisko","wiek","panstwo","mail","zaplata"];
        $values = "";
        foreach ($data as $item){
            $values .= "'".$dane[$item]."',";
        }
        $values .= "'".implode(",",$dane['jezyk'])."'";
        $sql = "INSERT INTO klienci (Nazwisko, Wiek, Panstwo, Email, Platnosc,Zamowienie ) VALUES ($values)";
        if($bd->insert($sql)){
        }else{
            echo "blad";
        }
    }
}
function walidacja() {
    $args = ['nazwisko' => ['filter' => FILTER_VALIDATE_REGEXP,
        'options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
        'wiek' => FILTER_VALIDATE_INT,
        'panstwo' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'mail' => ['filter' => FILTER_VALIDATE_EMAIL],
        'jezyk' => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'flags' => FILTER_REQUIRE_ARRAY],
        'zaplata' => ['filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['regexp' => '/((^\AVisa\z$)|(^\APrzelew\z$)|((^\AMaster Card\z$)))/']]
    ];

    //przefiltruj dane z GET/POST zgodnie z ustawionymi w $args filtrami:
    $dane = filter_input_array(INPUT_POST, $args);
    //pokaż tablicę po przefiltrowaniu - sprawdź wyniki filtrowania:

    //Sprawdź czy dane w tablicy $dane nie zawierają błędów walidacji:
    $errors = "";
    foreach ($dane as $key => $val) {
        if ($val === false or $val === NULL) {
            $errors .= $key . " ";
        }
    }
    if ($errors === "") {
        //Dane poprawne - zapisz do pliku
        //wykorzystaj pomocniczą funkcję:
        return $dane;
    }else {
        echo "<br>Nie poprawnie dane: " . $errors;
        return false;
    }
}

function pokaz_Zamowienie(string $string, $bd)
{
    $sql = "SELECT * from klienci where klienci.klienci.Zamowienie REGEXP '[[:<:]]".$string."[[:>:]]'";
    return $bd->select($sql,["Nazwisko","Zamowienie"]);
}

include_once "klasy/Baza.php";
$tytul="Formularz zamówienia";
$zawartosc=drukuj_form();
$bd = new Baza("localhost", "root", "", "klienci");
if (filter_input(INPUT_POST, "submit")) {
    $akcja = filter_input(INPUT_POST, "submit");
    switch ($akcja) {
        case "Dodaj" : dodajdoBD($bd);
            break;
        case "Pokaż" : $zawartosc.= $bd->select("select * from klienci",
            ["Email", "Zamowienie"]);
            break;
        case "PHP" :
            $zawartosc.= pokaz_Zamowienie("PHP",$bd);
            break;
        case "CPP" :
            $zawartosc.= pokaz_Zamowienie("CPP",$bd);
            break;
        case "Java" :
            $zawartosc.= pokaz_Zamowienie("Java",$bd);
            break;

    }
}
