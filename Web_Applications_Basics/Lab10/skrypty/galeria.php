<?php
$tytul = "Galeria";
$katalog = filter_input(INPUT_SERVER,'DOCUMENT_ROOT')."\Lab10\miniaturki"; //jezeli xamp dodaj aplikacje
$kat = @opendir($katalog) or die("Nie mozna otworzyc katalogu");
$licznik = 0;
$zawartosc = "<div class='galeria'>";
while($plik = readdir($kat)){
    if($licznik>=2){
        $zawartosc .= "<img src='miniaturki/".$plik."' class='gallery__img'  alt='$plik'/>";
    }
    $licznik++;
}
closedir($kat);
