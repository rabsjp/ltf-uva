<?php
include "common.inc";

$nrgroup=$numbersubj/6;

for ($i=1; $i<=$nrgroup; $i++){
	for ($j=1; $j<=$ronde; $j++){
		$test=lookUp("groepresults","groep='$i' and round='$j'","round");
		if ($test==""){
			insertRecord("groepresults","groep, round","'$i', '$j'");
		}
	}
}



updateTableOne("commonparameters","name='startexp'","value","1");
header("Location: monitor.php");
?>
