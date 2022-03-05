<?php

if (isset($_POST['wys']) && $_POST['wys'] != '' && isset($_POST['szer']) && $_POST['szer'] != '' && !isset($_GET['pic'])) {
    if (is_uploaded_file($_FILES['zdj']['tmp_name'])) {
        $typ = $_FILES['zdj']['type'];
        if ($typ === 'image/jpeg') {
            move_uploaded_file($_FILES['zdj']['tmp_name'], './zdjecia/' .
                basename($_FILES['zdj']['name']));

            $link = $_FILES['zdj']['name'];
            $random = uniqid('img_'); //wygenerowanie losowej wartości
            $zdj = $random . '.jpg';
            copy('./zdjecia/'.$link, './' . $zdj); //utworzenie kopii zdjęcia
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
            imagecopyresampled(
                $nowe,
                $obraz,
                0,
                0,
                0,
                0,
                $newW,
                $newH,
                $width,
                $height
            );
            imagejpeg($nowe, './miniatury/mini-' . $link, 100);
            imagedestroy($nowe);
            imagedestroy($obraz);
            unlink($zdj);
            $dlugosc = strlen($link);
            $dlugosc -= 4;
            echo $dlugosc;
            $link = substr($link, 0, $dlugosc);
            echo "link=$link <br/>";
            header('location:zdjecia.php?pic=' . $link);
        }
    }
}

if (isset($_GET['pic']) && !empty($_GET['pic']))
 {
 echo '<a href="./zdjecia/' . $_GET['pic'] . '.jpg">Zdjęcie</a><br/>';
 echo '<a href="./miniatury/mini-' . $_GET['pic'] . '.jpg">
 Miniatura</a><br/><br/>';
 echo '<a href="zdjecia.html">Powrót</a>';
 echo '<br><a href="galeria.php">Dalej</a>';
 }
