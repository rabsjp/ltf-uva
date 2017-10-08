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

$startinst=readCommonParameter("startinst");



//only for the testing: we skip the instructions here
if ($test>0 and $startexp==1 and $startinst==1){
	header("Location: verwijzen0.php");
	exit();
}

if ($test==0 and $startinst==1) {
	header("Location: instruction1.php");
	exit();
}



?>
<html>
<head>
	<meta http-equiv="Refresh" content="5">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<meta http-equiv="Expires" content="Mon, 01 Jan 1990 12:00:00 GMT">
	<link rel="stylesheet" type="text/css" href="beleggensns.css"" />
</head>

<body>
<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <H4 align=center>Welcome to this experiment.</H4>

</body>
</html>