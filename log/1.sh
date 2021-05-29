#!/bin/bash
date=`date +%y%m%d%s`
echo $date
file="${date}.log"
commitTip="Add File ${file}"
touch $file
echo $commitTip
chmod 0777 $file
echo $date > "./${file}"
git add .
git commit -a -m"$commitTip"
git push

