<?php

function pokaz_Zamowienie(string $string, $bd)
{
    $sql = "SELECT * from klienci where klienci.klienci.Zamowienie REGEXP '[[:<:]]".$string."[[:>:]]'";
    echo $bd->select($sql,["Nazwisko","Zamowienie"]);
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
            echo "Zapisano";
        }else{
            echo "blad";
        }
    }
}
