<?php


/////////////////////////////////////////////////////////
function fPerformAction(){
//print_r($_REQUEST);
global $lti, $ltiStufe, $umluft, $boxluft, $deaktiv,$aktiv;

$func = $_REQUEST['func'];
$value = $_REQUEST['val'];

if ($func == "umluft"){
$gpio = $umluft;
if ($value == 1){
$value=0;
}else{
$value=1;
}

fSet($gpio,$value);
}

if ($func == "boxluft"){
$gpio = $boxluft;
if ($value == 1){
$value=0;
}else{
$value=1;
}
fSet($gpio,$value);
}

if ($func == "lti"){
	$setting = $ltiStufe[$value -1];
	for ($x =0 ;$x < count($lti); $x++){
		$pin = $lti[$x];
		if (in_array($pin,$setting)){
			fSet($pin,$aktiv);
		}else{
			fSet($pin,$deaktiv);
		}	
	}
}



}

/////////////////////////////////////////////////////////








?>