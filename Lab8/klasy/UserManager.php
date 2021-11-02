<?php

class UserManager
{
    function loginForm(){
        ?>
        <h3>Formularz logowania</h3><p>
        <form action="processLogin.php" method="post">
            Login<input type="text" value="login" name="login"><br>
            Hasło<input type="text" value="passwd" name="passwd"><br>
            <input type="submit" value="Zaloguj" name="zaloguj" />
            <input type="reset" value="Anuluj" name="anuluj">
        </form></p> <?php
    }

    /**
     * @param $db - uchwyt do bazy danych
     * @return mixed id użytkownika zalogowanego lub -1
     */
    function login($db)
    {
        //funkcja sprawdza poprawność logowania
        $args = [
            'login' => FILTER_SANITIZE_ADD_SLASHES,
            'passwd' => FILTER_SANITIZE_ADD_SLASHES
        ];

        //przefiltruj dane z GET (lub z POST) zgodnie z ustawionymi w $args filtrami:
        $dane = filter_input_array(INPUT_POST, $args);
        //sprawdź czy użytkownik o loginie istnieje w tabeli users
        //i czy podane hasło jest poprawne
        $login = $dane["login"];
        $passwd = $dane["passwd"];
        $userId = $db->selectUser($login, $passwd, "users");
        if ($userId >= 0) { //Poprawne dane
            session_start();
            //usuń wszystkie wpisy historyczne dla użytkownika o $userId
            $sql = "DELETE FROM logged_in_users WHERE userId=$userId";
            $db->delete($sql);
            $string = "'".session_id()."','".$userId."','".(new DateTime('now'))->format("Y-m-d H:i:s")."'";
            $db->insert("INSERT INTO logged_in_users(sessionId, userId, lastUpdate) VALUES ($string)");
        }
        return $userId;
    }

    function logout($db){
        session_start();
        $id = session_id();
        $sql = "DELETE FROM logged_in_users WHERE sessionId='".$id."'";
        $db->delete($sql);
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }

        session_destroy();
    }

    /**
     * @param $db - uchwyt do bazy danych
     * @param $id - id sesji szukanego użytkownika
     * @return int $userId - znaleziono wpis z id sesji w tabeli logged_in_users
     *  -1 - nie ma wpisu dla tego id sesji w tabeli logged_in_users
     */
    function getLoggedInUser($db, $id){
        $string = "'".$id."'";
        $userId = $db->select("SELECT userId FROM logged_in_users WHERE sessionId=$string");
        return ($userId > 0) ? $userId : -1;
    }
}