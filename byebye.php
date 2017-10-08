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

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> Thank you </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<link rel="stylesheet" type="text/css" href="beleggensns.css" />
</HEAD>

<BODY>


<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

<h4 align=center> Thank you for participating in this experiment! </h4>
<br>
<h4 align=center>Please remain seated until your table number is called.</h4>
<br>
</BODY>
</HTML>
