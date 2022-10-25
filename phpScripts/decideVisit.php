<?php
require "../phpScripts/requirements.php";
//require "../phpScripts/checkLogin.php";

//DEBUG NOTE
//Wybierz sobie, które połączenie działa
//$conn = new mysqli("127.0.0.1:3307", "root", "root", "gabinet");
$conn = new mysqli("localhost", "root", "", "gabinet");
///////////////////////
User::initSession(User::createTestUser());

$decide = $_POST['sub'];
$visit = $_POST['visitID'];
echo $decide;

if($decide == "Zatwierdź"){
$conn -> query("UPDATE `visit` SET `accepted` = true WHERE `id` = $visit;");
}else if($decide == "Odrzuć"){
$conn -> query("DELETE FROM `visit` WHERE `id` = $visit;");
}else if($decide == "Usuń"){
$conn -> query("DELETE FROM `visitrequests` WHERE `id` = $visit;");
}
$conn -> close();
header("Location: ../pages/visits.php");

?>