<?php
include("common.inc");
Header("Cache-Control: must-revalidate");
if (!$_COOKIE['beheerder']){
	header("Location: begin.html");
	exit();
	} 
else {
	$koek=readcookie("beheerder");
	$ppnr=$koek[0];
}

updateTableOne("ppnummers","ppnr=$ppnr","currentpage",$_SERVER['PHP_SELF']);
//vrijgemaakt1=10 means that they have finished their instructions
updateTableOne("ppnummers","ppnr=$ppnr","vrijgemaakt1",10);

$startexp=readCommonParameter("startexp");


if ($startexp==1) {
	header("Location: verwijzen0.php");
	exit();
}



?>
<html>
<head>
	<meta http-equiv="Refresh" content="5">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<meta http-equiv="Expires" content="Mon, 01 Jan 1990 12:00:00 GMT">
	<link rel="stylesheet" type="text/css" href="beleggensns.css" />
</head>

<body>
<br /> <br /> <br /> <br /> <br /> <br /> <br /> <H4 align=center>Please wait until everyone has finished the instructions.</H4>
<br /> <br /> <br /><p align=center>You will have <?php echo $maxtijd1;?> minutes in the first 10 rounds and <?php echo $maxtijd2;?> minute in every later periods to make your decision.</p>
</body>
</html>