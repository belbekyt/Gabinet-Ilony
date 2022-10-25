<?php

/**
 * Klasa użytkownika.
 * Przechowuje dane użytkownika sesji. Inicjlizowany podczas logowania.
 * @author Mateusz Targoński
 */
class User {
    /** @var string $name Przechowuje imię użytkownika*/
    private $name;
    /** @var string $surname Przechowuje nazwisko użytkownika*/
    private $surname;
    /** @var string $email Przechowuje email użytkownika*/
    private $email;
    /** @var string $tel Przechowuje numer telefonu użytkownika*/
    private $tel;
    /** @var string $type Przechowuje typ użytkownika*/
    private $type;
    /** @var string $login Przechowuje login użytkownika*/
    private $login;

    /**
     * Konstruktor klasy User. Używany podczas logowania.
     * @param string $name Imię użytkownika 
     * @param string $surname Nazwisko użytkownika 
     * @param string $login Login użytkownika
     * @param string $email E-mail użytkownika
     * @param string $tel Telefon użytkownika
     * @param string $type Typ użytkownika
     * @return void
     */
    function __construct(string $name, string $surname, string $login, 
        string $email,  string $tel, string $type){

        $this -> name = $name;
        $this -> surname = $surname;
        $this -> login = $login;
        $this -> email = $email;
        $this -> tel = $tel;
        $this -> type = $type;
    }
    /**
     * Destruktor klasy User. Używany podczas wylogowywania. 
     * Usuwa wszystkie ustawione pola klasy.
     * @return void
     */
    function __destruct(){
        unset($this -> name);
        unset($this -> surname);
        unset($this -> login);
        unset($this -> email);
        unset($this -> tel);
        unset($this -> type);
    }

    /**
     * @method string getSession() Zwraca zawartość zmiennej sesyjnej, w której zapisany jest użytkownik.
     * @return string
     * @static @final
     */
    public static final function getSession():string{
        return $_SESSION["USER"];
    }

    /**
     * Wylogowuje użytkownika oraz czyści sesję.
     * @return void
     * @static @final
     */
    public static final function logout():void{
        if(isset($_SESSION["USER"])){
            self::getUser() -> __destruct();
            unset($_SESSION["USER"]);
        }
    }

    /**
     * Zwraca odserializowaną zawartość zmiennej sesyjnej, w której zapisany jest użytkownik.
     * @return User
     * @static @final
     */
    public static final function getUser():User{
        return unserialize($_SESSION["USER"]);
    }
    
    /**
     * Serializuje objekt użytkownika i wysyła go do zmiennej sesyjnej.
     * @return void
     * @static @final
     * @param User $user Użytkownik
     */
    public static final function initSession(User $user):void{
        $_SESSION["USER"] = $user -> serializeSelf();
    }

     /**
     * Serializuje objekt użytkownika.
     * @return string 
     * @final
     */
    public final function serializeSelf():string{
        return serialize($this);
    }

    /**
     * Zwraca imię użytkownika.
     * @return string Imię
     */
    public function getName():string{
        return $this -> name;
    }
    /**
     * Zwraca nazwisko użytkownika.
     * @return string Nazwisko
     */
    public function getSurname():string{
        return $this -> surname;
    }
    /**
     * Zwraca imię i nazwisko użytkownika.
     * @return string Imię Nazwisko
     */
    public function getFullName():string{
        return $this -> getName() . " " . $this -> getSurname();
    }
    /**
     * Zwraca numer telefonu użytkownika.
     * @return string
     */
    public function getTel():string{
        return $this -> tel;
    }
    /**
     * Zwraca e-mail użytkownika.
     * @return string
     */
    public function getEmail():string{
        return $this -> email;
    }
    /**
     * Zwraca typ użytkownika.
     * @return string
     */
    public function getType():string{
        return $this -> type;
    }
    /**
     * Zwraca login użytkownika.
     * @return string
     */
    public function getLogin():string{
        return $this -> login;
    }

    /**
     * Zwraca pełny opis użytkownika.
     * @return string Imię Nazwisko / E-mail / Numer_Telefonu / Login / Typ
     */
    public function __toString():string{
        return $this -> getFullName() . " / " 
        . $this -> getEmail() . " / " 
        . $this -> getTel() . " / " 
        . $this -> getLogin() . " / "
        . $this -> getType();
    }

    /** 
     * Zwraca objekt testowego użytkownika.
     * @var string $name TestoweImie 
     * @var string $surname TestoweNazwisko 
     * @var string $login TestowyLogin
     * @var string $email TestowyEmail@mail.com
     * @var string $tel 123123123
     * @var string $type ADMINISTRATOR
     * @static @final
     * @return User
     * 
    */
    public static final function createTestUser():User{
        return new User("TestoweImie", "TestoweNazwisko", "TestowyLogin", "TestowyEmail@mail.com", "123123123", "ADMINISTRATOR");
    }
}