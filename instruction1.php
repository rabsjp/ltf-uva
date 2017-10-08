<?php
include("common.inc");
Header("Cache-Control: must-revalidate");
if (!$_COOKIE['beheerder']){
	header("Location: begin.html");
	exit();
	} 
else {
	$koek=readcookie("beheerder");
	$ppnummer=$koek[0];
	}

if ($treatment==1 or $treatment==3)
	{$task = 'price'; $lower = '0'; $upper = '100';}
else {$task = 'return'; $lower = '-10%'; $upper = '10%';}

if ($treatment==1 or $treatment==2)
	{$stim = 'price';}
else {$stim = 'return';}


updateTableOne("ppnummers","ppnr=$ppnummer","currentpage",$_SERVER['PHP_SELF']);
$menu=instructionMenu($_SERVER['PHP_SELF'], $ppnummer);
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
<p align=justify> Welcome to this experiment on decision-making. Please read the following instructions carefully. 
	If you have any questions, please raise your hand, and we will come to your table to answer your question in private.</p>
<p align=justify><b>General information</b></p>
<p align=justify>You are a <b>financial advisor</b> to a pension fund that wants to optimally invest a large amount of money. 
	The pension fund has two investment options: a risk free investment (on a savings account) and a risky investment (on the stock market). 
	As its financial advisor, you have to forecast the stock <?php echo $task ?> for <?php echo $ronde;?> subsequent time periods. The more accurate your forecasts 
	are, the higher your total earnings are.</p>

<p align=justify><b>Your forecasting task</b></p>
<p align=justify>Your only task is to forecast the stock <?php echo $task ?> in each time period as accurately as possible. <?php if ($treatment==2 or $treatment==4) {echo "The stock return is the relative price change compared to the previous period: <p align=center>return<sub>t</sub> = (price<sub>t</sub> - price<sub>t-1</sub>)/price<sub>t-1</sub>.</p> The return therefore measures how fast prices are increasing or decreasing. For example, if the price in period <i>t-1</i> is 50 and the price in period <i>t</i> is 53, then the return in period <i>t</i> is (53-50)/50=0.06, or 6%.";} ?> The stock <?php echo $task ?> has to be forecasted one period ahead, that is at the beginning of each period you need to forecast what the <?php echo $task ?> will be in that period. It is very likely that the stock <?php echo $task ?> will be between <?php echo $lower ?> and <?php echo $upper ?> in the first period. 
	After all participants have given their forecasts for the first period, the stock <?php echo $stim ?> for the first period will 
	be revealed and, based upon your forecasting error, your earnings for period 1 will be given. After that you have to give 
	your forecast for the stock <?php echo $task ?> in the second period. After all participants have given their forecasts for period 2, 
	the stock <?php echo $stim ?> in the second period will be revealed and, based upon your forecasting error, your earnings for period 2 will be given. 
	This process continues for <?php echo $ronde;?> time periods in total.</p>
<p align=justify>The available information for forecasting the stock <?php echo $task ?> in period <i>t</i> consists of all past <?php echo $stim ?>s up to period <i>t-1</i>, your 
	total earnings up to period <i>t-1</i>, <?php if ($treatment==3 or $treatment==4) {echo "the price in period <i>t-1</i> ";} ?>and your past <?php echo $task ?> forecasts up to period <i>t-1</i>. <b><?php if ($treatment==2 or $treatment==3) {echo "Notice that the variable you need to forecast differs from the variable you receive information about: You need to forecast "; echo $task; echo "s but you receive information about "; echo $stim; echo "s.";} ?></b> <?php if ($treatment==3) {echo "The stock return is the relative price change compared to the previous period: <p align=center>return<sub>t</sub> = (price<sub>t</sub> - price<sub>t-1</sub>)/price<sub>t-1</sub>.</p> The return therefore measures how fast prices are increasing or decreasing. For example, if the price in period <i>t-1</i> is 50 and the price in period <i>t</i> is 53, then the return in period <i>t</i> is (53-50)/50=0.06, or 6%.";} ?>
</b></p>
<p align=justify>In each period you have limited time to make your forecasting decision. If you do not submit a forecast 
	during this time frame, your pension fund will be inactive, and you will not earn any points in that given period. 
	A timer will show you the remaining time for each period (<?php echo $maxtijd1;?> minutes for each of the first 10 periods, <?php echo $maxtijd2;?> minute for each of the later periods).</p>
	<p align=justify><b>Information about the stock market</b></p>
<p align=justify> The stock price in period <i>t</i> depends on the aggregate demand for the stock and on the supply of stocks. The supply of stocks is fixed during the experiment. The demand for stocks is mainly determined by the aggregate demand of the large pension funds active in the market. In addition, there are some small investors that are active on the stock market. The higher the aggregate demand for stocks is, the higher the realized market price will be. There are 6 large pension funds in the stock market. Each pension fund is advised by a participant of the experiment.</p>
</td>
<td></td>

</tr>
</table>

<br />

<p align=center><a Href="instruction2.php">Next</a>

</BODY>
</HTML>
