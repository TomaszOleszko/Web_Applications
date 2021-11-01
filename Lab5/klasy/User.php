<?php

class User
{
    const STATUS_USER = 1;
    const STATUS_ADMIN = 2;
    protected $userName;
    protected $passwd;
    protected $fullName;
    protected $email;
    protected $date;
    protected int $status;

    public function __construct($userName, $passwd, $fullName, $email)
    {
        $this->status = User::STATUS_USER;
        $this->userName = $userName;
        $this->passwd = password_hash($passwd, PASSWORD_BCRYPT);
        $this->fullName = $fullName;
        $this->email = $email;
        $this->date = (new DateTime())->format('Y-m-d');;
    }

    public function show()
    {
        echo "Nazwa: " . $this->userName . "<br>" .
            "hasło: " . $this->passwd . "<br>" .
            "imię i nazwisko: " . $this->fullName . "<br>" .
            "email: " . $this->email . "<br>" .
            "data utworzenia konta: " . $this->date . "<br>" .
            "status: " . $this->status . "<br><br>";
    }

    static public function getAllUsers($plik)
    {
        if (file_exists($plik)) {
            $tab = json_decode(file_get_contents($plik));
            if (!empty($tab)) {
                foreach ($tab as $val) {
                    echo "<p>" . $val->userName . " " . $val->fullName . " " . $val->date . " </p>";
                }
            } else {
                echo "<p>Plik $plik pusty</p>";
            }

        } else {
            echo "<p>Plik $plik nie istnieje</p>";
        }

    }

    public function toArray()
    {
        $arr = [
            "userName" => $this->userName,
            "passwd" => $this->passwd,
            "fullName" => $this->fullName,
            "email" => $this->email,
            "date" => $this->date,
            "status" => $this->status
        ];
        return $arr;
    }

    public function save($plik)
    {
        if (file_exists($plik) && !empty(file_get_contents($plik))) {
            $tab = json_decode(file_get_contents($plik), true);
            array_push($tab, $this->toArray());
            file_put_contents($plik, json_encode($tab));
        } else {
            $tab = [];
            array_push($tab, $this->toArray());
            file_put_contents($plik, json_encode($tab));
        }
    }

    public function saveXML($plik)
    {
        if (!file_exists($plik)) {
            $simplexml = new SimpleXMLElement('<?xml version="1.0"?><users/>');
            $user = $simplexml->addChild("user");
            foreach ($this->toArray() as $key => $value){
                $user->addChild($key,$value);
            }
            file_put_contents($plik,$simplexml->asXML());
        }else{
            $xml = simplexml_load_file($plik);
            $xmlCopy = $xml->addChild("user");
            foreach ($this->toArray() as $key => $value){
                $xmlCopy->addChild($key,$value);
            }
            $xml->asXML($plik);
        }
    }

    static public function getAllUsersFromXML($plik)
    {
        if(file_exists($plik) && !empty(simplexml_load_file($plik))){
            $allUsers = simplexml_load_file($plik);
            echo "<ul>";
            foreach ($allUsers as $user){
                $string = "";
                foreach ($user as $key => $value){
                    $string .= $user->$key.", ";
                }
                echo "<li>$string</li>";
            }
            echo "</ul>";
        }else{
            echo "Plik $plik nie istnieje";
        }

    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getPasswd(): string
    {
        return $this->passwd;
    }

    /**
     * @param string $passwd
     */
    public function setPasswd(string $passwd): void
    {
        $this->passwd = $passwd;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
}