#!/bin/bash
gpio mode 23 out
gpio mode 24 out
gpio mode 25 out
gpio mode 27 out
gpio mode 28 out
gpio mode 29 out
gpio write 23 1
gpio write 24 1
gpio write 25 1
gpio write 27 1
gpio write 28 1
gpio write 29 1
gpio mode 4 in
gpio mode 5 in

