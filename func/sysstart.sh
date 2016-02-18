#!/bin/bash

IST=$(mount | grep "/var/www/html/scada/ramdisk" | wc -l)
if [ "$IST" == "0" ]
then
/var/www/html/scada/makefs.sh
/var/www/html/scada/initiate_gpio.sh
fi