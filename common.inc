<?php
define ("HOST","$IP:$PORT");

// fill in correct name of database
define ("DBNAME","c9");
// fill in correct loginname/password
define ("ADMIN","rabsjp");
//define ("WWOORD","psv999");
define ("WWOORD","");


//For this simple experiment we read all common parameters we will ever need.
$table_name="commonparameters";
$connection = @mysql_connect(HOST,ADMIN, WWOORD) or die(mysql_error());
$db = @mysql_select_db(DBNAME,$connection)or die(mysql_error());
$sql="SELECT * FROM $table_name";
$result=@mysql_query($sql,$connection) or die("Couldn't execute query ".$sql);
while ($row=mysql_fetch_array($result)) {
	$name=$row['name'];	
	$value=$row['value'];
	$$name=$value;
}



//reads one common parameter
//example: $startexperiment=readCommonParameter("startexperiment");
function readCommonParameter($name){
	$table_name="commonparameters";
	$connection = @mysql_connect(HOST,ADMIN, WWOORD) or die(mysql_error());
	$db = @mysql_select_db(DBNAME,$connection)or die(mysql_error());
	$sql="SELECT * FROM $table_name WHERE (name='$name')";
	$result=@mysql_query($sql,$connection) or die("Couldn't execute query ".$sql);
	if ($row=mysql_fetch_array($result)) {
		$value=$row['value'];
	}
	RETURN $value;
}

//Lookups one variable in one specif record
//example: $role=lookUp("groupcomposition","pp='$ppnummer'","role");
function lookUp($table_name,$condition,$name){
	$connection = @mysql_connect(HOST,ADMIN, WWOORD) or die(mysql_error());
	$db = @mysql_select_db(DBNAME,$connection)or die(mysql_error());
	$sql="SELECT $name FROM $table_name WHERE ($condition)"; // TAKEN OUT * and replaced by $name TO MAKE IT MUCH FASTER
	$result=@mysql_query($sql,$connection) or die("Couldn't execute query ".$sql);
	if ($row=mysql_fetch_array($result)) {
		$value=$row[$name];
	}
	else $value="";
	RETURN $value;
}

//Updates one variable in one record
//example updateTableOne("ppnummers","ppnummer=$ppnummer and session=$session","period","1");
function updateTableOne($table_name,$condition,$name,$value){
	$connection = @mysql_connect(HOST,ADMIN, WWOORD) or die(mysql_error()." updateTableConnectionError");
	$db = @mysql_select_db(DBNAME,$connection)or die(mysql_error());
	$sql="UPDATE $table_name SET $name=\"$value\" WHERE ($condition)";
	$result=@mysql_query($sql,$connection) or die("Couldn't execute query ".$sql);
}

//Updates more variables in the same record
//example: updateTableMore("glazen","codeglas=\"$codeglas\"","hoogte=\"$hoogte\", jeneverofniet=\"$jeneverofniet\"");
function updateTableMore($table_name,$condition,$updatestring){
	$connection = @mysql_connect(HOST,ADMIN, WWOORD) or die(mysql_error()." updateTableConnectionError");
	$db = @mysql_select_db(DBNAME,$connection)or die(mysql_error());
	$sql="UPDATE $table_name SET ".$updatestring." WHERE ($condition)";
	$result=@mysql_query($sql,$connection) or die("Couldn't execute query ".$sql);
}

//inserts new record in table
//example: insertRecord("decisions","ppnummer, period, decision, kans, tijd","\"$ppnummer\", \"$period\", \"$keus1\", \"$kans\", \"$tijd\"");
function insertRecord($table_name,$names,$values){
	$connection = @mysql_connect(HOST,ADMIN, WWOORD) or die(mysql_error()." updateTableConnectionError");
	$db = @mysql_select_db(DBNAME,$connection)or die(mysql_error());
	$sql="INSERT INTO $table_name (".$names.") VALUES (".$values.")";
	$result=@mysql_query($sql,$connection) or die("Couldn't execute query ".$sql);
}

//Function by Jona Linde:
//creates a multidimensional array from the string by exploding using the symbols in $delimiters. 
//Number of dimensions is given by the number of symbols in $delimiters.
//Set delimiters by for example $delimiters=array(";",",");
function multiexplode ($delimiters,$string) {
    $ary = explode($delimiters[0],$string);
    array_shift($delimiters);
    if($delimiters != NULL) {
        foreach($ary as $key => $val) {
             $ary[$key] = multiexplode($delimiters, $val);
        }
    }
    return  $ary;
}

//Function by Jona Linde:
//Lookups one variable in one specific record at random
//example: $role=lookUpRnd("groupcomposition","pp='$ppnummer'","role");
function lookUpRnd($table_name,$condition,$name){
$connection = @mysql_connect(HOST,ADMIN, WWOORD) or die(mysql_error());
$db = @mysql_select_db(DBNAME,$connection)or die(mysql_error());
$sql="SELECT * FROM $table_name WHERE ($condition) ORDER BY RAND()";
$result=@mysql_query($sql,$connection) or die("Couldn't execute query ".$sql);
if ($row=mysql_fetch_array($result)) {
$value=$row[$name];
}
else $value="";
RETURN $value;
}

//Instruction menu based upon Roel van Veldhuizen design
//You need a table "instructions" with a list of instruction pages. For example:
//		CREATE TABLE `instructions` (
//		  `part` int(11) NOT NULL,
//		  `pagenumber` int(11) default NULL,
//		  `filename` varchar(80) NOT NULL,
//		  `nameinmenu` varchar(80) NOT NULL
//		) ENGINE=MyISAM DEFAULT CHARSET=latin1;
//		INSERT INTO `instructions` VALUES (1, 0, 'instructie1.php', 'Introduction');
//		INSERT INTO `instructions` VALUES (1, 1, 'instructie2.php', 'Payoff table');
//		INSERT INTO `instructions` VALUES (1, 2, 'instructiequestion1.php', 'Question 1');
//		INSERT INTO `instructions` VALUES (1, 3, 'instructiequestion2.php', 'Question 2');
//		INSERT INTO `instructions` VALUES (1, 4, 'instructiesummary.php', 'Summary');
//		INSERT INTO `instructions` VALUES (2, 0, 'instructiepart21.php', 'Introduction part 2');
//		INSERT INTO `instructions` VALUES (2, 1, 'instructiepart22.php', 'Group composition');
//		INSERT INTO `instructions` VALUES (2, 2, 'instructiepart23.php', 'Summary');
//In addition your ppnummers table needs to keep track of the maximum page visited by the subject by the variable 
//vrijgemaakt1 (for instructions part 1), vrijgemaakt2 (instructions part 2) etc.

function instructionMenu($page, $ppnr){
	//de directory name van de page verwijderen
	$page = substr(strrchr($page, '/'),1);
	//eerst instructietable inlezen en zoeken naar deze pagina
	$connection = @mysql_connect(HOST,ADMIN, WWOORD) or die(mysql_error());
	$db = @mysql_select_db(DBNAME,$connection)or die(mysql_error());
	$sql="SELECT * FROM instructions";
	$result=@mysql_query($sql,$connection) or die("Couldn't execute query ".$sql);
	$i=0;
	while ($row=mysql_fetch_array($result)){
		$menuarray[$row['part']][$row['pagenumber']]= array($row['filename'],$row['nameinmenu']);
		if ($page==$row['filename']) {
			$part=$row['part'];			
			$thispage=$row['pagenumber'];			
		}
		$i++;
	}	
	if (!isset($part)) {
		$error="ERROR! this file is not in the instructions table.";
		RETURN $error;
	}
	$vrijgemaakt=lookUp("ppnummers","ppnr=".$ppnr,"vrijgemaakt".$part);
	if ($thispage>$vrijgemaakt){
		$vrijgemaakt=$thispage;
		updateTableOne("ppnummers","ppnr=$ppnr","vrijgemaakt".$part,$vrijgemaakt);
	}
	$count=count($menuarray[$part]);
	$menutable="<table align=center border=7><tr>";
	for($counter=0;$counter<$count;$counter++){
		if ($thispage==$counter) {
			$menutable .="<td> <font color=blue><b>".$menuarray[$part][$counter][1]."</b></font></td>";
		} elseif ($vrijgemaakt<$counter) {
			$menutable .="<td> <font color=black>".$menuarray[$part][$counter][1]."</font></td>";
		} else {
	$menutable .="<td> <a Href='".$menuarray[$part][$counter][0]."'><font color=blue>".$menuarray[$part][$counter][1]."</font></a></td>";			
		}
	}
	$menutable .= "</tr></table>";
	RETURN $menutable;
} 


//Output is a standard start of a htmlpage, with no cache, browsing back disabled, enterkey is disabled in form
function startpage($title) {
	?>
	<html>
	<head>
	<title><?php echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<meta http-equiv="Expires" content="Mon, 01 Jan 1990 12:00:00 GMT">
	<link rel="stylesheet" type="text/css" href="beleggensns.css"" />
	<script language="JavaScript">
	function blockEnter(evt) {
	  evt = (evt) ? evt : event;
	  var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	  if (charCode == 13 || charCode == 3) {
	    return false;
	  } else {
	    return true;
	  }
	}
	</script>
	</head>
	<body>
	<?php
}

//returns a array of the variables saved in the cookie with writecookie
//example: $koek=readcookie("beheerder");
//$ppnummer=$koek[0];
function readcookie($variable){
	$cookie_val=$_COOKIE[$variable];
	return explode("-",$cookie_val);
}

//writes a cookie
//example: writecookie("beheerder",$ppnummer);
//or:      writecookie("beheerder",$ppnummer,$role);
function writecookie() {
	$numargs = func_num_args();
	$arg_list = func_get_args();
	$cookie_val="";
	$cookie_val =$arg_list[1];
	for ($i = 2; $i <= LENGTHCOOKIE; $i++) {
		if ($i<$numargs) {
			$cookie_val .="-".$arg_list[$i];
		}
		else {
			$cookie_val .="- ";
		}
	}
	setcookie($arg_list[0], $cookie_val); 
}

?>