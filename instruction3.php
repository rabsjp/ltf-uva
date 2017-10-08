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
$taal=lookUp("ppnummers","ppnr='$ppnummer'","taal");
updateTableOne("ppnummers","ppnr=$ppnr","currentpage",$_SERVER['PHP_SELF']);
$menu=instructionMenu($_SERVER['PHP_SELF'], $ppnr);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> Instructions </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
 <link rel="stylesheet" type="text/css" href="beleggensns.css" />
</HEAD>

<BODY>
<p align=center><?php echo $menu; ?></p>
<br /><br />

<br /><br />


<table align=center width=100%>
<col width=5%>
<col width=90%>
<col width=5%>

 
<tr><td></td>
<td>

<h4></h4>
<p align=justify><b></b></p>

</br>
<p align=justify><b>On the next screens you will be requested to answer some control questions. Please answer these questions now. 
</b></p>




</td>
<td></td>

</tr>
</table>



<p align=center> <a Href="instructionquestion1.php">To the questions</a></div>
</div>

</BODY>
</HTML>
