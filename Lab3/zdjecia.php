<?php
var_dump($_GET);
$tmp_name=$_FILES['zdjecie']['tmp_name'];
$name=$_FILES['zdjecie']['name'];
$size=$_FILES['zdjecie']['size'];
$typ = $_FILES['zdjecie']['type'];
$path=$_SERVER['DOCUMENT_ROOT']."/Mojepliki/".$name;

if(isset($_POST['wys']))echo "wysokosc $_POST[wys]<br>" ;
if(isset($_POST['szer'])) echo "szerokosc $_POST[szer]<br>";
if(isset($_FILES['zdjecie'])) echo "Zdjecie $name<br>";

if(isset($_POST['zapisz']) && $_POST['zapisz'] == 'Zapisz' && !isset($_GET['pic'])){
    if(is_uploaded_file($tmp_name)){
        echo "Plik przeslany na server";
        if($typ === 'image/jpeg'){
            move_uploaded_file($tmp_name,$path);
            header ('Content-Type: image/jpeg');

            $link = $_FILES['zdjecie']['name'];
            $random = uniqid('img_'); //wygenerowanie losowej wartości
            $zdj = $random . '.jpg';
            copy($link, './' . $zdj); //utworzenie kopii zdjęcia

            list($width, $height) = getimagesize($zdj); //pobranie rozmiarów obrazu

            $wys = $_POST['wys']; //wysokość preferowana przez użytkownika
            $szer = $_POST['szer']; //szerokość preferowana przez użytkownika

            $skalaWys = 1;
            $skalaSzer = 1;
            $skala = 1;

            if ($width > $szer) $skalaSzer = $szer / $width;
            if ($height > $wys) $skalaWys = $wys / $height;
            if ($skalaWys <= $skalaSzer) $skala = $skalaWys;
            else $skala = $skalaSzer;

            //ustalenie rozmiarów miniaturki tworzonego zdjęcia:
            $newH = $height * $skala;
            $newW = $width * $skala;

            $nowe = imagecreatetruecolor($newW, $newH); //czarny obraz
            $obraz = imagecreatefromjpeg($zdj);
            imagecopyresampled($nowe, $obraz, 0, 0, 0, 0,
                $newW, $newH, $width, $height);
            imagejpeg($nowe, './mini-' . $link, 100);
            echo "nowe=/mini-$link <br>";
            imagedestroy($nowe);
            imagedestroy($obraz);
            unlink($zdj);
        }
    }
}



