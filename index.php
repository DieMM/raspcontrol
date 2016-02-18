<?php 

ini_set('session.gc_maxlifetime', 36000);

// each client should remember their session id for EXACTLY 1 hour
session_set_cookie_params(36000);
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

//error_reporting(E_ALL);

include_once("func/makecanvas_sm.php");



//exec("/var/www/html/scada/func/makegraph_small.sh");
//echo "<img src='ramdisk/trend_small.jpg?tt=" . time() . "'>";








}
////////////////////////////////////////////////////////////////////////////////////////////

echo "</div></div>";
include_once("java.php");
include_once("footer.php");
?>


