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
updateTableOne("ppnummers","ppnr=$ppnr","currentpage",$_SERVER['PHP_SELF']);
$menu=instructionMenu($_SERVER['PHP_SELF'], $ppnr);


if ($treatment==1 or $treatment==3)
	{$task = 'price';}
else {$task = 'return';}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> Instructions </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
 <link rel="stylesheet" type="text/css" href="beleggensns.css" />
</HEAD>

<BODY>
<p align=center><?php echo $menu; ?></p>
<br>

<table align=center width=100%>
<col width=5%>
<col width=90%>
<col width=5%>


<tr><td></td>
<td>


<p align=justify><b>Earnings</b></p>
<p align=justify>Your earnings depend on the accuracy of your forecasts<?php if ($treatment == 1 or $treatment == 3) {echo " relative to the price of the previous period";} ?>. Your payoff for your forecast in period <i>t</i> is given by 

<?php if ($treatment == 1 or $treatment == 3) {echo "<p align=center>1300*(1 - 625*e<sub>t</sub><sup>2</sup> / p<sub>t-1</sub><sup>2</sup>),</p> where p<sub>t-1</sub> is the realized market price from the previous period <i>t-1</i> and e<sub>t</sub> is the forecast error, that is the absolute difference between your forecast of the price in period <i>t</i> and the realized price in that period";}
else {echo "<p align=center>1300*(1 - 625*e<sub>t</sub><sup>2</sup>),</p> where e<sub>t</sub> is the forecast error, that is the absolute difference between your forecast of the return in period <i>t</i> and the realized return in that period";} ?>.

The maximum 
	possible points you can earn in each period (if you make no forecast error) is 1300, 
	and the larger your forecast error is, the fewer points you will make. Note, however, that you will never earn negative payoffs in a single period: If your forecast error in a particular period is very large, your payoffs for that period will be zero.
	There is a Payoff Table on your desk, which shows the points you 
	can earn for different forecast errors<?php if ($treatment == 1 or $treatment == 3) {echo " under different price levels";}?>.</p>
<p align=justify>We will pay you in cash at the end of the experiment based on the points you earned. You earn 0.5 euro 
	for each <?php echo $koers/2;?> points you make plus an additional 5 euros of participation fee.</p>
<br>
<div class="boxed">
<p align=justify><b>Background information about the investment strategies of the funds</b></p>
<p align=justify>The precise investment strategy of the pension fund that you are advising and the investment strategies of the other 
	pension funds and of the small investors are unknown. The savings account that pension funds can use for their risk free investment pays a fixed interest rate of <?php echo $interest_rate*100;?>% per time period. 
	The stock pays an uncertain dividend in each time period. Economic experts have computed that the average dividend is <?php echo $dividend;?> euros per 
	period. The realized stock return per period is uncertain and depends upon the (unknown) dividend and upon stock price changes.</p>
<p align=justify>Based upon your stock <?php echo $task ?> forecast, your pension fund will make an optimal investment decision. The higher your <?php echo $task ?> forecast is, 
	the more money will be invested in the stock market by the fund, so the larger will be the demand for stocks.</p> 
</div>
<br>
<p align=justify>On the next screens you are asked to answer some questions in order to check if the experiment is clear to you.</p>



</td>
<td></td>

</tr>
</table>

<br />

<p align=center> <a Href="instructionquestion1.php">Next</a></div>
</div>
</p>
</BODY>
</HTML>
