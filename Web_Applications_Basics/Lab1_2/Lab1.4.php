<?php
function show($tab){
    for($i=0;$i<count($tab);$i++) {
        printf("tablica = $tab[$i]<br>");
    }
}
function is($zmienna,$tekst){
    if(is_bool($zmienna)){
        echo "$tekst jest boolem<br>";
    }else{
        echo "$tekst nie jest boolem<br>";
    }
    if(is_int($zmienna)){
        echo "$tekst jest intem<br>";
    }else{
        echo "$tekst nie jest intem<br>";
    }
    if(is_numeric($zmienna)){
        echo "$tekst jest numeric<br>";
    }else{
        echo "$tekst nie jest numeric<br>";
    }
    if(is_string($zmienna)){
        echo "$tekst jest stringiem<br>";
    }else{
        echo "$tekst nie jest stringiem<br>";
    }
    if(is_array($zmienna)){
        echo "$tekst jest tablica<br>";
    }else{
        echo "$tekst nie jest tablica<br>";
    }
    if(is_object($zmienna)){
        echo "$tekst jest obiektem<br>";
    }else{
        echo "$tekst nie jest obiektem<br>";
    }
}
$integer = 1234;
$float = 567.789;
$jeden = 1;
$zero = 0;
$prawda = true;
$string0 = "0";
$string = "Typy w PHP";
$tablica = [1,2,3,4];
$pusta = [];
$kolory = ["ziel","czer","nieb"];
$tab = ["Agata","aga",4.67,true];
$data = new DateTime();
#$data = $data->format('Y-m-d h/m/s');
printf("integer = $integer<br>"
    . "float = $float<br>"
    . "jeden = $jeden<br>"
    . "zero = $zero<br>"
    . "prawda = $prawda<br>"
    . "string = $string0<br>");
show($tablica);
show($pusta);
show($kolory);
show($tab);
#echo "data = $data<br>";
#is($data,"data");
print_r($tab);
