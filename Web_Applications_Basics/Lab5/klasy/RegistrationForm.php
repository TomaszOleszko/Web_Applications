<?php

class RegistrationForm
{
    protected $user;
    function __construct(){ ?>
        <h3>Formularz rejestracji</h3><p>
        <form action="index.php" method="post">
            Nazwa użytkownika: <br/><input name="userName" /><br/>
            Hasło: <br/><input name="passwd"/><br/>
            Imię i nazwisko: <br/><input name="fullName" /><br/>
            Email: <br/><input name="email" /><br/>
            <br/><input type="submit" value="Wyślij" name="submit">
        </form></p>
        <?php
    }
    function checkUser(){
        $args = [
            'userName' => ['filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/']],
            'fullName' => ['filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ]{2,20}\s[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ]{2,20}$/']],
            'passwd'=>['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => "/.{4,}/"]],
            'email' => ['filter' => FILTER_VALIDATE_EMAIL]
        ];

        $dane = filter_input_array(INPUT_POST, $args);
        $errors = "";
        foreach ($dane as $key => $val) {
            if ($val === false or $val === NULL) {
                $errors .= $key . " ";
            }
        }
        if ($errors === "") {
        //Dane poprawne – utwórz obiekt user
            $this->user=new User($dane['userName'], $dane['fullName'],
                $dane['email'],$dane['passwd']);
        } else {
            echo "<p>Błędne dane:$errors</p>";
            $this->user = NULL;
        }
        return $this->user;
    }
}

