<?php
///////////////////////////////////////////////

///////////////////////////////////////////////
function fSet($gpio,$value){
exec ( "gpio write $gpio $value", $status );
return $status[0];
}

///////////////////////////////////////////////
function LTIForm($status=4){
$tmp = "<form method='post'><input type='hidden' name='action' value='1'>";
$tmp .= "<input type='hidden' name='func' value='lti'>";
$tmp .= "<select name='val' class='form-control'>";
for ($x=1;$x <5;$x++){
	$sel="";
		if ($status == $x) $sel='selected="selected"';
	$tmp .= "<option value='$x' $sel >$x</option>";
}
$tmp .= "</select>";
//$tmp .= "<input type='submit' value='LTI Umstufen' class='form-control'></form>";
$tmp .= "<button type='submit' class='btn btn-primary'>LTI Umstufen</button></form>";
return $tmp;
}
//////////////////////////////////////////////
function LuefterButton($luefter,$status){
if ($status == 1){
	$label = "Ausschalten";
	$pic = "btn-success";
	$img = "<img src='img/VentiOn.gif'>";
	$neu = 0;
}else{
	$neu = 1;
	$label = "Einschalten";
	$pic = "btn-danger";
	$img = "<img src='img/VentiOff.gif'>";
}
$tmp = "<form method='post'><input type='hidden' name='action' value='1'>";
$tmp .= "<input type='hidden' name='func' value='$luefter'>";
$tmp .= "<input type='hidden' name='val' value='$neu'>$img";
$tmp .= "<button type='submit' class='btn $pic'>$label</button></form>";
return $tmp;
}
////////////////////////////////////////////////
function fGetLightIndicator($value){
if ($value == 1) $tmp = "<img src='img/LightOn.jpg' alt='light on' width='31' height='45'>";
if ($value == 0) $tmp = "<img src='img/LightOff.jpg' alt='light off'  width='31' height='45'>";
return $tmp;
}


////////////////////////////////////////////////
function FRaspPic(){
exec ("sudo /var/www/html/scada/func/makerasppic.sh");
exec ("sudo  /var/www/html/scada/func/makewebcampic.sh &");
}




?>