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

$neteuros1=lookUp("ppnummers","ppnr='$ppnummer'","neteuros1");
$totalverd=$neteuros1+$showup;



?>
<html>
<head>
	<title>Overview of results</title>
	<link rel="stylesheet" type="text/css" href="beleggensns.css" />
</head>

<body>
<br>
<h4 align=center> Thank you for participating in this experiment! </h4>
<br>
<br>
<h4 align=center> Your total earnings in this experiment are</h4>
<h4 align=center> <?php echo $totalverd;?> dollars.</h4>
<br>
<br>
<h4 align=center>Please remain seated until your table number is called.</h4>
<br>
<p align=center><a href="byebye.php" class="buttonblauw">Hide earnings</a></p>
</body>
</html>