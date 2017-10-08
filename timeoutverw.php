<?php
Header("Cache-Control: no-cache, must-revalidate");
include("common.inc");

if (!$_COOKIE['beheerder']){
	header("Location: begin.html");
	exit();
} 
$koek=readcookie("beheerder");
$ppnummer=$koek[0];
$round=lookUp("ppnummers","ppnr='$ppnummer'","round");


updateTableOne("ppnummers","ppnr=$ppnummer","currentpage",$_SERVER['PHP_SELF']);

$test=lookup("results","ppnr='$ppnummer' and round='$round'","tijd");
if ($test==0){
	updateTableOne("results","ppnr=$ppnummer and round='$round'",  "timeout",1);
	updateTableOne("results","ppnr=$ppnummer and round='$round'",  "tijd",1000);
	if ($round==1){
		updateTableOne("results","ppnr=$ppnummer and round='2'",  "timeout",1);
		updateTableOne("results","ppnr=$ppnummer and round='2'",  "tijd",1000);
	}
	updateTableOne("ppnummers","ppnr=$ppnummer","timeout",1);
}

	
header("Location: wacht_4_forecast.php");
	exit();	
 
?>