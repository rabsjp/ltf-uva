<?php
Header("Cache-Control: no-cache, must-revalidate");
include("common.inc");

if (!$_COOKIE['beheerder']){
	header("Location: begin.html");
	exit();
} 
$koek=readcookie("beheerder");
$ppnummer=$koek[0];
updateTableOne("ppnummers","ppnr=$ppnummer","currentpage",$_SERVER['PHP_SELF']);



$neteuros=lookUp("ppnummers","ppnr='$ppnummer'","neteuros1");

$totalverd=$neteuros+$showup;
updateTableOne("ppnummers","ppnr=$ppnummer","neteuros",$totalverd);




if (isset($_REQUEST['leeftijd'])) {
	$leeftijd=$_REQUEST['leeftijd']; 
}
if (isset($_REQUEST['sexe'])) {
	$sexe=$_REQUEST['sexe']; 
}
if (isset($_REQUEST['fieldstudie'])) {
	$fieldstudie=$_REQUEST['fieldstudie']; 
}

if (isset($_REQUEST['yearstudie'])) {
	$yearstudie=$_REQUEST['yearstudie']; 
}

	
if (isset($_REQUEST['heardthis'])) {
	$heardthis=$_REQUEST['heardthis']; 
}

if (isset($_REQUEST['partsimilar'])) {
	$partsimilar=$_REQUEST['partsimilar']; 
}

if (isset($_REQUEST['nationality'])) {
	$nationality=$_REQUEST['nationality']; 
}


if (isset($_REQUEST['vraag1'])) {
	$vraag1=$_REQUEST['vraag1']; 
}

if (isset($_REQUEST['vraag2'])) {
	$vraag2=$_REQUEST['vraag2']; 
}
if (isset($_REQUEST['vraag3'])) {
	$vraag3=$_REQUEST['vraag3']; 
}
if (isset($_REQUEST['vraag4'])) {
	$vraag4=$_REQUEST['vraag4']; 
}


if (isset($_REQUEST['send']) ) {
	updateTableMore("ppnummers","ppnr=$ppnummer","leeftijd='$leeftijd', sexe='$sexe', yearstudie='$yearstudie', fieldstudie='$fieldstudie', partsimilar='$partsimilar', nationality='$nationality', heardthis='$heardthis', vraag1='$vraag1', vraag2='$vraag2', vraag3='$vraag3', vraag4='$vraag4'");
	header("Location: overviewresults3.php");
	exit();
}



?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Questionnaire</title>
	<link rel="stylesheet" type="text/css" href="beleggensns.css" />
	
</head>
<body>
<h1 align=center>Questionnaire</h1>
<table>
<col width=10%>
<col width=80%>
<col width=10%>
<tr><td></td><td align=justify><h4>Please answer the following questions seriously. Your answers will help us understanding the findings of 
	this study. The questionnaire is anonymous. Unless otherwise specified, please answer 
	the following questions on a five-point scale where "1" indicates that you strongly disagree with the statement, 
	"3" means neutral, and "5" means strongly agree.</b></td><td></td></tr>
<tr><td></td><td>
<form  name="form1"  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateForm()">
<table  align=center>
<tr><td><b>Part 1</b></td></tr> 
<tr><td><b>
<?php echo "1. When I made my prediction, I took my previous prediction, and adjusted it based on the last observed price.";?>
 </b></td></tr> 
<tr align=center><td> strongly disagree
<input type="radio" name="vraag1" value="1" required>
<input type="radio" name="vraag1" value="2"> 
<input type="radio" name="vraag1" value="3"> 
<input type="radio" name="vraag1" value="4"> 
<input type="radio" name="vraag1" value="5"> strongly agree </td></tr>
<tr><td><br></td></tr>
<tr><td><b>
2.	When I made my prediction, I was more influenced by the last realized price rather than my last own prediction.  </b></td></tr> 
<tr align=center><td> strongly disagree
<input type="radio" name="vraag2" value="1" required>
<input type="radio" name="vraag2" value="2"> 
<input type="radio" name="vraag2" value="3"> 
<input type="radio" name="vraag2" value="4"> 
<input type="radio" name="vraag2" value="5">strongly agree </td></tr>
<tr><td><br></td></tr><tr><td><b>
<?php echo "3.	When the price was increasing in many periods in a row, I though that it will keep on increasing in the next period too.";?>
</b></td></tr> 
<tr align=center><td> strongly disagree
<input type="radio" name="vraag3" value="1" required>
<input type="radio" name="vraag3" value="2"> 
<input type="radio" name="vraag3" value="3"> 
<input type="radio" name="vraag3" value="4"> 
<input type="radio" name="vraag3" value="5">  strongly agree <?php if ($treatment==1 or $treatment ==4) {echo "&nbsp;&nbsp;&nbsp;&nbsp; <input type=\"radio\" name=\"vraag3\" value=\"NA\"> not applicable";} ?></td></tr>
<tr><td><br></td></tr><tr><td><b>
4.	If you followed a simple rule to determine your next prediction, please specify it here.  </b></td></tr> 
<tr align=center><td><textarea name="vraag4" cols="40" rows="5" AUTOCOMPLETE="OFF" required></textarea> </td></tr>
<tr><td><br></td></tr>



<tr><td><h4>Finally we would like to ask you to provide us with some statistical information about you. </h4> </td></tr>
<tr><td><br></td></tr>
<tr><td><b>Age: <select name='leeftijd' required>
			<option value="">(choose one)</option>
			<option value="18">18</option> 
			<option value="19">19</option> 
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>
			<option value="24">24</option>
			<option value="25">25</option>
			<option value="26">26</option>
			<option value="27">27</option>
			<option value="28">28</option>
			<option value="29">29</option>
			<option value="30">30</option>
			<option value="31">31</option>
			<option value="32">32</option>
			<option value="33">33</option>
			<option value="34">34</option>
			<option value="35">35</option>
			<option value="36">36</option>
			<option value="37">37</option>
			<option value="38">38</option>
			<option value="39">39</option>
			<option value="40">40</option>
			<option value="41">41</option>
			<option value="42">42</option>
			<option value="43">43</option>
			<option value="44">44</option>
			<option value="45">45</option>
			<option value="46">46</option>
			<option value="47">47</option>
			<option value="48">48</option>
			<option value="49">49</option>
			<option value="50">50</option>
			<option value="51">51</option>
			<option value="52">52</option>
			<option value="53">53</option>
			<option value="54">54</option>
			<option value="55">55</option>
			<option value="56">56</option>
			<option value="57">57</option>
			<option value="58">58</option>
			<option value="59">59</option>
			<option value="60">60</option>
			<option value="61">61</option>
			<option value="62">62</option>
			<option value="63">63</option>
			<option value="64">64</option>
			<option value="65">65</option>
			<option value="66">66</option>
			<option value="67">67</option>
			<option value="68">68</option>
			<option value="69">69</option>
			<option value="70">70</option>
			<option value="anders">Different</option> </select> </b> </td></tr>
<tr><td><br></td></tr>
<tr><td><b>  Gender: </b><input type="radio" name="sexe" value="man"> male <input type="radio" name="sexe" value="vrouw" required> female</td></tr>
<tr><td><br></td></tr>
<tr><td><b> Year of starting your study: <select name='yearstudie' required>
			<option value="">(choose one)</option>
			<option value="2000">2000</option> 
			<option value="2001">2001</option> 
			<option value="2002">2002</option>
			<option value="2003">2003</option>
			<option value="2004">2004</option>
			<option value="2005">2005</option>
			<option value="2006">2006</option>
			<option value="2007">2007</option>
			<option value="2008">2008</option>
			<option value="2009">2009</option>
			<option value="2010">2010</option>
			<option value="2011">2011</option>
			<option value="2012">2012</option>
			<option value="2013">2013</option>
			<option value="2014">2014</option>
			<option value="2015">2015</option>
			<option value="2016">2016</option>
			<option value="2017">2017</option>
			<option value="anders">Different</option> </select> </b> </td></tr>
<tr><td><br></td></tr>
<tr><td><b> Department where you study:
		<select name='fieldstudie' required >
			<option value="">(choose one)</option>
			<option value="econ">UVA - Faculty of Economics and Business</option> 
			<option value="psy">UVA - Faculty of Social and Behavioural Sciences - Psychology</option> 
			<option value="FMG">UVA - Faculty of Social and Behavioural Sciences - non psychology</option> 
			<option value="NWI">UVA - Faculty of Science</option> 
			<option value="betagamma">UVA - IIS: beta gamma bachelor</option> 
			<option value="Rechten">UVA - Faculty of Law</option> 
			<option value="Geestes">UVA - Faculty of Humanities</option> 
			<option value="Genees">UVA - Faculty of Medicine</option> 
			<option value="Tand">UVA - Faculty of Dentistry</option> 
			<option value="andU">Another university</option> 
			<option value="andH">A Dutch 'hogeschool' (HBO)</option> 
			<option value="anders">Different</option> </select>
		</b> </td></tr>
<tr><td><br></td></tr>
<tr><td><b> Nationality: <input type="text" name="nationality" AUTOCOMPLETE="OFF" required> </b> </td></tr>
<tr><td><br></td></tr>
<tr><td><b>  Have you heard about this experiment before you came to the laboratory?  </b> </td></tr>
<tr><td align=center> <input type="radio" name="heardthis" value="yes" required> yes <input type="radio" name="heardthis" value="no"> no </td></tr>
<tr><td><br></td></tr>
<tr><td><b>  Have you already participated in a similar experiment before?</b> </td></tr>
<tr><td align=center> <input type="radio" name="partsimilar" value="yes" required> yes <input type="radio" name="partsimilar" value="no"> no </td></tr>
<tr><td><br></td></tr>
<tr align=center><td>
<input type="submit" name="send" value="Submit"> </td></tr>


	</table>
</form>
</td><td></td></tr>
<tr><td></td><td><br></td><td></td></tr>
<tr><td></td><td>
<b>This is the end of the questionnaire. We ask you to remain seated quietly until you receive further instructions. </br>
</b></td><td></td></tr>
<tr><td></td><td><br><br><br></td><td></td></tr>

</table>
</body>
</html>


