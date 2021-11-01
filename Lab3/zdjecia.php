<?php
if (isset($_POST['zapisz']) && $_POST['zapisz'] == 'Zapisz' && !isset($_GET['pic'])) {
    if (is_uploaded_file($_FILES['zdjecie']['tmp_name'])) {
        $typ = $_FILES['zdjecie']['type'];
        if ($typ === 'image/jpeg') {
            move_uploaded_file($_FILES['zdjecie']['tmp_name'],'./zdjecia/'. $_FILES['zdjecie']['name']);

            $link = './zdjecia/'.$_FILES['zdjecie']['name'];
            $link2 = $_FILES['zdjecie']['name'];
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

            header('Content-Type: image/jpeg');
            $nowe = imagecreatetruecolor($newW, $newH); //czarny obraz
            $obraz = imagecreatefromjpeg($zdj);
            imagecopyresampled($nowe, $obraz, 0, 0, 0, 0,
                $newW, $newH, $width, $height);
            imagejpeg($nowe, './miniatury/mini-' . $link2, 100);
            echo "nowe=./miniatury/mini-$link2 <br>";
            imagedestroy($nowe);
            imagedestroy($obraz);
            unlink($zdj);

            $dlugosc = strlen($link2);
            $dlugosc -= 4;
            $link = substr($link2, 0, $dlugosc);
            echo "link=$link <br/>";
            header('location:zdjecia.php?pic='.$link);
        }else
            header('location:zdjecia.html');
    }
}

if (isset($_GET['pic']) && !empty($_GET['pic']))
{
    echo '<a href="./zdjecia/' . $_GET['pic'] . '.jpg">Zdjęcie</a><br/>';
    echo '<a href="./miniatury/mini-' . $_GET['pic'] . '.jpg">
        Miniatura</a><br/><br/>';

    $katalog = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT')."/Lab3/miniatury/";
    var_dump($katalog);
    $katalog2 = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT')."/Lab3/zdjecia/";
    $kat = @opendir($katalog) or die("Nie można otworzyć katalogu");
    $licznik = 0;
    echo "<h2>Galeria zdjęć</h2>";
    while($plik = readdir($kat)){
        if($licznik>=2){
            print("<a href = 'zdjecia/".substr($plik, 5)."'><img src='miniatury/".$plik."' alt='$plik'/></a> " );
        }
        $licznik+=1;
    }
    closedir($kat);
    $licznik-=2;
    echo "<br/>Ilość zdjęć w galerii: $licznik";
    echo '<br/><h2><a href="zdjecia.html">Powrót do formularza dodawania zdjęć.</a></h2>';
}


