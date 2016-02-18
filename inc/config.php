<?php

/////////////////////////////////
// Main

$ramdisk = "/var/www/html/scada/ramdisk";

//
$mainlog = $ramdisk ."/output.log";
$maincsv = $ramdisk ."/output.csv";
$alarmlog = $ramdisk ."/alarm.log";

//Sensoren
// 0 = innen links oben
// 1 = innen rechts oben
// 2 = Luftdurchgang links -> rechts
// 3 = Luftbox

$sensor[3] = "/sys/bus/w1/devices/28-000003c4f62a/w1_slave"; // box
$sensor[2] = "/sys/bus/w1/devices/28-0215032ea2ff/w1_slave"; // durchgang
$sensor[0] = "/sys/bus/w1/devices/28-000003c4f963/w1_slave"; // links
$sensor[1] = "/sys/bus/w1/devices/28-021503c021ff/w1_slave"; // rechs


/*
$sensor[0] = "/sys/bus/w1/devices/28-000003c4f62a/w1_slave";
$sensor[1] = "/sys/bus/w1/devices/28-0215032ea2ff/w1_slave";
$sensor[2] = "/sys/bus/w1/devices/28-000003c4f963/w1_slave";
$sensor[3] = "/sys/bus/w1/devices/28-021503c021ff/w1_slave";
*/
///////////////////////////////
//limits
$mintemp = 18;
$maxtemp = 28;
$steplimit[1] = 22;
$steplimit[2] = 25;
$steplimit[3] = 28;
$boxlimit = 20;

$stepsensors=array(0,1,2);
$boxsensor = 3;



///////////////////////////////

// Lichtsensor 
$lightsensor[0] = "4";
$lightsensor[1] = "5";

//LTI
$lti = array("23","24","25");
$ltiStufe[0] = array("23","24","25");   // ---> 
$ltiStufe[1] = array("23","24");
$ltiStufe[2] = array("23");
$deaktiv = 1;
$aktiv = 0;
$ltimin = 1;


//Umluft 
$umluft = "27";
$umluftdauer = 10;   // 
$umluftanmod = 15;   // (jede x. Miute wird der Luefter fuer umluftdauer angeworfen
$umluftscript = "/var/www/html/scada/func/umluft_an.sh"; // PIN DAUER NEUERWERT

//27 28
//Boxbeluefter
$boxluft = "28";








?>
