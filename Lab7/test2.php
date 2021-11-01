<?php
session_start();
include_once "klasy/User.php";
echo "ID: ".session_id();
echo "</br>";
foreach ($_SESSION as $key => $item){
    echo $key .": ". $item . "</br>";
}
echo "</br>Cookies:<br>";
foreach ($_COOKIE as $item){
    echo $item . "</br>";
}
echo "</br>";
echo "User";
$user = unserialize($_SESSION['user']);
echo "</br>";
$user->show();
echo "<a href=\"test1.php\">test1</a>";