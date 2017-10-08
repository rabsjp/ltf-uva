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
$maxround=readCommonParameter("ronde");                      
$groep=lookUp("ppnummers","ppnr='$ppnummer'","groep");
updateTableOne("ppnummers","ppnr=$ppnummer","currentpage",$_SERVER['PHP_SELF']);
$counter=lookUp("ppnummers","ppnr='$ppnummer'","counter");   
updateTableOne("ppnummers","ppnr=$ppnummer","timeout",0);


if ($round<=$ronde){
	$test=lookup("results","ppnr='$ppnummer' and round='$round'","round");
	if ($test==""){
		insertRecord("results","ppnr, round, groep","'$ppnummer', '$round', '$groep'");
		if ($round==1){
			insertRecord("results","ppnr, round, groep","'$ppnummer', '2', '$groep'");   
		}
	}
}
?>




<iframe   id= "frmdecision "   src= <?php if ($round>$maxround) {echo "\" overviewresults.php \"";} elseif ($counter>$round) {echo "\"wacht_4_forecast.php \"";} else {echo "\"decision4forecast.php \"";}?>   position= "absolute" width= "100% "   height= "40%" align="center"> </iframe><br>
<iframe   id= "frmgraph "   src= "line_4forecast.php "   position= "absolute" width= "49% "   height= "500" align="center"> </iframe>
<iframe   id= "frmtable "   src= "table_4forecast.php "   position= "absolute" width= "49% "   height= "500" align="center" scrolling="yes"> </iframe>

</body>
</html>
