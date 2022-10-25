<head><style>*{background-color: black;color:white;}</style></head>
<?php
require "requirements.php";

/**Sprawdzenie czy użytkownik wypełnił formularz. */
if(!isset($_POST["REGISTER_CORRECT"])){
    header("LOCATION: ../pages/login/register.php");
    exit;
}
unset($_POST["REGISTER_CORRECT"]);

//DEBUG NOTE
//Wybierz sobie, które połączenie działa
//$conn = new mysqli("127.0.0.1:3307", "root", "root", "gabinet");
$conn = new mysqli("localhost", "root", "", "gabinet");
///////////////////////////

/**Sanityzacja danych. */
$name = mysqli_real_escape_string($conn, htmlentities($_POST["name"], ENT_QUOTES, "UTF-8"));
$surname = mysqli_real_escape_string($conn, htmlentities($_POST["surname"], ENT_QUOTES, "UTF-8"));
$password0 = mysqli_real_escape_string($conn, htmlentities($_POST["pass"], ENT_QUOTES, "UTF-8"));
$password1 = mysqli_real_escape_string($conn, htmlentities($_POST["pass1"], ENT_QUOTES, "UTF-8"));
$login = mysqli_real_escape_string($conn, htmlentities($_POST["login"], ENT_QUOTES, "UTF-8"));
$email = mysqli_real_escape_string($conn, htmlentities($_POST["email"], ENT_QUOTES, "UTF-8"));
$tel =  mysqli_real_escape_string($conn, htmlentities($_POST["tel"], ENT_QUOTES, "UTF-8"));

/**Zapisanie danych do rejestracji, y je przywrócić w przypadku błędu rejestracji.*/
$_SESSION["restoreTable"] = [$name, $surname, $login, $password0, $password1, $email, $tel];

$okay = true;



/**Sprawdzenie czy hasła są identyczne. */
if($password0!=$password1){
    Errors::passwordNotIdentical();
    $okay = false;
}

/**Sprawdzenie istnienia użytkownika. */
$userExists = $conn -> query("SELECT * FROM users WHERE `login` = '".$login."';");
if($userExists -> num_rows > 0){
    Errors::userAlreadyExists();
    $okay = false;
}
$userExists -> free_result();

/**Sprawdzenie czy email już nie występuje w bazie. */
$userExists = $conn -> query("SELECT * FROM users WHERE `email` = '".$email."';");
if($userExists -> num_rows > 0){
    Errors::emailAlreadyExists();
    $okay = false;
}
$userExists -> free_result();

/**Sprawdzenie czy telefon już nie występuje w bazie. */
$userExists = $conn -> query("SELECT * FROM users WHERE `tel` = '".$tel."';");
if($userExists -> num_rows > 0){
    Errors::telAlreadyExists();
    $okay = false;
}
$userExists -> free_result();

/**Blokada rejestracji w przypadku błędu. */
if(!$okay){
    $conn -> close();
    header("LOCATION: ../pages/login/register.php");
    exit();
}

/**Zapis danych do bazy danych i rejestracja. */
$query = "INSERT INTO `users`(`name`, `surname`, `login`, `email`, `pass`, `tel`, `type`) VALUES ('$name', '$surname', '$login', '$email', '" . password_hash($password0, PASSWORD_DEFAULT) . "', '$tel', 4)";
$conn -> query($query);
$conn -> close();

/**Automatyczne wylogowanie w przypadku już zalogowanego użytkownika i zalogowanie za pomocą nowego konta. */
if(isset($_SESSION["USER"])) User::logout();
User::initSession(new User($name, $surname, $login, $email, $tel, "PACJENT"));

/**Usunięcie tabeli z danymi rejestracji. */
unset($_SESSION["restoreTable"]);

/**Przekierowanie na stronę główną. */
header("LOCATION: ../index.php");
?>