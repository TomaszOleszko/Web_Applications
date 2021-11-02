<?php
$myfiles = array_diff(scandir('miniatury'), array('.', '..'));
echo '<h2>Galeria zdjęć</h2>';
foreach($myfiles as $key=>$value){
    echo "<a href='./zdjecia/".trim($value,"mini-")."'><img src='./miniatury/$value' alt='$value'></a>";
}
echo '<h4>W galerii jest aktualnie '.count($myfiles)." zdjęć</h4>";
?>