<?php 

session_start();
if(isset($_REQUEST['logout'])) {
session_destroy();
header('Location: index.php');
}


include_once("func/user.php");	


////////////////////////////////////////////////////////////////////////////////////////////
if ($loggedin){
include_once("inc/config.php");
include_once("func/sensors.php");
include_once("func/actors.php");
include_once("func/actions.php");

$t1 = fGetCachedTemp(1);
$t2 = fGetCachedTemp(2);
$t3 = fGetCachedTemp(3);
$t4 = fGetCachedTemp(4);
$l1 = fGetLightIndicator(fReadLight($lightsensor[0]));
$l2 = fGetLightIndicator(fReadLight($lightsensor[1]));
$ltistatus = fGetLTI();
$ul = fGetUmluft();
$bl = fGetBoxluft();



$data['temp1'] = $t1;
$data['temp2'] = $t2;
$data['temp3'] = $t3;
$data['temp4'] = $t4;
$data['licht1'] = $l1;
$data['licht2'] = $l2;
$data['umluft'] = LuefterButton("umluft",$ul);
$data['luftbox'] = LuefterButton("boxluft",$bl);
$data['LTI']= LTIForm($ltistatus);
$data['luo'] = date('l jS \of F Y h:i:s A');
$ret = json_encode($data);
echo $ret;




}
////////////////////////////////////////////////////////////////////////////////////////////
?>


