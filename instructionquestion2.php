<?php
include("common.inc");
Header("Cache-Control: must-revalidate");
if (!$_COOKIE['beheerder']){
	header("Location: begin.html");
	exit();
	} 
else {
	$koek=readcookie("beheerder");
	$ppnr=$koek[0];
}


if ($treatment==1 or $treatment==3)
	{$task = 'price';}
else {$task = 'return';}


updateTableOne("ppnummers","ppnr=$ppnr","currentpage",$_SERVER['PHP_SELF']);

$menu=instructionMenu($_SERVER['PHP_SELF'], $ppnr);





?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> Questions2 </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
 <link rel="stylesheet" type="text/css" href="beleggensns.css" />
 
</HEAD>

<BODY>
<p align=center><?php echo $menu; ?></p>
<br /><br />



<script language=javascript> 
function controleren(form) {
var q1=document.forms['form1'].q1.value;
var q2=document.forms['form1'].q2.value;
var q3=document.forms['form1'].q3.value;

	if (document.forms[0].q1[1].checked && q2 == '1092' && q3 == '10') {
		alert("All your answers are correct.");
		return true;
	}
	else {
		alert("You did not answer all questions correctly. \n\nTake another look at the instructions or \nraise your hand if you need help.");
		return false;
	}}
	
</script>


<br />
<br />
<table align=center width=100%>
<col width=15%>
<col width=70%>
<col width=15%>

 
<tr><td></td>
<td>

</td><td></td>
</tr>
</table>
<br />
<br />
<div class="toelichting">
<form name="form1" action="waitafterinstructions.php" onsubmit="return controleren(this)"> 
	<table width="50%" border="0" cellpadding="0" align=center>
		<tr>
			<td><b>1. In which of the following cases will the <?php echo $task; ?> <?php if ($treatment==1 or $treatment==3)
	{echo "go up";} else {echo "be positive";} ?>? </b> </td>
		</tr>
		<tr> 
			<td><input type="radio" name="q1" value="down"> When advisors think the <?php echo $task ?> will <?php if ($treatment==1 or $treatment==3)
	{echo "decrease";} else {echo "be negative";} ?> and the pension funds buy very little.
			<br><input type="radio" name="q1" value="up">  When advisors think the <?php echo $task ?> will <?php if ($treatment==1 or $treatment==3)
	{echo "increase";} else {echo "be positive";} ?> and the pension funds buy a lot.
			</td>
		</tr>
		<tr><td><br></td></tr>

		<tr>
			<td><b>2. Suppose that your prediction for the <?php echo $task ?> is <?php if ($treatment==1 or $treatment==3)
	{echo "59.3";} else {echo "12.1%";} ?> and the market <?php echo $task ?> turns out to be <?php if ($treatment==1 or $treatment==3)
	{echo "58.5";} else {echo "10.5%";} ?>. How many points do you earn in this period <?php if ($treatment==1 or $treatment==3) {echo "if the price in the previous period was 50";} ?> (please use the payoff table)?</b></td>
		</tr>
		<tr> 
			<td align=center><input type="text" name="q2" size=5 AUTOCOMPLETE="OFF"></td>
		</tr>
				
		<tr><td><br></td></tr>
		
		<tr>
			<td><b>3. Suppose that you earn 26,000 points by the end of the experiment. How much do you earn in terms of euros from your forecasts? </b></td>
		</tr>
		<tr> 
			<td align=center><input type="text" name="q3" size=5 AUTOCOMPLETE="OFF"></td>
		</tr>		
		<tr><td><br></td></tr>
        		
		


		<tr>
		
		<td align=center><input name="verzend" type="submit" value="Send"></td>
		</tr>
		
	</table>
</form>

</div>
</BODY>
</HTML>
