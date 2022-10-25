<head><style>*{background-color: black;color:white;}</style></head>
<?php
/**Dodanie pliku z wymaganymi elementami do poprawnego działania.*/
require "requirements.php";

/**Sprawdzenie czy użytkownik wypełnił formularz. */
if(!isset($_POST["LOGIN_CORRECT"])){
    header("LOCATION: ../index.php");
    exit;
}
unset($_POST["LOGIN_CORRECT"]);

//DEBUG NOTE
//Wybierz sobie, które połączenie działa
//$conn = new mysqli("127.0.0.1:3307", "root", "root", "gabinet");
$conn = new mysqli("localhost", "root", "", "gabinet");
///////////////////////

/**Sanityzacja danych. */
$login = mysqli_real_escape_string($conn, htmlentities($_POST["login"], ENT_QUOTES, "UTF-8"));
$pass = mysqli_real_escape_string($conn, htmlentities($_POST["pass"], ENT_QUOTES, "UTF-8"));


/**Stworzenie polecenia SQL */
$_SESSION["SAVE_LOGIN"] = $login;
$query = "SELECT pass FROM users WHERE `login` = '" . $login . "';";
$result = $conn -> query($query);

/**Sprawdzenie czy użytkownik o podanym loginie istnieje. */
if($result -> num_rows > 0){

    /**Pobranie hash'a hasła z bazy. */
    $passHash = $result -> fetch_object() -> pass;
    $result -> free_result();

    /**Weryfikacja hasła */
    if(password_verify($pass, $passHash)){
        /**Pobranie danych o użytkowniku w celu stworzenia objektu użytkownika. */
        $userResult = $conn -> query("SELECT users.name as 'name', surname, email, tel, accounttype.name as 'type' FROM users INNER JOIN accounttype ON users.type = accounttype.id WHERE `login` = '".$login."';");
        $user = $userResult -> fetch_object();

        /**Stworzenie nowego użytkownika */
        User::initSession(new User(
            $user -> name, 
            $user -> surname, 
            $login, 
            $user -> email, 
            $user -> tel, 
            $user -> type
        ));
        $userResult -> free_result();
        
        /**Przekierowanie do strony głównej */
        header("LOCATION: ../index.php");
    }else{
        /**Wywołanie błędu logowania - błędny login lub hasło. */
        Errors::loginOrPassword();
        header("LOCATION: ../pages/login/login.php");
    }
}else{
    /**Wywołanie błędu logowania - użytkownik nie istnieje. */
    Errors::userNotFound();
    header("LOCATION: ../pages/login/login.php");
}

/**Usunięcie zapisanych danych do logowania. */
if(isset($_SESSION["SAVE_LOGIN"])) unset($_SESSION["SAVE_LOGIN"]);
$conn -> close();
?>