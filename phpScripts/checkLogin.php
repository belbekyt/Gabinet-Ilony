<?php
if(!isset($_SESSION["USER"])){
    header("LOCATION: ../pages/login.php");
    exit;
}
?>