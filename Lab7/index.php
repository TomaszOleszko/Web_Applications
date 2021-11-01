<?php
include_once 'klasy/User.php';
include_once 'klasy/RegistrationForm.php';
include_once 'klasy/Baza.php';

$rf = new RegistrationForm(); //wyświetla formularz rejestracji
if (filter_input(INPUT_POST, 'submit',
    FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
    $user = $rf->checkUser(); //sprawdza poprawność danych
    if ($user === NULL)
        echo "<p>Niepoprawne dane rejestracji.</p>";
    else{
        echo "<p>Poprawne dane rejestracji:</p>";
        $user->show();
        $bd = new Baza("localhost", "root", "", "klienci");
        $user->saveDB($bd);
        User::getAllUsersFromDB($bd);
    }
}