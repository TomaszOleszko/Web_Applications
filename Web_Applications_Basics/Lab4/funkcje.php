<?php
function dodaj()
{
    walidacja();
}

function pokaz()
{
    if(file_exists("dane.txt")){
        $file_array = file("dane.txt");
        foreach ($file_array as $line) echo $line."<br>";
    }else{
        echo "Brak danych";
    }
}

function pokaz_Zamowienie(string $string)
{
    if(file_exists("dane.txt")){
        $file_array = file("dane.txt");
        foreach ($file_array as $line){
            if(strstr($line,$string.",")){
                echo nl2br($line);
            }
        }
    }else{
        echo "Brak danych";
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
            'options' => ['regexp' => '/((^\Avisa\z$)|(^\Aprzelew\z$)|((^\Aeurocard\z$)))/']]
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
             dopliku("dane.txt", $dane);
         }else {
             echo "<br>Nie poprawnie dane: " . $errors;
         }
}

function dopliku(string $nazwaPliku, array $tablicaDanych)
{
    $dane = "";
    $names = ["nazwisko", "wiek", "panstwo", "mail", "zaplata"];
    foreach ($names as $name){
        $dane .= $tablicaDanych[$name] . " ";
    }
    $dane .= implode(",",$tablicaDanych['jezyk']);
    $dane.=PHP_EOL;
    if(file_put_contents($nazwaPliku,$dane,FILE_APPEND)){
        echo "<p>Zapisano: <br/> $dane</p>";
        extracted($tablicaDanych["wiek"]);
    }else{
        echo "<p>Blad podczas zapisu danych do pliku</p>";
    }
}

function extracted($wiek1): void
{
    $wiek = [1, 0, 0];
    if ($wiek1 < 18) {
        $wiek[1] += 1;
    }
    if ($wiek1 >= 50) {
        $wiek[2] += 1;
    }
    zapisz_statystyki($wiek);
}

function zapisz_statystyki(array $tablicaDanych){
    if(!file_exists("statystyki.txt")){
        $dane = "";
        foreach ($tablicaDanych as $item){
            $dane .= $item . ",";
        }
        if(file_put_contents("statystyki.txt",$dane,FILE_APPEND)){
        }else{
            echo "<p>Blad podczas zapisu danych do pliku statystyki.txt</p>";
        }
    }else{
        $file_array = file("statystyki.txt");
        $string = explode(",",$file_array[0]);
        $plik = fopen("statystyki.txt","w");
        if(!$plik){echo "Nie da sie otworzyc pliku.";}
        else{
            for($i = 0; $i<3; $i++){
                $string[$i] += $tablicaDanych[$i];
            }
            flock($plik,LOCK_EX);
            fwrite($plik,implode(",",$string));
            flock($plik,LOCK_UN);
            fclose($plik);
        }
    }

}
function statystyki()
{
    $stats = ["Liczba wszystkich zamówień:","Liczba zamówień od osób w wieku < 18 lat:","Liczba zamówień od osób w wieku >= 50 lat:"];
    if(file_exists("statystyki.txt")){
        $file_array = file("statystyki.txt");
        $string = explode(",",$file_array[0]);
        for($i = 0; $i<3; $i++){
            echo $stats[$i] . $string[$i] . "<br>";
        }

    }
}