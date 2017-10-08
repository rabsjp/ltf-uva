<?php
include("common.inc");
Header("Cache-Control: must-revalidate");
if (!$_COOKIE['beheerder']){
	header("Location: begin.html");
	exit();
	} 

	$koek=readcookie("beheerder");
$ppnummer=$koek[0];

updateTableOne("ppnummers","ppnr=$ppnummer","currentpage",$_SERVER['PHP_SELF']);

$koers=readCommonParameter("koers");
$netearnings=lookUp("ppnummers","ppnr='$ppnummer'","netearnings");
$neteuros=round($netearnings/$koers,2);

updateTableOne("ppnummers","ppnr=$ppnummer","neteuros1","$neteuros");



if ($startquest==1) {
		header("Location: verwijzen2.php");
		exit();
}


?>
<html>
<head>
	<title>Overview of results</title>
	<meta http-equiv="Refresh" content="5">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<meta http-equiv="Expires" content="Mon, 01 Jan 1990 12:00:00 GMT">
	<link rel="stylesheet" type="text/css" href="beleggensns.css" />
</head>

<body>
<br>
<br>
<h4 align=center>This was the last round of the experiment.</h4>
<br>
<h4 align=center> Your earnings in this experiment are <?php echo $netearnings;?> points which equals <?php echo $neteuros;?> dollars.</h4>
<br>
<h4 align=center>Please wait for further instructions.</h4>
</body>
</html>