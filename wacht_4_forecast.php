<?php
include("common.inc");
Header("Cache-Control: must-revalidate");
if (!$_COOKIE['beheerder']){
	header("Location: begin.html");
	exit();
} 
$koek=readcookie("beheerder");
$ppnummer=$koek[0];
$round=lookUp("ppnummers","ppnr='$ppnummer'","round");
$counter = $round + 1;
updateTableOne("ppnummers","ppnr=$ppnummer","counter",$counter);


//determine how many subjects have made their decisions


$connection = @mysql_connect(HOST,ADMIN, WWOORD) or die(mysql_error());
$db = @mysql_select_db(DBNAME,$connection)or die(mysql_error());
$sql3="SELECT * FROM ppnummers WHERE counter>='$counter'";
$result=@mysql_query($sql3,$connection) or die("Couldn't execute query ".$sql3);
$count = mysql_num_rows($result);

if ($count>=$numbersubj) {
	header("Location: verwijzen1.php");
	exit();	
}


?>
<html>
<meta http-equiv="Refresh" content="5">
  	<link rel="stylesheet" type="text/css" href="beleggensns.css" />


<body>
	<br /><br />
<h4 align=center>Please wait before next period starts.</h4>

</body>
</html>