<?php
session_start();
include_once "klasy/User.php";
$user = new User("imie","haslo","imieinazwisko","email@.pl");
$_SESSION['user'] = serialize($user);
$_SESSION['username'] = 'kubus';
$_SESSION['fullname'] = 'Kubus Puchatek';
$_SESSION['email'] = 'kubus@stumilowylas.pl';
$_SESSION['status'] = 'ADMIN';

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
echo "<a href=\"test2.php\">test2</a>";