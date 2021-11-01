<?php
function dodaj()
{
    $names = ["nazwisko", "wiek", "panstwo", "mail", "zaplata", "jezyk[]"];
    $dane = "";
    foreach ($names as $name){
        if (isset($_POST[$name])){
            $dane .= htmlspecialchars($_POST[$name]) . " ";
        }
    }
    $dane .= join(",",$_REQUEST['jezyk']) . "\n";
    $wp = fopen("dane.txt","a",1);
    fwrite($wp,$dane);
    fclose($wp);
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
            if(strstr($line,$string)){
                echo nl2br($line);
            }
        }
    }else{
        echo "Brak danych";
    }
}

/*function dodaj_poza(){
    $d_root = $_SERVER['DOCUMENT_ROOT'];
    $names = ["nazwisko", "wiek", "panstwo", "mail", "zaplata", "jezyk[]"];
    $dane = "";
    foreach ($names as $name){
        if (isset($_POST[$name])){
            $dane .= htmlspecialchars($_POST[$name]) . " ";
        }
    }
    $dane .= join(",",$_REQUEST['jezyk']) . "\n";
    $plik=fopen("$d_root/Mojepliki/dane.txt","a");
    fwrite($plik,$dane);
    fclose($plik);

}
*/
foreach ($_SERVER as $item){
    echo $item . "<br>";
}