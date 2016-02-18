<?php 

session_start();
if(isset($_REQUEST['logout'])) {
session_destroy();
header('Location: index.php');
}


include_once("header.php");
include_once("navbar.php");
echo "<div class='container'><div class='page-header'>";
include_once("func/user.php");	


////////////////////////////////////////////////////////////////////////////////////////////
if ($loggedin){

include_once("inc/config.php");
include_once("func/sensors.php");
include_once("func/actors.php");
include_once("func/actions.php");

if (isset($_REQUEST['action'])) fPerformAction();





$t1 = fGetCachedTemp(1);
$t2 = fGetCachedTemp(2);
$t3 = fGetCachedTemp(3);
$t4 = fGetCachedTemp(4);


$l1 = fGetLightIndicator(fReadLight($lightsensor[0]));
$l2 = fGetLightIndicator(fReadLight($lightsensor[1]));

//$lo1 = fReadLight($lightsensor[0]);
//$lo2 = fReadLight($lightsensor[0]);

$bgcol1 = '#DF7401';
$bgcol2 = '#DF7401';
//if ($lo1 == 1 ) $bgcol1 = '#999900';
//if ($lo2 == 1 ) $bgcol2 = '#999900';




$ltistatus = fGetLTI();
$ul = fGetUmluft();
$bl = fGetBoxluft();


echo "<table width='1000px' >";
echo "<tr height='450px'>";
echo "<td width ='150px'>";
///////////////////////////////////  LUFTBOX
echo "<table width='100%' >";
echo "<tr height='350px'><td>&nbsp;</td></tr>";
echo "<tr height='150px'><td BGCOLOR='#666666'><table border='1' width='100%'><tr height='150px'><td width='100%' align='center'>";
//++++++++++++++++
echo "<p id='temp4' align='center' style='color:white'>" . $t4 . "</p>";
echo "<div id='luftbox'>" . LuefterButton("boxluft",$bl) ."</div>"; 
//----------------
echo "</td></tr></table></td></tr>";
echo "</table>";
///////////////////////////////////

echo "</td>";
echo "<td width ='550px'  BGCOLOR='$bgcol1'>";
/////////////////////////////////// LINKE KAMMER

echo "<table width='100%' border='1'>";
echo "<tr height='500px'>";
echo "<td width='100%'>";
//++++++

echo "<table width='100%' border='0'>";
echo "<tr height='100px'>";
echo "<td width='20%'></td>";
echo "<td width='70%' id='licht1' align='center'>".$l1."</td>";
echo "<td width='10%'></td>";
echo "</tr>";

echo "<tr height='50px'>";
echo "<td width='20%' id='temp1' align='center' style='color:blue;font-size:20px'>$t1</td>";
echo "<td width='70%'></td>";
echo "<td width='10%' id='temp3' align='right' style='color:blue;font-size:20px;transform:rotate(-90deg)'>$t3</td>";
echo "</tr>";

echo "<tr height='100px'>";
echo "<td width='20%' id='umluft'>" . LuefterButton("umluft",$ul) . "</td>";
echo "<td width='70%'></td>";
echo "<td width='10%'></td>";
echo "</tr>";

echo "<tr height='250px'>";
echo "<td width='20%'></td>";
echo "<td width='70%'></td>";
echo "<td width='10%'></td>";
echo "</tr>";



echo "</table>";

//------
echo "</td></tr>";
echo "</table>";

///////////////////////////////////
echo "</td>";





echo "<td width ='300px' BGCOLOR='$bgcol2'>";
/////////////////////////////////// RECHTE KAMMER
echo "<table width='100%' border='1'>";
echo "<tr height='500px'>";
echo "<td width='100%'>";
//++++++

echo "<table width='100%' border='0'>";
echo "<tr height='100px'>";
echo "<td width='20%'></td>";
echo "<td width='60%' id='licht2' align='center'>".$l2."</td>";
echo "<td width='20%'></td>";
echo "</tr>";

echo "<tr height='50px'>";
echo "<td width='20%' id='temp2' align='center' style='color:blue;font-size:20px'>$t2</td>";
echo "<td width='60%'></td>";
echo "<td width='20%'></td>";
echo "</tr>";

echo "<tr height='100px'>";
echo "<td width='20%' id='umluft'>" . LuefterButton("umluft",$ul) . "</td>";
echo "<td width='60%'></td>";
echo "<td width='20%'></td>";
echo "</tr>";

echo "<tr height='250px'>";
echo "<td width='20%'></td>";
echo "<td width='60%'></td>";
echo "<td width='20%'></td>";
echo "</tr>";



echo "</table>";

//------
echo "</td></tr>";
echo "</table>";

///////////////////////////////////
echo "</td>";

echo "</tr>";
echo "</table>";




echo "<table class='table'>";
//echo "<th>Sensor</th><th>Wert</th>";

//echo "<tr><td>Temperatur 1</td><td id='temp1'>$t1</td></tr>";
//echo "<tr><td>Temperatur 2</td><td id='temp2'>$t2</td></tr>";
//echo "<tr><td>Temperatur 3</td><td id='temp3'>$t3</td></tr>";
//echo "<tr><td>Temperatur 4</td><td id='temp4'>$t4</td></tr>";

//echo "<tr><td>Licht 1</td><td id='licht1'>$l1</td></tr>";
//echo "<tr><td>Licht 2</td><td id='licht2'>$l2</td></tr>";
//echo "<tr><td>Umluft</td><td id='umluft'>" . LuefterButton("umluft",$ul) . "</td></tr>";
//echo "<tr><td>Boxluft</td><td id='luftbox'>" . LuefterButton("boxluft",$bl) . "</td></tr>";





echo "<tr><td>LTI</td><td id='lti'>". LTIForm($ltistatus) ."</td></tr>";

echo "<tr><td>Letztes Update</td><td id='luo'>". date('l jS \of F Y h:i:s A') ."</td></tr>";

echo "</table>";










}
////////////////////////////////////////////////////////////////////////////////////////////

$jsonuri = "http://" . $_SERVER["HTTP_HOST"]. "/control_json.php";

?>
<script src="inc/jquery.js"></script>
<script type="text/javascript"> 

$( document ).ready(function() {

        setInterval(function() {
            myFunction();
        }, 3000);
//myFunction();

});


function myFunction() {
  var url = "<?php echo $jsonuri; ?>";
  $.getJSON( url, {
    tags: "mount rainier",
    tagmode: "any",
    format: "json"
  })
    .done(function( data ) {
	
//var arr = $.map(data, function(el) { return el });
//	alert(arr);
var id;
$.each(data,function (index, value) { 
  console.log('div' + index + ':' + value);
	id = '#' + index;
//	$.(id).html(value);
	$(id).html( "" );
	$(id).html( value );

  
});


      
});

}



</script>



<?php
echo "</div></div>";
include_once("java.php");
include_once("footer.php");
?>


