<?php
session_start();

include_once 'klasy/Baza.php';
include_once 'klasy/User.php';
include_once 'klasy/UserManager.php';
echo "<a href='processLogin.php?akcja=wyloguj' >Wyloguj</a> </p>";
echo "<h1>Test Login</h1><h2>Dane zalogowanego użytkownika:</h2>";
$db = new Baza("localhost", "root", "", "klienci");
$id = session_id();
$sql = "select userId from logged_in_users where sessionId='".$id."'";
$mysqli = $db->getMysqli();
$userId = $mysqli->query($sql)->fetch_object()->userId;
$sql = "SELECT * FROM users WHERE klienci.users.id = '".$userId."'";
$data = $db->getMysqli()->query($sql)->fetch_object();
$data_array = get_object_vars($data);
foreach ($data_array as $item){
    echo $item." ";
}