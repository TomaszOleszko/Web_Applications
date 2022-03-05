<?php
include_once 'klasy/User.php';
include_once 'klasy/RegistrationForm.php';
//$user1 = new User("Tom","haslo","Tomek Oleszko","Tomek@o.pl");
//$user2 = new User("t","g","ssss","asda");

//$user1->show();
//$user2->show();
//$user2->setUserName("admin");
//$user2->setStatus(User::STATUS_ADMIN);
//$user1->show();
//$user2->show();


$rf = new RegistrationForm(); //wyświetla formularz rejestracji
if (filter_input(INPUT_POST, 'submit',
    FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
    $user = $rf->checkUser(); //sprawdza poprawność danych
    if ($user === NULL)
        echo "<p>Niepoprawne dane rejestracji.</p>";
    else{
        echo "<p>Poprawne dane rejestracji:</p>";
        $user->show();
        $user->save("users.json");
        $user->saveXML("users.xml");
    }
}

//User::getAllUsers("users.json");
User::getAllUsersFromXML("users.xml");
