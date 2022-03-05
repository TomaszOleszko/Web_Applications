<?php
    echo "<h4>Poniżej znajdują się dane odebrane z formularza:</h4>";
    print("Wybrane tutoriale: ".join(", ",$_REQUEST['jezyk'])."<br>");
    if (isset($_REQUEST['zaplata']))
    {
        echo "Sposób zapłaty:".$_REQUEST['zaplata']." <br />";
    }
    else
    {
        echo "Nie wybrano formy zapłaty";
    }
    $show = true;
    $tablica = ['nazwisko','wiek','panstwo','mail'];
    foreach ($tablica as $item){
        if(!isset($_REQUEST[$item])|| $_REQUEST[$item]==""){
            $show = false;
            echo "Nie podano wszystkich danych</br>";
            break;
        }
    }
    if($show){
        $nazwa = $_GET['nazwisko'];
        $wiek = $_GET['wiek'];
        $panstwo = $_GET['panstwo'];
        $mail = $_GET['mail'];
        printf("<h3><a href='klient.php?nazwisko=$nazwa&wiek=$wiek&panstwo=$panstwo&mail=$mail'>Dane klienta</a></h3>");
    }

    echo "<a href='formularz.php'>Powrót do formularza</a>";
