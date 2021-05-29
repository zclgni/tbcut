#!/bin/bash
date=`date +%y%m%d%s`
echo $date
file="${date}.log"
commitTip="Add File ${file}"
echo $file
touch $file
echo $commitTip
git add .
git commit -a -m"{$commitTip}"
git push

