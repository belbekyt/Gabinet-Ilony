<?php 
require "../phpScripts/requirements.php";
//require "../phpScripts/checkLogin.php";
User::initSession(User::createTestUser());

//DEBUG NOTE
//Wybierz sobie, które połączenie działa
//$conn = new mysqli("127.0.0.1:3307", "root", "root", "gabinet");
$conn = new mysqli("localhost", "root", "", "gabinet");
///////////////////////

?> 
<!DOCTYPE html>
<html lang="pl-Pl">
<head>
    <?php echo file_get_contents("../components/head.html");?>
    <link rel="shortcut icon" href="../img/logo.png">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/main-media.css">
    <link rel="stylesheet" href="../style/menu.css">
    <link rel="stylesheet" href="../style/visits.css">
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
    <div class="heading"><h2>TWOJE WIZYTY</h2></div>

<?php
$login = User::getUser() -> getLogin();
$id = $conn -> query("SELECT id FROM users WHERE `login` = '".User::getUser()->getLogin()."'") -> fetch_object() -> id;
$query = "SELECT *, TIME_FORMAT(visitTime, '%H:%i') as visitTime,DATE_FORMAT(visitDate, '%d-%m-%Y') as visitDate, visit.id as visId FROM `visit`INNER JOIN users ON users.id = visit.doctor WHERE `patient` = $id AND `accepted` = true;";

if($result = $conn -> query($query)){
    echo '<table><tr class="table-heading"><th>Data</th><th>Godzina</th><th>Lekarz</th><th>Cena</th><th>NFZ</th></tr>';
    while($r = $result -> fetch_object()) 
        echo '<tr>
        <td>'.$r->visitDate.'</td>
        <td>'.$r->visitTime.'</td>
        <td>'.$r->name." ".$r->surname.'</td>
        <td>'.$r->cost.' zł</td>
        <td>'.
        ($r->nfz == 1 ? '<img src="../img/good.png" width="20px">':'<img src="../img/bad.png" width="20px">').
        '</td>
        </tr>';
    echo '</table>';
    $result -> free_result();
    }
    else echo "Brak wizyt do pokazania.";
?> 

    <div class="heading"><h2>PROPONOWANE TERMINY</h2></div>

<?php
$query = "SELECT cost, surname,`name`, nfz, TIME_FORMAT(visitTime, '%H:%i') as visitTime, DATE_FORMAT(visitDate, '%d-%m-%Y') as visitDate, visit.id as visId FROM `visit` INNER JOIN users ON users.id = visit.doctor
WHERE `patient` = $id AND `accepted` = false;";
if($result = $conn -> query($query)){
    echo '<table><tr class="table-heading"><th>Data</th><th>Godzina</th><th>Lekarz</th><th>Cena</th><th>NFZ</th></tr>';
    while($r = $result -> fetch_object()) 
        echo '<tr>
        <td>'.$r->visitDate.'</td>
        <td>'.$r->visitTime.'</td>
        <td>'.$r->name." ".$r->surname.'</td>
        <td>'.$r->cost.' zł</td>
        <td>'.
        ($r->nfz == 1 ? '<img src="../img/good.png" width="20px">':'<img src="../img/bad.png" width="20px">').
        '</td>
        <form action="../phpScripts/decideVisit.php" method="POST">
        <input type="hidden" value="'.$r->visId.'" name="visitID">
        <td><input type="submit" value="Zatwierdź" name="sub"></td>
        <td><input type="submit" value="Odrzuć" name="sub"></td>
        </form>
        </tr>';
    echo "</table>";
    $result->free_result();
    }
else echo "Brak propozycji do pokazania.";
?>

    <div class="heading"><h2>TWOJE PROŚBY O WIZYTĘ</h2></div>

<?php
$query = "SELECT nfz, note, visitrequests.id as visID,
specialisation.name as special,
DATE_FORMAT(dateProposalFrom, '%d-%m-%Y') as dateProposalFrom,
DATE_FORMAT(dateProposalTo, '%d-%m-%Y') as dateProposalTo,
TIME_FORMAT(timeProposalFrom, '%H:%i') as timeProposalFrom, 
TIME_FORMAT(timeProposalTo, '%H:%i') as timeProposalTo 
FROM `visitrequests` INNER JOIN specialisation ON specialisation.id = visitrequests.special WHERE user = $id;";

if($result = $conn -> query($query)){
    echo '<table><tr class="table-heading"><th>Typ</th><th>Data(od)</th><th>Data(do)</th><th>Godzina(od)</th><th>Godzina(do)</th><th>NFZ</th><th>Nota</th><th></th></tr>';
    while($r = $result -> fetch_object()) 
        echo '<tr>
        <td>'.$r->special.'</td>
        <td>'.$r->dateProposalFrom.'</td>
        <td>'.$r->dateProposalTo.'</td>
        <td>'.$r->timeProposalFrom.'</td>
        <td>'.$r->timeProposalTo.'</td>
        <td>'.
        ($r->nfz == 1 ? '<img src="../img/good.png" width="20px">':'<img src="../img/bad.png" width="20px">').
        '</td>
        <td>'.$r->note.'</td>
        
        <form action="../phpScripts/decideVisit.php" method="POST">
        <input type="hidden" value="'.$r->visID.'" name="visitID">
        <td><input class="remove-btn" type="submit" value="Usuń" name="sub"></td>
        </form>
        </tr>';
    echo "</table>";
    $result -> free_result();
    }
else echo "Brak propozycji do pokazania.";
?>
    
    </section>
    <section>
        <div class="heading"><h2>ZAPYTAJ O WIZYTĘ</h2></div>
    <?php
    $conn -> close();
    $conn = new mysqli("localhost", "root", "", "gabinet");
    //$conn = new mysqli("127.0.0.1:3307", "root", "root", "gabinet");
    ?>

        <form action="../phpScripts/requestVisit.php" autocomplete="off" method="POST">
            <select name="special">
                <?php
                $res = $conn -> query("SELECT * FROM specials");
                while($a = $res -> fetch_object())
                    echo '<option value="'.$a->id.'">'
                    .$a->name.'</option>';
                $res -> free_result();
                
                ?>
            </select>
            <p class="prefered">PREFEROWANA DATA</p>
            <p>OD -<input type="date" name="visitDateFrom"
            min="<?php echo date("Y-m-d", time()+24*60*60)?>"
            max="<?php echo date("Y-m-d", time()+10*24*60*60)?>"
            required></p>
            <p>DO -<input type="date" name="visitDateTo"
            min="<?php echo date("Y-m-d", time()+11*24*60*60)?>"
            max="<?php echo date("Y-m-d", time()+30*24*60*60)?>"
            required></p>
            <p class="prefered">PREFEROWANA GODZINA</p><br>
            <p>OD -<input type="time" min="9:00" max="14:00" name="timeDateFrom" required></p>
            <p>DO -<input type="time" min="14:00" max="19:00" name="timeDateTo" required></p>
            <p class="nfz">ZAPIS NA NFZ<input type="checkbox" name="nfz"></p>
            <textarea name="note" placeholder="Dodatkowe informacje"></textarea><br>
            <input class="submit-btn" type="submit" name="submitVisit" >
            <?php
            if($r1 = $conn -> query("SELECT COUNT(*) as howMuch FROM visitrequests WHERE user = $id")){
                if($r1 -> fetch_object() -> howMuch >= 3) echo "disabled";
            }
            $conn -> close();
            ?>
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
