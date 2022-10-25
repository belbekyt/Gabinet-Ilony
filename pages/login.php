<?php 
    require "../phpScripts/requirements.php";
    $mustLogout = false;
    try{
        if(isset($_POST["logMeOut"])) {
            User::logout();
            unset($_POST["logMeOut"]);
        }
    }catch(Exception $e){
        header("LOCATION: ../login.php");
    }
    if(isset($_SESSION["USER"])){
        $mustLogout = true;
        Errors::mustLogout();
    }
?>
<!DOCTYPE html>
<html lang="pl_PL">
<head>
    <?php echo file_get_contents("../components/head.html");?>
    <link rel="shortcut icon" href="../img/logo.png">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/menu.css">
    <link rel="stylesheet" href="../style/login.css">
</head>
<body>
    <nav id="menu-btn">
        <div class="first-menu-block"></div>
        <div class="second-menu-block"></div>
        <div class="third-menu-block"></div>
    </nav>
    <section class="main-login-section">
        <div class="register-table">
            <div class="center">
                <h2>Zarejerstuj się</h2>
                <p>Użyj swoich danych w celu rejestracji</p>
                <form class="register-form" action="../phpScripts/register.php" method="POST" autocomplete="off">
                    <input type="text" name="name" placeholder="Imię" maxlength="200" minlength="2" required 
                    <?php
                        if(isset($_SESSION["restoreTable"]))
                        echo ' value="'. $_SESSION["restoreTable"][0] . '"';
                    ?>>
                    <input type="text" name="surname" placeholder="Nazwisko" maxlength="200" minlength="2" required 
                    <?php
                        if(isset($_SESSION["restoreTable"]))
                        echo ' value="'. $_SESSION["restoreTable"][1] . '"';
                    ?>>
                    <input type="text" name="login" placeholder="Login" maxlength="30" minlength="3" required
                    <?php
                        if(isset($_SESSION["restoreTable"]))
                        echo ' value="'. $_SESSION["restoreTable"][2] . '"';
                    ?>>
                    <?php
                        if(isset($_SESSION["ERROR_USER_ALREADY_EXISTS"])){
                            echo $_SESSION["ERROR_USER_ALREADY_EXISTS"];
                            unset($_SESSION["ERROR_USER_ALREADY_EXISTS"]);
                        }
                    ?>
                    <input type="password" name="pass" placeholder="Hasło" maxlength="20" minlength="8" required
                    <?php
                        if(isset($_SESSION["restoreTable"]))
                        echo ' value="'. $_SESSION["restoreTable"][3] . '"';
                    ?>>
                    <?php
                        if(isset($_SESSION["ERROR_PASS_NOT_IDENTICAL"])){
                            echo $_SESSION["ERROR_PASS_NOT_IDENTICAL"];
                            unset($_SESSION["ERROR_PASS_NOT_IDENTICAL"]);
                        }
                    ?>
                    <input type="password" name="pass1" placeholder="Powtórz hasło" maxlength="20" minlength="8" required
                    <?php
                        if(isset($_SESSION["restoreTable"]))
                        echo ' value="'. $_SESSION["restoreTable"][4] . '"';
                    ?>>
                    <?php
                        if(isset($_SESSION["ERROR_PASS_NOT_IDENTICAL"])){
                            echo $_SESSION["ERROR_PASS_NOT_IDENTICAL"];
                            unset($_SESSION["ERROR_PASS_NOT_IDENTICAL"]);
                        }
                    ?>
                    <input type="email" name="email" placeholder="E-mail" maxlength="70" minlength="4" required
                    <?php
                        if(isset($_SESSION["restoreTable"]))
                        echo ' value="'. $_SESSION["restoreTable"][5] . '"';
                    ?>>
                    <?php
                        if(isset($_SESSION["ERROR_EMAIL_IS_IN_DATABASE"])){
                            echo $_SESSION["ERROR_EMAIL_IS_IN_DATABASE"];
                            unset($_SESSION["ERROR_EMAIL_IS_IN_DATABASE"]);
                        }
                    ?>
                    <input type="tel" name="tel" placeholder="Numer telefonu" required
                    <?php
                        if(isset($_SESSION["restoreTable"]))
                        echo ' value="'. $_SESSION["restoreTable"][6] . '"';
                    ?>>
                    <?php
                        if(isset($_SESSION["ERROR_TEL_IS_IN_DATABASE"])){
                            echo $_SESSION["ERROR_TEL_IS_IN_DATABASE"];
                            unset($_SESSION["ERROR_TEL_IS_IN_DATABASE"]);
                        }
                    ?>
                    <input type="submit" class="special-button" name="REGISTER_CORRECT" value="Zarejestruj">
                </from>
            </div>
        </div>
        <div class="welcome-switch">
            <h2 id="switch-h2">Pierwszy raz?</h2>
            <p id="switch-text">Pozostań z nami w kontakcie, <br/>załóż swoje konto już teraz!</p>
            <button id="login-switch-btn">ZAREJESTRUJ SIĘ</button>
        </div>
        <div class="login-table">
            <div class="center">
                <h2>Zaloguj się</h2>
                <p>Użyj swojego loginu i hasła</p>
                <?php
                    if(isset($_SESSION["ERROR_MUST_LOGOUT"])){
                        echo "Użytkownik " . User::getUser() -> getLogin() . " jest już zalogowany.";
                        echo '<div id="mustLogout">'.$_SESSION["ERROR_MUST_LOGOUT"].
                        '<form method="POST">
                        <input type="submit" value="Wyloguj się" name="logMeOut">
                        </form>
                        <a href="../index.php">
                            <button class="main-site-btn">Strona główna</button>
                        </a>
                        </div>';
                        unset($_SESSION["ERROR_MUST_LOGOUT"]);
                    }else{
                        echo '
                        <form class="login-form" action="../../phpScripts/login.php" method="POST" autocomplete="off">
                        <input type="text" placeholder="Login" name="login" '
                        .(isset($_SESSION["SAVE_LOGIN"]) ? ' value="'.$_SESSION["SAVE_LOGIN"].'"':"")
                        .'><br><input type="password" placeholder="Hasło" name="pass"><br>';
                        if(isset($_SESSION["ERROR_LOG_PASS"])){
                            echo $_SESSION["ERROR_LOG_PASS"];
                            unset($_SESSION["ERROR_LOG_PASS"]);
                        }
                        if(isset($_SESSION["ERROR_USER_NOT_FOUND"])){
                            echo $_SESSION["ERROR_USER_NOT_FOUND"];
                            unset($_SESSION["ERROR_USER_NOT_FOUND"]);
                        }
                        echo '<input type="submit" value="ZALOGUJ" name="LOGIN_CORRECT">
                        </form>';
                        if(isset($_SESSION["SAVE_LOGIN"])) unset($_SESSION["SAVE_LOGIN"]);
                    }               
                ?> 
            </div>
        </div>
    </section>
    <section class="bg-black">
        <ul>
            <a href="../index.php"><li class="menu-li1">Strona główna</li></a>
            <a href="workers.php"><li class="menu-li2">Nasi pracownicy</li></a>
            <a href="offers.php"><li class="menu-li3">Nasze oferty</li></a>
            <a href="visits.php"><li class="menu-li4">Umów się na wizytę</li></a>
            <a href="login.php"><li class="menu-li5">Zaloguj / Zarejerstuj się</li></a>
        </ul>
    </section>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../scripts/main.js"></script>
<script src="../scripts/login.js"></script>
</html>