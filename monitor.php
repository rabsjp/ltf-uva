<?php
	include("common.inc");
	$table_name="ppnummers";
	$connection = @mysql_connect(HOST,ADMIN, WWOORD) or die(mysql_error());
	$db = @mysql_select_db(DBNAME,$connection) or die(mysql_error());
	$sql3="SELECT * FROM $table_name ORDER BY `ppnr` ASC";
	$result=@mysql_query($sql3,$connection) or die("Couldn't execute query ".$sql3);
	if ($startexp==0){
		$tabel="<table border=1><tr align=center><td><b>Subject<b></td><td><b>Table<b></td><td><b>Group<b></td><td><b>Currentpage<b></td><td><b>Done with <br>questions <br>(10=yes)<b></td><tr>";
		while ($row=mysql_fetch_array($result)) {
			$ppnummer=$row['ppnr'];
			$tafelnummer=$row['tafelnummer'];
			$groep=$row['groep'];
			$currentpage=$row['currentpage'];
			$vrijgemaakt1=$row['vrijgemaakt1'];
		

			$tabel .= "<tr  align=center><td>".$ppnummer."</td><td>".$tafelnummer."</td><td>".$groep."</td><td align=center>".$currentpage."</td><td align=center>".$vrijgemaakt1."</td><tr>";
		}
		$tabel .= "</table>";
	}
	else{
		$tabel="<table border=1><tr align=center><td><b>Subject<b></td><td><b>Table<b></td><td><b>Netearnings<b></td><td><b>Group<b></td><td><b>Currentpage<b></td><td><b>Round<b></td><td><b>Done with <br>decision<b></td><td><b>Prediction<b></td><td><b>Timeout<b></td><tr>";
		while ($row=mysql_fetch_array($result)) {
			$ppnummer=$row['ppnr'];
			$tafelnummer=$row['tafelnummer'];
			$netearnings=round($row['netearnings']/$koers,2);
			$groep=$row['groep'];
			$currentpage=$row['currentpage'];
			$round=$row['round'];
			$prediction=$row['prediction'];
			$timeout=$row['timeout'];
			$counter=$row['counter'];
			if ($counter>$round){$done="yes";}
			else {$done="no";}

			$tabel .= "<tr  align=center><td>".$ppnummer."</td><td>".$tafelnummer."</td><td>".$netearnings."</td><td>".$groep."</td><td align=center>".$currentpage."</td><td align=center>".$round."</td><td align=center>".$done."</td><td align=center>".$prediction."</td><td>".$timeout."</td><tr>";
		}
		$tabel .= "</table>";
	}

?>
<html>
<head>
<meta http-equiv="Refresh" content="5">
	<link rel="stylesheet" type="text/css" href="beleggensns.css" />
</head>


<body>
<br>
<br>
<br>
<table border=1 align=center><tr align=center><th colspan="2">Treatments</th></tr>
<tr align=center><td>PP = 1</td><td>PR = 2</td></tr>
<tr align=center><td>RP = 3</td><td>RR = 4</td></tr>
</table>
<br>
<br>
<br>
<table align=center width=100%>
<col width=15%>
<col width=70%>
<col width=15%>
<tr><td></td><td><p align=center>Don't forget to set the necessary parameters before the experiment. Click <a href="setup.php" class="buttonblauw">here</a> if you haven't done it yet.<br>
	We are running treatment <b><?php echo $treatment; ?></b> with <b><?php echo $numbersubj;?></b> subjects.<br>
	</b> <?php if ($test==1){echo "<br><font color=\"red\"> YOU ARE IN TESTMODE! ";} ?></p></td><td></td></tr>
<tr><td></td><td><br></td><td></td></tr>
<tr><td></td><td align=center>
	<table>
		<col width=22%>
		<col width=4%>
		<col width=22%>
		<col width=4%>
		<col width=22%>
		<col width=4%>
		<col width=22%>
		<tr><td align=center><a href="startinst.php" class="buttonblauw">Start instructions</a>  </td><td></td><td align=center>
		<a href="startexp.php" class="buttonblauw">Start experiment</a>  </td><td></td><td align=center>
		<a href="startquest.php" class="buttonblauw">Start questionnaire</a></tr>
	</table></td><td></td></tr>
	<tr><td></td><td align=center><a href="kwitanties.php" class="buttonblauw">Print receipts</a></td><td></td></tr>
</table>
<br>
<br>
<p align=center>
<?php echo $tabel; ?>
</p>
</body>
</html>