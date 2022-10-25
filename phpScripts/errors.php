<?php
/**
 * Klasa błędów na stronie. 
 * Używa statycznych metod, by wyświetlić konkretny i spójny na całej stronie rodzaj błędu.
 * @method static void loginOrPassword()
 * @method static void userNotFound()
 * @method static void userAlreadyExists()
 * @method static void emailAlreadyExists()
 * @method static void telAlreadyExists()
 * @method static void passwordNotIdentical()
 * @method static void mustLogout()
 * @final
 * @author Mateusz Targoński
 */
final class Errors{
    private const LOGIN_OR_PASSWORD = 'Błędny login lub hasło';
    private const USER_NOT_FOUND = 'Nie znaleziono użytkownika';
    private const USER_ALREADY_EXISTS = 'Użytkownik już istnieje';
    private const EMAIL_IS_IN_DATABASE = 'Ten e-mail jest już zarejestrowany na portalu';
    private const TEL_IS_IN_DATABASE = 'Ten numer telefonu jest już zarejestrowany na portalu';
    private const PASS_NOT_IDENTICAL = 'Hasła nie są identyczne';
    private const MUST_LOGOUT = "Użytkownik musi być wylogowany, aby ponownie móc się zalogować";


    /**
     * Prywatna metoda do generowania czerwonego tekstu na stronie.
     * @param string $text
     * @return string
     * @final @static
     */
    private static final function redQuote($text):string{
        return '<span style="color:red; font-weight: bold; font-family: arial;">'.$text.".</span><br>";
    }

    /**
     * Metoda wyświetlająca błąd: 'Błędny login lub hasło'.
     * @return void
     * @final @static
     */
    public static final function loginOrPassword(){
        $_SESSION["ERROR_LOG_PASS"] = self::redQuote(self::LOGIN_OR_PASSWORD);
    }

    /**
     * Metoda wyświetlająca błąd: 'Nie znaleziono użytkownika'.
     * @return void
     * @final @static
     */
    public static final function userNotFound(){
        $_SESSION["ERROR_USER_NOT_FOUND"] = self::redQuote(self::USER_NOT_FOUND);
    }

    /**
     * Metoda wyświetlająca błąd: 'Użytkownik już ustnieje'.
     * @return void
     * @final @static
     */
    public static final function userAlreadyExists(){
        $_SESSION["ERROR_USER_ALREADY_EXISTS"] = self::redQuote(self::USER_ALREADY_EXISTS);
    }

    /**
     * Metoda wyświetlająca błąd: 'Ten e-mail jest już zarejestrowany na portalu'.
     * @return void
     * @final @static
     */
    public static final function emailAlreadyExists(){
        $_SESSION["ERROR_EMAIL_IS_IN_DATABASE"] = self::redQuote(self::EMAIL_IS_IN_DATABASE);
    }

    /**
     * Metoda wyświetlająca błąd: 'Ten numer telefonu jest już zarejestrowany na portalu'.
     * @return void
     * @final @static
     */
    public static final function telAlreadyExists(){
        $_SESSION["ERROR_TEL_IS_IN_DATABASE"] = self::redQuote(self::TEL_IS_IN_DATABASE);
    }

    /**
     * Metoda wyświetlająca błąd: 'Hasła nie są identyczne'.
     * @return void
     * @final @static
     */
    public static final function passwordNotIdentical(){
        $_SESSION["ERROR_PASS_NOT_IDENTICAL"] = self::redQuote(self::PASS_NOT_IDENTICAL);
    }

    /**
     * Metoda wyświetlająca błąd: 'Użytkownik musi być wylogowany, aby ponownie móc się zalogować'.
     * @return void
     * @final @static
     */
    public static final function mustLogout(){
        $_SESSION["ERROR_MUST_LOGOUT"] = self::redQuote(self::MUST_LOGOUT);
    }
    
}
?>