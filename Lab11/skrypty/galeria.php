<?php
$tytul = "<h1>Galeria</h1>";
$katalog = filter_input(INPUT_SERVER,'DOCUMENT_ROOT')."\Lab11\miniaturki"; //jezeli xamp dodaj nazwe glownego folderu
$kat = @opendir($katalog) or die("Nie mozna otworzyc katalogu");
$licznik = 0;
echo "<div class='galeria'>";
while($plik = readdir($kat)){
    if($licznik>=2){
        echo "<img src='miniaturki/".$plik."' class='gallery__img'  alt='$plik'/>";
    }
    $licznik++;
}
closedir($kat);
