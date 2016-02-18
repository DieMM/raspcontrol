#!/bin/bash

pin=$1
dauer=$2
value=$3

let sec=$dauer*60
isvalue=$(gpio read $pin)
gpio write $pin $value
sleep $sec
gpio write $pin $isvalue
