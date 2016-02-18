#!/bin/bash


while [ true ]
do
a=$(timeout 2 cat "/sys/bus/w1/devices/28-000003c4f62a/w1_slave" |grep t | cut -d "=" -f 2)
if [ "$a" != "" ]
then
echo $a > /var/www/html/scada/ramdisk/temp4
fi
b=$(timeout 2 cat "/sys/bus/w1/devices/28-0215032ea2ff/w1_slave" |grep t | cut -d "=" -f 2)
if [ "$b" != "" ]
then
echo $b >/var/www/html/scada/ramdisk/temp3
fi
c=$(timeout 2 cat "/sys/bus/w1/devices/28-000003c4f963/w1_slave" |grep t | cut -d "=" -f 2)
if [ "$c" != "" ]
then
echo $c >/var/www/html/scada/ramdisk/temp1
fi
d=$(timeout 2 cat "/sys/bus/w1/devices/28-021503c021ff/w1_slave" |grep t | cut -d "=" -f 2)
if [ "$d" != "" ]
then
echo $d >/var/www/html/scada/ramdisk/temp2
fi


sleep 7
done
