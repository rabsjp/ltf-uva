<?php
include("common.inc");

Header("Cache-Control: must-revalidate");
if (!$_COOKIE['beheerder']){
	header("Location: begin.html");
	exit();
} 
//read the current period
$koek=readcookie("beheerder");
$ppnummer=$koek[0];
$round=lookUp("ppnummers","ppnr='$ppnummer'","round");
$prevround = $round-1;




$arraystim=array();

if ($round>1) {

    for ($j=1; $j<=$round-1; $j++){
           $marketprice=lookUp("results","ppnr='$ppnummer' and round='$j'", "marketprice");
           array_push($arraystim,"$marketprice");
       }
       
        
    
    // to check whether the maximum y-value on the graph is larger than 100 we define the maximum y-value

    $maxgraph=max($arraystim);
    $maxscale=ceil($maxgraph/50)*50;     
    
    

      
    $figuur="var c = document.getElementById(\"myCanvas\");
        var ctx = c.getContext(\"2d\");
        ctx.beginPath();
        ctx.strokeStyle = \"#000000\";
        ctx.moveTo(50,20);
        ctx.lineTo(50,320);
        ctx.lineTo(550,320);
        for (i = 0; i < 51; i++) { 
            ctx.moveTo(50+i*10,320);
            ctx.lineTo(50+i*10,325);
        }
        for (i = 0; i < 21; i++) { 
            ctx.moveTo(45,i*15+20);
            ctx.lineTo(50,i*15+20);
        }
        ctx.font = \"12px Arial\";
        for (i = 1; i < 11; i++) { 
           ctx.fillText(i*5,50+i*50-4,335);
        }";

    if ($maxgraph<=100){ 
        $figuur.="for (i = 0; i < 10; i++) { 
            ctx.fillText(100-i*10,30,i*30+25);
            }
            ctx.stroke();

            ctx.beginPath();
            ctx.strokeStyle=\"red\";
            var price= ".json_encode($arraystim).";
            for (i = 0; i < price.length; i++) { 
            ctx.moveTo(50+i*10,320-3*price[i-1]);
            ctx.lineTo(50+(i+1)*10,320-3*price[i]);
            ctx.arc(50+(i+1)*10,320-3*price[i],3,0,2*Math.PI);}
            ctx.stroke();

            ctx.beginPath();
            ctx.strokeStyle=\"blue\";";
            
            
            $figuur.="ctx.stroke();";
    }
    else {
        $figuur.="for (i = 0; i < 10; i++) { 
            ctx.fillText(".$maxscale."-i*(".$maxscale."/10),25,i*30+25);
            }
            ctx.stroke();

            ctx.beginPath();
            ctx.strokeStyle=\"red\";
            var price= ".json_encode($arraystim).";
            for (i = 0; i < price.length; i++) { 
                ctx.moveTo(50+i*10,320-(300/".$maxscale.")*price[i-1]);
                ctx.lineTo(50+(i+1)*10,320-(300/".$maxscale.")*price[i]);
                ctx.arc(50+(i+1)*10,320-(300/".$maxscale.")*price[i],3,0,2*Math.PI);}
            ctx.stroke();

            ctx.beginPath();
            ctx.strokeStyle=\"blue\";";

             
            $figuur.="ctx.stroke();";


    }



}



?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="beleggensns.css" />
<body>
    <h4 align=center> Information about past prices</h4>
    <br>
<canvas id="myCanvas" width="600" height="350">
</canvas>


<script>


<?php echo $figuur;?>


</script>

<?php echo "<table align=center>
        <col width=6%>
        <col width=41%>
        <col width=6%>
        <col width=41%>
        <col width=6%>
        <tr><td></td></tr></table>";?>

</body>
</html>
