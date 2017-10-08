<?php
include "common.inc";
//check for required fields
if (!isset($_REQUEST['reloginpp'])) {
	//no subjectnumber filled in
	//echo "<html><body>Geen deelnemernummer!</body></html>";
	header("Location: begin.html"); //THIS ONE IS FROM ME mw	
	exit();
}
else {
	$ppnummer=$_REQUEST['reloginpp'];
}
//$sessie=readCommonParameter("sessie");
if (lookUp("ppnummers","ppnr='$ppnummer'","ppnr")==""){
	//apparently no relogin, get back
	header("Location: begin.html");
	exit();
}
else {
	writecookie("beheerder",$ppnummer);
}
//send to the right page
$currentpage=lookUp("ppnummers","ppnr='$ppnummer'","currentpage");
header("Location: ".$currentpage);
exit();	
// voor geval iets misgaat
//echo "ppnr: ".$ppnummer; //", deel: ".$deel.", period: ".$period;
?>