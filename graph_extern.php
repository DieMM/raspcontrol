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

error_reporting(E_ALL);
exec("/var/www/html/scada/func/makegraph.sh");
echo "<img src='ramdisk/trend.jpg?tt=" . time() . "'>";


}
////////////////////////////////////////////////////////////////////////////////////////////

echo "</div></div>";
include_once("java.php");
include_once("footer.php");
?>


