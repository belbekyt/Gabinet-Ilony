<?php
require "requirements.php";
//require "checkLogin.php";
User::initSession(User::createTestUser());
$type = User::getUser()->getType();
if($type != "ADMINISTRATOR" && $type != "RECEPCJA"){
    if($type == "LEKARZ") header('Location: ../pages/visits.php');
    else header('Location: ../pages/visits.php');
    exit;
}
//DEBUG NOTE
//Wybierz sobie, które połączenie działa
//$conn = new mysqli("127.0.0.1:3307", "root", "root", "gabinet");
$conn = new mysqli("localhost", "root", "", "gabinet");
///////////////////////

$visitDate = $_POST["visitDate"];
$visitTime = $_POST["visitTime"];
$doctor = $_POST["doc"];
$user = $_POST["user"];
$cost = $_POST["cost"];
$nfz = $_POST["nfz"];
$sId = $_POST["sid"];


$query = "INSERT INTO `visit` (`doctor`, `patient`, `visitDate`, `visitTime`, `nfz`, `cost`) VALUES ($doctor, $user, DATE('$visitDate'), TIME('$visitTime'), $nfz, $cost)";
echo $query;
$conn -> query($query);
$conn -> query("DELETE FROM visitrequests WHERE id = $sId");

$conn -> close();
header('Location: ../pages/requestHandler.php');
?>