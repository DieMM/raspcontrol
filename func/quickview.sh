#!/bin/bash


cat "/sys/bus/w1/devices/28-000003c4f62a/w1_slave" |grep t | cut -d "=" -f 2 >/var/www/html/scada/ramdisk/temp4 & #; // box
cat "/sys/bus/w1/devices/28-0215032ea2ff/w1_slave" |grep t | cut -d "=" -f 2 >/var/www/html/scada/ramdisk/temp3 & # // durchgang
cat "/sys/bus/w1/devices/28-000003c4f963/w1_slave" |grep t | cut -d "=" -f 2 >/var/www/html/scada/ramdisk/temp1 & # // links
cat "/sys/bus/w1/devices/28-021503c021ff/w1_slave" |grep t | cut -d "=" -f 2 >/var/www/html/scada/ramdisk/temp2 & # // rechs
sleep 3

echo "Innenraum-Links "`cat /var/www/html/scada/ramdisk/temp1`
echo "Innenraum-Rechts "`cat /var/www/html/scada/ramdisk/temp2`
echo "Zwischenraum "`cat /var/www/html/scada/ramdisk/temp1`
echo "Luftbox "`cat /var/www/html/scada/ramdisk/temp3`
echo "Licht-Links "`gpio read 4`
echo "Licht-Rechs "`gpio read 5`

a=`gpio read 23`
b=`gpio read 24`
c=`gpio read 25`

if [ "$a" != "0" ]
then
out=4
else
	if [ "$b" != "0" ]
	then
	out=3
	else
		if [ "$c" != "0" ]
		then
		out=2
		else
		out=1
		fi

	fi

fi
echo "LTI Stufe $out"

ul=`gpio read 27`
if [ "$ul" == "0" ]
then
echo "Umluft an"
else
echo "Umluft as"
fi


bl=`gpio read 28`
if [ "$bl" == "0" ]
then
echo "Boxluft an"
else
echo "Boxluft aus"
fi
