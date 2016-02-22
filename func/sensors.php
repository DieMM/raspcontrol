<?php


function fGetTempSensors(){
	$busFolders = glob("/sys/bus/w1/devices/" . '*'); // predictable path on a Raspberry Pi
        if (0 === count($busFolders)) {
            return false;
        }

	for ($x=0;$x < count($busFolders);$x++){
		
        if (strpos("." . $busFolders[$x],"28")) $sensors[] = $busFolders[$x] . "/w1_slave";

	}
        
        return $sensors;
}

//////////////////////////////////////////////
function fGetCachedTemp($id){
exec("cat /var/www/html/scada/ramdisk/temp" . $id , $status);
$res = $status[0] / 1000;
return floatval($status[0]/1000);
return $res;

}
//////////////////////////////////////////////
function fReadTemp($sensor){
$raw = file_get_contents($sensor);
$raw = str_replace("\n", "", $raw);
$boom = explode('t=',$raw);
return floatval($boom[1]/1000);
}
//////////////////////////////////////////////
function fReadLight($gpio){
exec ( "gpio read $gpio", $status );
return $status[0];
}
//////////////////////////////////////////////
function fGetLTI(){
global $deaktiv;
global $lti , $ltiStufe;
for ($x = 0;$x < count($lti);$x++){
$pin = $lti[$x];
exec ( "gpio read $pin", $status );
}
if ($status[0] == $deaktiv) return 4;
if ($status[1] == $deaktiv) return 3;
if ($status[2] == $deaktiv) return 2;
return 1;
}
//////////////////////////////////////////////
function fGetUmluft(){
global $umluft;
exec ( "gpio read $umluft", $status );
if ($status[0] == 0){
return 1;
}else{
return 0;
}
}
//////////////////////////////////////////////
function fGetBoxluft(){
global $boxluft;
exec ( "gpio read $boxluft", $status );
if ($status[0] == 0){
return 1;
}else{
return 0;
}
}



?>