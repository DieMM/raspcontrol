#!/bin/bash

IST=$(mount | grep "/var/www/html/scada/ramdisk" | wc -l)
if [ "$IST" == "0" ]
then

mkdir -p /var/www/html/scada/ramdisk 2>/dev/null
mount -t tmpfs -o size=30m tmpfs /var/www/html/scada/ramdisk


point1=';15.937;15.187;11.187;15.312;-0.1;-0.1;-0.1;-0.1;-0.1;-0.1;-0.1;-0.1'
point2=';15.937;15.25;11.187;15.312;1.1;1.1;4.1;1.1;1.1;1.1;1.1;1.1'
ds1=$(date "+%Y/%m/%d %H:%M:%S")
sleep 1
ds2=$(date "+%Y/%m/%d %H:%M:%S")
out1='"'$ds1'"'$point1
echo $out1 > "/var/www/html/scada/ramdisk/output.csv"
out2='"'$ds2'"'$point2
echo $out2 >> "/var/www/html/scada/ramdisk/output.csv"

chown -R www-data:www-data /var/www/html/scada/ramdisk






fi
