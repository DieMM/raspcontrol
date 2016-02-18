#!/bin/bash


raspistill -w 1024 -h 768 -q 75 -t 100 -e jpg -vf -hf -o /var/www/html/scada/img/rasppic.jpg