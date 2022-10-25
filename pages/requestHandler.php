<?php
require '../phpScripts/requirements.php';
//require '../phpScripts/checkLogin.php';
User::initSession(User::createTestUser());
$type = User::getUser()->getType();
if($type != "ADMINISTRATOR" && $type != "RECEPCJA"){
    if($type == "LEKARZ") header('Location: visits.php');
    else header('Location: visits.php');
    exit;
}
//DEBUG NOTE
//Wybierz sobie, które połączenie działa
//$conn = new mysqli("127.0.0.1:3307", "root", "root", "gabinet");
$conn = new mysqli("localhost", "root", "", "gabinet");
///////////////////////
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
        <div class="heading"><h2>PROŚBY O WIZYTY</h2></div> 
        <?php
        $query = "SELECT visitrequests.id as `sid`,fullname, TIME_FORMAT(timeProposalFrom, '%H:%i') as timeProposalFrom, TIME_FORMAT(timeProposalTo, '%H:%i') as timeProposalTo, DATE_FORMAT(dateProposalFrom, '%d-%c-%Y') as dateProposalFrom, DATE_FORMAT(dateProposalTo, '%d-%c-%Y') as dateProposalTo, specialisation.name as special, nfz FROM `visitrequests` INNER JOIN specialisation ON specialisation.id = visitrequests.special;";
        if($result = $conn -> query($query)){
            echo '<table><tr><th>Pacjent</th><th>Typ</th><th>NFZ</th><th>Data(od)</th><th>Data(do)</th><th>Godzina(od)</th><th>Godzina(do)</th><th></th></tr>';
            while($r = $result -> fetch_object()){
                echo '<form action="setVisit.php" method="POST">
                <input type="hidden" value="'.$r->sid.'" name="visit">
                <tr>
                <td>'.$r->fullname.'</td>
                <td>'.$r->special.'</td>
                <td>'.
                ($r->nfz == 1 ? '<img src="../img/good.png" width="20px">':'<img src="../img/bad.png" width="20px">').
                '</td>
                <td>'.$r->dateProposalFrom.'</td>
                <td>'.$r->dateProposalTo.'</td>
                <td>'.$r->timeProposalFrom.'</td>
                <td>'.$r->timeProposalTo.'</td>
                <td><input type="submit" value="PRZYPISZ"></td>
                </tr>
                </form>';
            }
            echo('</table>');
            $result -> free_result();
        }
        ?>
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