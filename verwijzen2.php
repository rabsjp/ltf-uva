<?php
Header("Cache-Control: no-cache, must-revalidate");
include("common.inc");

if (!$_COOKIE['beheerder']){
	header("Location: begin.html");
	exit();
} 
$koek=readcookie("beheerder");
$ppnummer=$koek[0];
updateTableOne("ppnummers","ppnr=$ppnummer","currentpage",$_SERVER['PHP_SELF']);


?>

<html><head.</head><body onload="javascript:window.parent.location='questionnaire.php'"><p align=center>




