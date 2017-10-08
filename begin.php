<?php
include "common.inc";
////check for required fields
if (!isset($_REQUEST['ppnummer'])) {
	echo "<html><body>No number!</body></html>";
	exit;
}
else {
	$ppnummer=$_REQUEST['ppnummer'];
	$groep=substr("$ppnummer", 0,1);
}
if (lookUp("ppnummers","ppnr='$ppnummer'","ppnr")<>""){
	header("Location: begin.html");
	exit();
}
writecookie("beheerder",$ppnummer,$groep);
// checken of ppnummer al voorkomt, zo ja, dan naar pagina relogin...
	$table_name="ppnummers";
	$connection = @mysql_connect(HOST,ADMIN, WWOORD) or die(mysql_error());
	$db = @mysql_select_db(DBNAME,$connection) or die(mysql_error());
	$sql2="INSERT INTO $table_name (ppnr, groep) 
	VALUES (\"$ppnummer\", \"$groep\")";
	$result=@mysql_query($sql2,$connection) or die("Couldn't execute query ".$sql2);
	header("Location: welcome.php");
	exit();
?>

