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
$t5 = fGetCachedTemp(5);


$l1 = fGetLightIndicator(fReadLight($lightsensor[0]));
$l2 = fGetLightIndicator(fReadLight($lightsensor[1]));

$ltistatus = fGetLTI();
$ul = fGetUmluft();
$bl = fGetBoxluft();

echo "<table class='table'>";
echo "<th>Sensor</th><th>Wert</th>";

echo "<tr><td>Links 1</td><td id='temp1'>$t1</td></tr>";
echo "<tr><td>Rechts 2</td><td id='temp2'>$t2</td></tr>";
echo "<tr><td>Durchgang 3</td><td id='temp3'>$t3</td></tr>";
echo "<tr><td>Luftbox </td><td id='temp4'>$t4</td></tr>";
echo "<tr><td>Temperatur LED</td><td id='temp5'>$t5</td></tr>";

echo "<tr><td>Licht 1</td><td id='licht1'>$l1</td></tr>";
echo "<tr><td>Licht 2</td><td id='licht2'>$l2</td></tr>";


echo "<tr><td>Umluft</td><td id='umluft'>" . LuefterButton("umluft",$ul) . "</td></tr>";


echo "<tr><td>Boxluft</td><td id='luftbox'>" . LuefterButton("boxluft",$bl) . "</td></tr>";





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
        }, 10000);
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


