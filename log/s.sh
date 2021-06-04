#!/bin/bash
file_number=$(ls | grep log | wc -l)
echo $file_number
if [ $file_number > 0 ];then
	rm -rf ./*.log
fi
#rm -rf "./${file}"
