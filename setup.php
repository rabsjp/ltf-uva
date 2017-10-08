<?php
Header("Cache-Control: no-cache, must-revalidate");
include("common.inc");

	
if (isset($_REQUEST['Submit'])) {
	$treatment=$_REQUEST['treatment'];
	$nrsubj=$_REQUEST['nrsubj'];
	$test=$_REQUEST['test'];
	updateTableOne("commonparameters","name='startexp'","value","0");
	updateTableOne("commonparameters","name='startinst'","value","0");
	updateTableOne("commonparameters","name='startquest'","value","0");
	updateTableOne("commonparameters","name='treatment'","value",$treatment);
	updateTableOne("commonparameters","name='numbersubj'","value",$nrsubj);
	updateTableOne("commonparameters","name='test'","value",$test);

	header("Location: monitor.php");
	exit();	
}
?>


<html>
<head>
<title>Setup for experimenters</title>
<link rel="stylesheet" type="text/css" href="beleggensns.css" />

<script language=javascript>
function is_int(value){
  if((parseFloat(value) == parseInt(value)) && !isNaN(value)){
      return true;
  } else {
      return false;
  }
}

function setup(formsetup) {
	var treatment=document.forms['formsetup'].treatment.value;
	var nrsubj=document.forms['formsetup'].nrsubj.value;

	if (treatment<1 || treatment>4) {
		alert("Choose a treatment 1 to 4!");
		return false;
	}		
	else if (is_int(treatment)==false) {
		alert("Treatment must be an integer value!");
		return false;
	}		
	else {
		return true;
	}


 </script>
</head>


<body>
<br>
<br>
<br>
<table border=1 align=center><tr align=center><th colspan="2">Treatments</th></tr>
<tr align=center><td>PP = 1</td><td>PR = 2</td></tr>
<tr align=center><td>RP = 3</td><td>RR = 4</td></tr>
</table>
<br><br>
<table align=center width=100%>
<col width=15%>
<col width=70%>
<col width=15%>
<br>
<h4 align=center>By clicking on OK, the program sets also the start instructions, experiment, questionnaire parameters back to 0. <br>If on the monitor screen we click on start experiment, it sets this parameter to 1.</h4>
		
		<form name="formsetup" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return setup(this)">
		<table align=center>
				<tr> <td>Treatment for the LtF:</td> <td align=center><input type="text" name="treatment" size=5 AUTOCOMPLETE="OFF"></td></tr>
		<tr> <td>Number of subjects:</td> <td align=center><input type="text" name="nrsubj" size=5 AUTOCOMPLETE="OFF"></td></tr>
		<tr> <td>Test mode:</td> <td align=center>No <input type="radio" name="test" value="0"> Yes<input type="radio" name="test" value="1"> </td></tr>
		<tr>
		
		<td align=center><button type="submit" name="Submit" value="Submit">OK</button></td>
		</tr>
		</table>
		
</form>

</td><td></td></tr>
</table>
</body>
</html>
