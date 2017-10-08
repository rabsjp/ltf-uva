<script language=javascript>
function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

function validateForm()
{	var y = getCheckedValue(document.forms["form1"]["sexe"]);
	var z = getCheckedValue(document.forms["form1"]["partsimilar"]);
	var c = getCheckedValue(document.forms["form1"]["heardthis"]);
	var a = document.forms["form1"]["leeftijd"].value;
	var d = document.forms["form1"]["yearstudie"].value;
	var e = document.forms["form1"]["fieldstudie"].value;
	var f = document.forms["form1"]["nationality"].value;
	var vraag6 = document.forms["form1"]["vraag6"].value;
	var vraag1 = getCheckedValue(document.forms["form1"]["vraag1"]);
	var vraag2 = getCheckedValue(document.forms["form1"]["vraag2"]);
	var vraag3 = getCheckedValue(document.forms["form1"]["vraag3"]);
	var vraag4 = getCheckedValue(document.forms["form1"]["vraag4"]);
	var vraag5 = getCheckedValue(document.forms["form1"]["vraag5"]);
	var vraag6 = getCheckedValue(document.forms["form1"]["vraag6"]);
	var vraag7 = getCheckedValue(document.forms["form1"]["vraag7"]);
	var vraag8 = getCheckedValue(document.forms["form1"]["vraag8"]);
	var vraag9 = getCheckedValue(document.forms["form1"]["vraag9"]);
	if (y != "" && z != "" && c != "" && d != "" && e != "" && f != ""  && a != "" && vraag1 != "" && vraag2 != "" && vraag3 != "" && vraag4 != "" && vraag5 != "" && vraag6 != "" && vraag7 != "" && vraag8 != "" && vraag9 != "") {
		return true;
	}else {
	alert("Please fill out the questionnaire.");
	return false
	};
}	
		

</script>