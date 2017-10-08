<?php
include("common.inc");

$nrgroup=$numbersubj/6;

for ($i=1; $i<=$nrgroup; $i++){
    $ppnummer=$i*10+1;
    $round=lookUp("ppnummers","ppnr='$ppnummer'","round");
    $arrayprice=array();

    for ($j=1; $j<=$round-2; $j++){
        $marketprice=lookUp("results","ppnr='$ppnummer' and round='$j'", "marketprice");
        array_push($arrayprice,"$marketprice");
        
    }
    // to check whether the maximum y-value on the graph is larger than 100 we define the maximum y-value
    $maxgraph=max($arrayprice);
    $maxscale=ceil($maxgraph/50)*50;
    
    ${"figuur".$i}="var c = document.getElementById(\"myCanvas".$i."\");
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
        ${"figuur".$i}.="for (i = 0; i < 10; i++) { 
            ctx.fillText(100-i*10,30,i*30+25);
            }
            ctx.stroke();

            ctx.beginPath();
            ctx.strokeStyle=\"red\";
            var price= ".json_encode($arrayprice).";
            for (i = 0; i < price.length; i++) { 
            ctx.moveTo(50+i*10,320-3*price[i-1]);
            ctx.lineTo(50+(i+1)*10,320-3*price[i]);
            ctx.arc(50+(i+1)*10,320-3*price[i],3,0,2*Math.PI);}
            ctx.stroke();";

            
    }
    else {
        ${"figuur".$i}.="for (i = 0; i < 10; i++) { 
            ctx.fillText(".$maxscale."-i*(".$maxscale."/10),25,i*30+25);
            }
            ctx.stroke();

            ctx.beginPath();
            ctx.strokeStyle=\"red\";
            var price= ".json_encode($arrayprice).";
            for (i = 0; i < price.length; i++) { 
                ctx.moveTo(50+i*10,320-(300/".$maxscale.")*price[i-1]);
                ctx.lineTo(50+(i+1)*10,320-(300/".$maxscale.")*price[i]);
                ctx.arc(50+(i+1)*10,320-(300/".$maxscale.")*price[i],3,0,2*Math.PI);}
            ctx.stroke();";

            

    }


}
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="beleggensns.css" />
<body>
  
    <h4 align=center> Prices in the different groups</h4>
    <br>

<?php for ($i=1; $i<=$nrgroup; $i++){

echo "<canvas id=\"myCanvas".$i."\" width=\"600\" height=\"350\"></canvas>
<script> ".${"figuur".$i}."</script>";
} ?>

</body>
</html>
