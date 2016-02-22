#!/bin/bash

#watch -n 3 timeout 2 getledtemp
out='/var/www/html/scada/ramdisk/led.csv'
#ts=$(date '+%Y/%m/%d %H:%M:%S')


while [ true ]
do
data=$(timeout 2 getledtemp)

if [ "$data" != "" ]
then

ts=$(date '+%Y/%m/%d %H:%M:%S')
echo $ts";"$data >>"$out"

fi
sleep 10

done
