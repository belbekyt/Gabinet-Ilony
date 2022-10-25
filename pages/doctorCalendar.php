<?php 
require "../phpScripts/requirements.php";
//require "checkLogin.php";
$_SESSION['USER'] = User::createTestUser()->serializeSelf();

//DEBUG NOTE
//$conn = new mysqli("127.0.0.1:3307", "root", "root", "gabinet");
$conn = new mysqli("localhost", "root", "", "gabinet");
///////////////////////////////
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <?php echo file_get_contents("../components/head.html");?>
    <link rel="shortcut icon" href="../img/logo.png">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/menu.css">
    <link rel="stylesheet" href="../style/main-media.css">
    <link rel="stylesheet" href="../style/request-handler.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="../img/logo.png" alt="Logo gabinetu stomatologicznego">
        </div>
        <nav id="menu-btn">
            <div class="first-menu-block"></div>
            <div class="second-menu-block"></div>
            <div class="third-menu-block"></div>
        </nav>
    </header>
    <section class="tables">
        <?php
        $is = $conn -> query("SELECT COUNT(doctors.id), doctors.user as doct FROM doctors INNER JOIN users ON users.id = doctors.user WHERE users.login = '".User::getUser()->getLogin()."'");
        $userID = $is -> fetch_object() -> doct;
        if($is -> num_rows == 0){
            $conn -> close();
            header("Location: visits.php");
            exit;
        }
        $is->free_result();

        $query = "SELECT *,TIME_FORMAT(visitTime, '%H:%i') as vt, DATE_FORMAT(visitDate, '%d-%m-%Y') as vd FROM visit 
        INNER JOIN users ON users.id = visit.patient
        WHERE users.id = $userID AND accepted = true 
        ORDER BY visitDate, visitTime";
        $result = $conn -> query($query);
        ?>
        <div class="heading"><h2>NADCHODZĄCE WIZYTY</h2></div>
        <table>
        <tr>
            <th>Data wizyty</th>
            <th>Godzina</th>
            <th>Pacjent</th>
            <th>Koszt</th>
        </tr>    

        <?php
            while($r = $result->fetch_assoc()){
                echo "<tr>
                <td>".$r["vd"]."</td>
                <td>".$r["vt"]."</td>
                <td>".$r["name"]." ". $r["surname"]."</td>
                <td>".$r["cost"]."</td>
                </tr>";
            }
        ?>
        </table>
    </section>
    <footer>
        <p>&copy;Wszelkie prawa zastrzeżone - Gabinet u Ilony</p>
    </footer>
    <section class="bg-black">
        <ul>
            <a href="../index.php"><li class="menu-li1">Strona główna</li></a>
            <a href="./workers.php"><li class="menu-li2">Nasi pracownicy</li></a>
            <a href="./offers.php"><li class="menu-li3">Nasze oferty</li></a>
            <a href="./visits.php"><li class="menu-li4">Umów się na wizytę</li></a>
            <a href="./login.php"><li class="menu-li5">Zaloguj / Zarejerstuj się</li></a>
        </ul>
    </section>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="../scripts/main.js"></script>
</html>