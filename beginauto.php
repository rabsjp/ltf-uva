<?php
//Only for use in CREEDlab, when the client is redirected in beginexp.html to this file. Automatically a number is asigned and also the table (A2, A3 etc) is included in ppnummers
//Only for the pilot experiment without any reference to location yet!!
include("common.inc");
$table=$_REQUEST['table'];
//kijken wie nog niet is ingelogd
$table_name="ppnummers";
$connection = @mysql_connect(HOST,ADMIN, WWOORD) or die(mysql_error());
$db = @mysql_select_db(DBNAME,$connection)or die(mysql_error());
$sql="SELECT * FROM $table_name ORDER BY ppnr DESC";
$result=@mysql_query($sql,$connection) or die("Couldn't execute query ".$sql);
if ($row=mysql_fetch_array($result)) {
	$pp2=$row[pp2]+1;
} else {
	$pp2=1;
}

$groep=ceil($pp2/6);
$ppnummer=4*$groep+6+$pp2;

if ($pp2>$numbersubj){
	header("Location: relogin.php");
	exit();
} else {
	setcookie("beheerder", $ppnummer); 
	$table_name="ppnummers";
	$connection = @mysql_connect(HOST,ADMIN, WWOORD) or die(mysql_error());
	$db = @mysql_select_db(DBNAME,$connection)or die(mysql_error());
	$sql2="INSERT INTO $table_name (ppnr, tafelnummer, groep, pp2) 
	VALUES (\"$ppnummer\", \"$table\", \"$groep\", \"$pp2\")";
	$result=@mysql_query($sql2,$connection) or die("Couldn't execute query ".$sql2);
	header("Location: welcome.php");
	exit();
}

?>
