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
    <link rel="stylesheet" href="../style/set-visit.css">
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
        <div class="heading"><h2>WIZYTA</h2></div> 
        <form action="../phpScripts/createVisit.php" method="POST">
        <?php
        $visit = $_POST['visit'];
        $query = "SELECT visitrequests.id as `sid`, fullname, 
        TIME_FORMAT(timeProposalFrom, '%H:%i') as timeProposalFrom, 
        TIME_FORMAT(timeProposalTo, '%H:%i') as timeProposalTo, 
        dateProposalFrom,
        dateProposalTo,
        user, nfz,
        visitrequests.special as idSpecial,
        specialisation.name as special, nfz 
        FROM `visitrequests` 
        INNER JOIN specialisation ON specialisation.id = visitrequests.special;";
        $result = $conn -> query($query);
        $r = $result -> fetch_object();
        $result -> free_result();

        echo '<table class="table-main">
        <tr><th>Imię i nazwisko:</th><td>'.$r->fullname.'</td></tr>
        <tr><th>Specjalizacja:</th><td>'.$r->special.'</td></tr>
        <tr>
        <th>Data wizyty:</th><td><input type="date" name="visitDate"
        min="'. $r->dateProposalFrom.'" max="'. $r->dateProposalTo.'" value="'. $r->dateProposalFrom.'" required></td>
        </tr>
        <tr>
        <th>Godzina wizyty</th><td>
        <input type="time" min="'.$r->timeProposalFrom.'" max="'.$r->timeProposalTo.'" value="'. $r->timeProposalFrom.'" name="visitTime" required> Prośba: '.$r->timeProposalFrom. " - ".$r->timeProposalTo.'
        </td>
        </tr>
        <tr><th>Lekarz</th><td>
        <input type="hidden" value="'.$r->sid.'" name="sid">
        <input type="hidden" value="'.$r->user.'" name="user">
        <input type="hidden" value="'.$r->nfz.'" name="nfz">
        <select name="doc">';
        $type = $r->idSpecial;




        $result = $conn -> query("SELECT * FROM doctors INNER JOIN users ON users.id = doctors.user WHERE specialisation = $type");

        while($doc = $result -> fetch_object()){
            echo '<option value="'.$doc->id.'">'.$doc->name. " " . $doc -> surname.'</option>';
        }
        echo '</select></td></tr>
        <tr><th>Koszt</th><td><input type="number" name="cost" value="0" step="0.01"></td></tr>';
        $result -> free_result();
        ?>

        </table>
        <input type="submit" value="Zatwierdź wizytę" name="sentCorrectly">
    </section>
    <section class="tables">
        <div class="heading"><h2>NADCHODZĄCE WIZYTY</h2></div>
        <table class="table-incoming">
            <tr class="table-heading">
            <th>Data</th>
            <th>Godzina</th>
            <th>Lekarz</th>
            </tr>
        <?php
        $query = "SELECT *,TIME_FORMAT(visitTime, '%H:%i') as vt, DATE_FORMAT(visitDate, '%d-%m-%Y') as vd FROM visit INNER JOIN users ON users.id = visit.doctor WHERE accepted = true AND visitDate BETWEEN '$r->dateProposalFrom' AND '$r->dateProposalTo'";
        if($a = $conn -> query($query)){
            while($b = $a -> fetch_object())
                echo '<tr>
                    <td>'.$b->vd.'</td>
                    <td>'.$b->vt.'</td>
                    <td>'.$b->name." ". $b->surname . '</td>

                </tr>';
        $a->free_result();
        }

        $conn -> close();
        ?>
        </table>
        </form>
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