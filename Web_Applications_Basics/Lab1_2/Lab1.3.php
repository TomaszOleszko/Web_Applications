<?php
function galeria($rows,$cols){
    $j = 1;
    for ($i =1;$i<=$rows;$i++){
        while($j<=$cols*$i){
            $nazwa="obraz$j";
            print("<img src='zdjecia/miniaturki/$nazwa.JPG' alt='$nazwa' />" );
            $j++;
        }
        echo "<br>";
    }
    $nazwa='obraz1';
}
echo "<div style='font-size: x-large;font-weight: bold;text-align:center;background: lightblue; padding: 15px; margin: 5px'>Galeria zdjęć<br>";
galeria(3,3);
echo "</div>";