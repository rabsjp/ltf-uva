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
$groep=lookUp("ppnummers","ppnr='$ppnummer'","groep");
updateTableOne("ppnummers","ppnr=$ppnummer","currentpage",$_SERVER['PHP_SELF']);

$maxround=readCommonParameter("ronde");
$prevround = $round-1;
$prevround2=$round-2;

$maxpayoff = 1300; // maximal payoff when the error is 0
$maxerror = 7;   // maximal admissible error: payoff is 0 if the error is larger than 7

if (lookUp("results","ppnr='$ppnummer' and round='$round'","tijd")==0){
	header("Location: decision4forecast.php");
	exit();
}
else{
 //determining the market price and earnings for the current period
	
		
			$sumprediction=0;
			$sumweight=0;
			for ($i=1; $i<=6; $i++){
				$pp3=10*$groep+$i;
				$timeout=lookUp("results","ppnr='$pp3' and round='$round'","timeout");
				if ($timeout==0){
					$pred=lookUp("results","ppnr='$pp3' and round='$round'","prediction");
					$currentweight=lookUp("results","ppnr='$pp3' and round='$round'","weight");					
					$sumprediction=$sumprediction+$pred*$currentweight;
					$sumweight=$sumweight+$currentweight;
				}
			}
			if ($sumweight==0){
				$meanprediction==0;
			}
			else{
				$meanprediction=$sumprediction/$sumweight;
			}
			

			$fundamental=$dividend/$interest_rate;
			$noise=lookUp("noise","round='$round'","shock");
			$marketprice=max(round($fundamental+($meanprediction-$fundamental)/(1+$interest_rate)+$noise,2),0);
			$marketprice=min($marketprice,$maxprice);
		    
		
	//earnings
		$forecast=lookUp("results","ppnr='$ppnummer' and round='$round'","prediction");
		$error=abs($marketprice-$forecast);
		
	    //if time-out, that is if no decision is made, earnings for that round = 0
		if (lookUp("results","ppnr='$ppnummer' and round='$round'","timeout")==0){
			$verd=max(round($maxpayoff*(1-$error*$error/($maxerror*$maxerror))),0);			
		}
		else {
			$verd=0;	
		}
		//calculating total netearnings so far
		$subtot=0;
		$connection = @mysql_connect(HOST,ADMIN, WWOORD) or die(mysql_error());
		$db = @mysql_select_db(DBNAME,$connection) or die(mysql_error());
		$sql="SELECT * FROM results WHERE ppnr='$ppnummer' AND round>0 ORDER BY round ASC";
		$result=@mysql_query($sql,$connection) or die("Couldn't execute query ".$sql);

		while ($row=mysql_fetch_array($result)){
			$subtot=$subtot+$row['roundearnings'];
		}
		$subtot=$subtot+$verd;


	//saving the results
		if (lookUp("results","ppnr='$ppnummer' and round='$round'","roundearnings")==""){
			updateTableMore("results","ppnr=$ppnummer and round=$round","roundearnings='$verd', marketprice='$marketprice', netearnings='$subtot', error='$error'");
			updateTableOne("ppnummers","ppnr=$ppnummer","netearnings",$subtot);
			updateTableOne("results","ppnr=$ppnummer and round=$round","meanpred",$meanprediction);

		}

		//updating groupresults table with marketprice and marketreturn
		if (substr($ppnummer,-1)==1){
	
			updateTableOne("groepresults","groep=$groep and round=$round","marketprice",$marketprice);
		}
		

	// increasing the round number by 1
	$round=$round+1;
	
	
	updateTableOne("ppnummers","ppnr=$ppnummer","round",$round);
	
}

?>
<html><head.</head><body onload="javascript:window.parent.location=window.parent.location"><p align=center>
</body>
</html>

