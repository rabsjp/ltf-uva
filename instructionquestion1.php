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
<TITLE> Questions1 </TITLE>
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
<?php if ($treatment>1) echo "var q3=document.forms['form1'].q3.value;";?>
<?php if ($treatment>1) echo "var q4=document.forms['form1'].q4.value;";?>
	if (document.forms[0].q1[0].checked && document.forms[0].q2[1].checked <?php if ($treatment>1) echo " && q3 == '-5' && q4 == '55'" ?>) {
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
<p align=justify><b>Before the experiment starts, please answer some questions on the next pages. 
You can return to the instructions by clicking on the menu at the top of this page. If you need help, please raise your hand.</b></p>
</td><td></td>
</tr>
</table>
<br />
<br />
<div class="toelichting">
<form name="form1" action="instructionquestion2.php" onsubmit="return controleren(this)"> 
	<table width="50%" border="0" cellpadding="0" align=center>
		<tr>
			<td><b>1. In a given period, in which of the following cases does the pension fund you advise buy more of the risky asset than in the other case?</b> </td>
		</tr>
		<tr> 
			<td><input type="radio" name="q1" value="high">If your <?php echo $task; ?> forecast is <?php if ($treatment==1 or $treatment==3)
	{echo "81.17";} else {echo "10.25%";} ?>.
			<br><input type="radio" name="q1" value="low">If your <?php echo $task; ?> forecast is <?php if ($treatment==1 or $treatment==3)
	{echo "79.54";} else {echo "8.35%";} ?>.
			</td>
		</tr>
		<tr><td><br></td></tr>

		<tr>
			<td><b>2. What happens to the market <?php echo $task?> when pension funds buy more of the risky asset?</b></td>
		</tr>
		<tr> 
			<td><input type="radio" name="q2" value="down"><?php if ($treatment==1 or $treatment==3)
	{echo "It will decrease.";} else {echo "It will be lower.";} ?>
			<br><input type="radio" name="q2" value="up"><?php if ($treatment==1 or $treatment==3)
	{echo "It will increase.";} else {echo "It will be higher.";} ?>
			</td>
		</tr>
				
		<tr><td><br></td></tr>
		
		<?php if ($treatment>1) {echo "<tr>
			<td><b>3. Suppose that the price is 84 in period 1, 79.8 in period 2 and 82.7 in period 3. What is the return (in percent) in period 2?</b></td>
		</tr>
		<tr> 
			<td align=center><input type=\"text\" name=\"q3\" size=5 AUTOCOMPLETE=\"OFF\"></td>
		</tr>		
		<tr><td><br></td></tr>";}
        ?>		
		
        <?php if ($treatment>1) {echo "<tr>
			<td><b>4. Suppose that the market price was 50 in period 10 and the return in period 11 was 10%. What was the market price in period 11? </b></td>
		</tr>
		<tr> 
			<td align=center><input type=\"text\" name=\"q4\" size=5 AUTOCOMPLETE=\"OFF\"></td>
		</tr>		
		<tr><td><br></td></tr>";}
        ?>


		<tr>
		
		<td align=center><input name="verzend" type="submit" value="Send"></td>
		</tr>
		
	</table>
</form>

</div>
</BODY>
</HTML>
