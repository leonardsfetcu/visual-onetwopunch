#!/bin/bash
if [ -z $1 ]; then
	echo "Invalid parameter"
fi

path="logs/$1/pids.txt"

while read pid; do
	echo "Killing process $pid..."
	kill -9 $pid
done < $path