<?php
Header("Cache-Control: no-cache, must-revalidate");
include("common.inc");

if (!$_COOKIE['beheerder']){
	header("Location: beginjp.html");
	exit();
}

$koek=readcookie("beheerder");
$ppnummer=$koek[0];
$round=lookUp("ppnummers","ppnr='$ppnummer'","round");
$groep=lookUp("ppnummers","ppnr='$ppnummer'","groep");
$beta=0.1;

// Calculating weights for the current period
$currentweight=1;
if ($round>4 && $round<8){
	// calculating the average forecast error of the given subject
	$totalerror=0;
	$numforecast=0;
	for ($t=1; $t<=3; $t++){
		$period=$round-$t;
		$timeout=lookUp("results","ppnr='$ppnummer' and round='$period'","timeout");
	    if ($timeout==0){
		   $numforecast=$numforecast+1;
		   $error=lookUp("results","ppnr='$ppnummer' and round='$period'","error");
		   $totalerror=$totalerror+$error*$error;
	    }
	}
	if ($numforecast==0){
		$currentweight=0;
	}
	else{
		
		$avgerror=$totalerror/$numforecast;

		// calculating performances in the group
	    $denominator=0;
    	for ($i=1; $i<=6; $i++){
	    	$perf=0;
		    $pp3=10*$groep+$i;
		    $totalerror=0;
	        $numforecast=0;
		    for ($t=1; $t<=3; $t++){
		 	    $period=$round-$t;
		        $timeout=lookUp("results","ppnr='$pp3' and round='$period'","timeout");
    	        if ($timeout==0){
	            	$numforecast=$numforecast+1;
		            $error=lookUp("results","ppnr='$pp3' and round='$period'","error");
		            $totalerror=$totalerror+$error*$error;
	            }
	        }
    	    if ($numforecast>0){
	    	$perf=exp(-$beta*$totalerror/$numforecast);
	    	$denominator=$denominator+$perf;
	        }
    	    		
	    }

	    // weight for the current period
	    $currentweight=exp(-$beta*$avgerror)/$denominator;

	}
	
}
// saving the weight
updateTableOne("results","ppnr=$ppnummer and round=$round","weight",$currentweight);

if ($round>1){
	$period=$round-1;
	$marketprice=lookUp("results","ppnr='$ppnummer' and round='$period'","marketprice");
	$fundamental=$dividend/$interest_rate;
}

$idnr=substr($ppnummer, -1);
$subject="prediction".$idnr;	


if (isset($_REQUEST['Zend'])) {
	$begintijd=$_REQUEST['begintijd'];
	$tijd=time()-$begintijd; 
	$forecast=$_REQUEST['forecast'];
	$boundary=$_REQUEST['hiddenField1'];
	
	$test=lookup("results","ppnr='$ppnummer' and round='$round'","tijd");
	if ($test==0){
		updateTableMore("results","ppnr=$ppnummer and round=$round","tijd='$tijd', prediction='$forecast', timeout='0', boundary='$boundary'");
		updateTableOne("ppnummers","ppnr=$ppnummer","prediction",$forecast);
		if (lookup("groepresults","groep='$groep' and round='$round'","$subject")==""){
			updateTableOne("groepresults","groep=$groep and round=$round","$subject",$forecast);
		}
	}
	header("Location: wacht_4_forecast.php");
	exit();
	
}

$begintijd=time();

if ($round>1 && $marketprice >= $maxprice)
	{$message = "The price has reached its maximal value of 1000. The price cannot go above 1000.";
	echo "<script type='text/javascript'>alert('$message');</script>";}

?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Prediction Page</title>
  <META NAME="Generator" CONTENT="EditPlus">
  <META NAME="Author" CONTENT="">
  <META NAME="Keywords" CONTENT="">
  <META NAME="Description" CONTENT="">
  	<link rel="stylesheet" type="text/css" href="beleggensns.css" />

<script language="javascript">
	// Finding the initial date at time of startup and getting hours and minutes from there
	var starttime=new Date();
	var hs=starttime.getHours();
	var ms=starttime.getMinutes();
	var ss=starttime.getSeconds();
	var sjaak=0;
	// Define a function which updates the time continuously as commanded by the html code in <body ...>
	function startTime()
	{
	var today=new Date();
	var h=today.getHours()-hs;
	var m=today.getMinutes()-ms;
	var s=today.getSeconds()-ss;
	//maxtijd is given as a common parameter, and gives the time in minutes
	//if we want to have non-integer minutes, we need to define a maxtijd in seconds as well
	m=<?php if ($round<11){echo $maxtijd1;}
		if ($round>10){echo $maxtijd2;}?>-m;
	//checking to not have e.g. 90 sec, but 1 min 30 sec
	// note that this does not correct values more than 120
	s=0-s; //maximumtijd hier invullen evt met php later.
	if (s<0)
	{
	s=s+60
	m=m-1;
	}
	if (s>59)
	{
	s=s-60
	m=m+1;
	}
	if (m<0)
	{
	m=m+60;
	h=h-1;
	}
	if (m>59)
	{
	m=m-60;
	h=h+1;
	}
	// add a zero in front of numbers<10
	m=checkTime(m);
	s=checkTime(s);
	if (m<1 && s<1)
		{
		// where you go when time is up
		location.href="timeoutverw.php" 
		}
	else if (m<1 && s<11)
		{
	document.getElementById('txteinde').innerHTML=m+":"+s;
	document.getElementById('txt').innerHTML="";
	sjaak=1;
		}
		else{
	document.getElementById('txt').innerHTML=m+":"+s;
		}
	t=setTimeout('startTime()',500);
	}
	function checkTime(i)
	{
	if (i<10)
	  {
	  i="0" + i;
	  }
	return i;
	}
	</script>


 </head>

<body onload="startTime();">
<p align=center>
	<table border="1"  bgcolor="black"  style ="position:absolute;right:0;top:0">
	<td><font size="5" color="yellow">TIME:</font></td>
	<td><font size="5" color="yellow"><span id="txt" ></span></font><font size="5" color="red"><blink><span id="txteinde"></span></blink></font></td>
	</table>
	</p>

<br />


  <script language="JavaScript">
	function IsNumeric(strString)
	   //  check for valid numeric strings	
	   {
	   var strValidChars = "0123456789.-";
	   var strChar;
	   var blnResult = true;
	   if (strString.length == 0) return false;
	   //  test strString consists of valid characters listed above
	   for (i = 0; i < strString.length && blnResult == true; i++)
		  {
		  strChar = strString.charAt(i);
		  if (strValidChars.indexOf(strChar) == -1)
			 {
			 blnResult = false;
			 }
		  }
	   return blnResult;
	   }

	var tekst="";   
	function retr_dec(num) {
  		return (num.split('.')[1] || []).length;
	}
	function confirm_box(form) {
		var prediction=document.forms['form1'].forecast.value;
		if (!IsNumeric(prediction)) {
			alert("The prediction should be a number!");
			return false;
		}
		
		if (prediction < 0) {
			tekst = tekst+"+"+prediction;
			document.getElementById('hiddenField1').value=tekst;
			alert("The prediction should not be lower than 0!");
			return false;
		}

		if (prediction > <?php echo $maxprice ?>) {
			tekst = tekst+"+"+prediction;
			document.getElementById('hiddenField1').value=tekst;
			alert("The prediction should not be greater than <?php echo $maxprice?>!");
			return false;
		}

		if (retr_dec(prediction)>2){
			alert("Please use only two digits after the decimal point!");
			return false;
		}
	
	}
</script>


<table align=center width=100%>
<col width=30%>
<col width=70%>




<td><H1 align=center><font size='6'>Your decision for period <?php echo $round; ?></H1><br />
<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return confirm_box(this)">
<input type='hidden' name='begintijd' id='hiddenField2' value='<?php echo $begintijd; ?>'>
<input type='hidden' name='hiddenField1' id='hiddenField1'>
<table align=center>
	<tr>
		<td align=right><font size='5' face='Verdana'> What is your prediction for the price in period <?php echo $round; ?>?  </td>
		<td><input type="text" name="forecast" size=5 AUTOCOMPLETE="OFF" ?></td> 
	</tr>
	<tr><td></td><td><button type="submit" name="Zend" value="Zend">Submit</button></td>
</tr>
</table>
</form>
</td>
</tr>
</table>
</body>
</html>