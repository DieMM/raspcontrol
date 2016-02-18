#!/bin/bash



script="/var/www/html/scada/func/umluftzyklus.sh";

running=$(ps aux | grep umluftzyklus.sh | grep -v grep | wc -l)

if [ "$running" == "0" ]
then

screen -dmS Umluft $script $1 $2 $3

fi 
