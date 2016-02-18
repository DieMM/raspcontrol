#!/bin/bash


UT=$(cat /proc/uptime | cut -d "." -f 1)

if [ $UT -lt 120 ]
then
sleep 30
fi

SCRIPT1="/var/www/html/scada/scripts/SubReadTempToFile.sh"

screen -dmS TempReadOut $SCRIPT1


