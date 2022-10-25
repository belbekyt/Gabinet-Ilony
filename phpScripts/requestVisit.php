<?php 
require "../phpScripts/requirements.php";
//require "checkLogin.php";
$_SESSION['USER'] = User::createTestUser()->serializeSelf();

//DEBUG NOTE
//Wybierz, które połączenie działa
//$conn = new mysqli("127.0.0.1:3307", "root", "root", "gabinet");
$conn = new mysqli("localhost", "root", "", "gabinet");
///////////////////////////////

$query = "SELECT id FROM users WHERE `login` = '" . User::getUser()->getLogin()."';";
$idUser = $conn -> query($query) -> fetch_object() -> id;
$userName = User::getUser()->getFullName();
$note = mysqli_real_escape_string($conn, htmlentities($_POST["note"], ENT_QUOTES, "UTF-8"));
$timeFrom = $_POST["timeDateFrom"];
$timeTo = $_POST["timeDateTo"];
$dateFrom = $_POST["visitDateFrom"];
$dateTo = $_POST["visitDateTo"];
$special = $_POST["special"];
$nfz = 0;
if(isset($_POST["nfz"])) $nfz = true;
$query = "INSERT INTO `visitrequests`(`fullname`, `user`,`dateProposalFrom`, `dateProposalTo`, `timeProposalFrom`, `timeProposalTo`,`special`, `note`, `nfz`) VALUES 
('$userName', $idUser, DATE('$dateFrom'), DATE('$dateTo'), 
TIME('$dateFrom $timeFrom'), TIME('$dateTo $timeTo'), $special,'$note', $nfz);";
$conn -> query($query);
$conn -> close();
header("Location:../pages/visits.php");
?>