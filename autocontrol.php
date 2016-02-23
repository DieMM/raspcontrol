<?php

$newline = "<br>";

//$date = date(DATE_RFC822);
$date = date('Y/m/d H:i:s');
//echo "<h1>$date</h1>";
//exit;


include_once("inc/config.php");
include_once("func/sensors.php");
include_once("func/actors.php");
include_once("func/actions.php");


$file = fopen($maincsv,"a");

$logline="";

//////////////////////////////////////////////////
//////////////////////////////////////////////////
///// TEMPERATUR
for ($x=0;$x<count($sensor);$x++){
$sid = $x+1;
//$temp[$x] = fReadTemp($sid);
$temp[$x] = fGetCachedTemp($sid);


echo "$x: " . $temp[$x]  . "<br>";
if (strlen($logline) >0)$logline .= ";";
$logline .= $temp[$x];
}
//////////////////////////////////////////////////

$licht1 = fReadLight($lightsensor[0]);
$licht2 = fReadLight($lightsensor[1]);
$ltiist = fGetLTI();
$umluftist = fGetUmluft();
$boxluftist =  fGetBoxluft();

//////////////////////////////////////////////////
///// Licht und Lüfter (ist)
$logline .= ";" .  $licht1 ;//. "(Licht1)";
$logline .= ";" .  $licht2 ;//. "(Licht2)";
$logline .= ";" .  $ltiist ;//. "(LTIIst)";
$logline .= ";" .  $umluftist ;//. "(UmluftIst)";
$logline .= ";" .  $boxluftist ;//. "(BoxluftIst)";
//////////////////////////////////////////////////
//////////////////////////////////////////////////




/////////////////////////////////////////////////
/////////////////////////////////////////////////
//Neue LTI Stufe
$min=99;
$max=0;
for ($x=0;$x <count($stepsensors);$x++){
$t1 = $temp[$stepsensors[$x]];
echo $t1 . $newline;
if ($t1 < $min) $min = $t1;
if ($t1 > $max) $max = $t1;
}
$ltineu = fFindStep($min,$max);
if ($ltineu < $ltimin ) $ltineu = $ltimin;
if ($ltiist != $ltineu){


	$setting = $ltiStufe[$ltineu -1];
	for ($x =0 ;$x < count($lti); $x++){
		$pin = $lti[$x];
		if (in_array($pin,$setting)){
			fSet($pin,$aktiv);
		}else{
			fSet($pin,$deaktiv);
		}	
	}
}
$ltiistneu = fGetLTI();
$logline .= ";" .  $ltiistneu ;
///////////////////////////////
//Box-Luefter
$boxtemp = $t1;
if ($boxtemp < $boxlim['temp1']){
$blsoll = 1;
}else{
$blsoll = 0;
}




if ($boxluftist != $blsoll){
if ($blsoll == 1) $blset = 0;
if ($blsoll == 0) $blset = 1;
$gpio = $boxluft;
fSet($gpio,$blset);
}

$blneu = fGetBoxluft();
$logline .= ";" .  $blneu ;
////////////////////////////////////////////////////////
// UMLUFT
$minutes = intval(date('i'));
$rest = $minutes % $umluftanmod ;
if ($rest == 0){
exec ( "sudo " . $umluftscript . " " .  $umluft . " " . $umluftdauer . " " . $aktiv );
$logline .= ";" .  $aktiv ;
}else{
$logline .= ";" .  $deaktiv ;

}


////////////////////////////////////////////////////////
/// WRITE CSV
$logline = $date .";" . $logline;
fputcsv($file,explode(';',$logline), ";");




////////////////////////////////////////////////////////

function fFindStep($min,$max){
global $steplimit,$mintemp,$maxtemp;


if ($max > $maxtemp) {
$step = 4;
return $step;
}
if ($min < $mintemp) {
$step = 1;
return $step;
}

if ($min < $steplimit[3]){
$step = 3;

}

if ($min < $steplimit[2]){
$step = 2;

}

if ($min < $steplimit[1]){
$step = 1;

}

return $step;




}



?>
