<?php
Header("Cache-Control: no-cache, must-revalidate");
include("common.inc");

if (!$_COOKIE['beheerder']){
	header("Location: begin.html");
	exit();
} 
$koek=readcookie("beheerder");
$ppnummer=$koek[0];
$round=lookUp("ppnummers","ppnr='$ppnummer'","round");



$tabel="<table border=1 align=center><tr align=center><td><b>Period<b></td><td><b><font color=\"blue\">Your prediction</font><b></td><td><b><font color=\"red\">Realized price</font><b></td><td><b>Period earnings<b></td><td><b>Total earnings<b></td></tr>";

	for ($i=1; $i<=$round-1; $i++){
		$j=$round-$i;
		if (lookUp("results","ppnr='$ppnummer' and round='$j'", "timeout")==1){
			$decision="No forecast";
		}
		else{
			$decision=lookUp("results","ppnr='$ppnummer' and round='$j'", "prediction");
		}
		$pricedata=lookUp("results","ppnr='$ppnummer' and round='$j'", "marketprice");
		$roundearnings=lookUp("results","ppnr='$ppnummer' and round='$j'", "roundearnings");
		$netearnings=lookUp("results","ppnr='$ppnummer' and round='$j'", "netearnings");

		$tabel .="<tr align=center><td>".$j."</td><td>".$decision."</td><td>".$pricedata."</td><td>".$roundearnings."</td><td>".$netearnings."</td></tr>";
		
	
	}
	
	$tabel .= "</table>";
	

	


?>
<!DOCTYPE HTML>
<html>
<head>
	<title>History table</title>
	<link rel="stylesheet" type="text/css" href="beleggensns.css" />
</head>

<body>


<?php if ($round!=1) {echo "<p align=center>".$tabel."</p>";} else {echo "<h4 align=center>Table containing past information will appear here.</h4>";}?>




</body>
</html>