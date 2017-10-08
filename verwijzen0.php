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

if ($round==0) {
	$round=1;
	updateTableOne("ppnummers","ppnr=$ppnummer","round",$round);
}

if ($test==2){
	header("Location: decisionjppre_test.php");
	exit();
}
else	{
	header("Location: decisionjppre.php");
	exit();	
 }
?>