<?php
session_start();
//$_SESSION["payamount"] = $_GET['payamt'];

$_SESSION["payamount"] = $_POST['payamt'];

echo "amount : ". $_SESSION["payamount"];

?>