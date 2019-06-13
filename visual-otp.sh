#!/bin/bash

target=$1
scannerId=$2
nmapParam="-sV --script nmap-vulners -O -T4 -sS"

if [ -z $2 ] || [ -z $1 ]; then
	echo "Invalid parameters"
	exit
fi


if [[ ! -d "logs" ]]; then
	mkdir "logs"
fi

path="logs/$scannerId"
if [[ ! -d $path ]]; then
	mkdir $path
fi

# save the pids for current instance of scanner script
ps -aux | grep [v]isual | tr -s ' ' | cut -d ' ' -f2 > $path/"pids.txt"

# check if a dir with same date exists and create a new one if not
if [[ ! -d "$path/$(date '+%d-%m-%Y')" ]]; then
	mkdir "$path/$(date '+%d-%m-%Y')"
fi
path=$path/$(date '+%d-%m-%Y')

start=$(date '+%d-%m-%Y %H-%M-%S')

# craft the path for current scan
path="$path/$(date '+%H-%M-%S')"
mkdir $path

# if target is a subnet make host discovery and save result in hosts.txt
if [[ -n $(echo $target | grep '/') ]] || [[ -n $(echo $target | grep '-') ]]; then
	nmap -n -sn -PE -PP -PS21,22,23,25,80,113,443,31339 -PA80,113,443,10042 -T4 --source-port 53 $1 | grep report | cut -d ' ' -f5 > $path/live-hosts.txt
else
	echo $1>$path/live-hosts.txt
fi

# iterate through hosts.txt and make a port scan for every host
while read ip; do
	localPath=$path/$ip
	mkdir $localPath

	echo "[unicornscan] TCP ports scanning($ip)"
	unicornscan -mT -l $localPath/${ip}-tcp-ports.txt ${ip}

	echo "[unicornscan] UDP ports scanning($ip)"
	unicornscan -mU -l $localPath/${ip}-udp-ports.txt ${ip}
	
	tcpPorts=$(cat $localPath/${ip}-tcp-ports.txt | grep open | cut -d"[" -f2 | cut -d"]" -f1 | sed 's/ //g' | tr '\n' ',' | sed 's/.$//')
	udpPorts=$(cat $localPath/${ip}-udp-ports.txt | grep open | cut -d"[" -f2 | cut -d"]" -f1 | sed 's/ //g' | tr '\n' ',' | sed 's/.$//')

	echo "[unicornscan] TCP open ports found: $tcpPorts"
	echo "[unicornscan] UDP open ports found: $udpPorts" 

	if [ -z $tcpPorts ] && [ -z $udpPorts ]; then
		echo "[NMAP] $nmapParam($ip)"
		nmap $nmapParam -oX $localPath/${ip}.xml $ip
	elif [ -n $tcpPorts ] && [ -z $udpPorts ]; then
		echo "[NMAP] $nmapParam -p $tcpPorts($ip)"
		nmap $nmapParam -p $tcpPorts -oX $localPath/${ip}.xml $ip
	elif [ -n $udpPorts ] && [ -z $tcpPorts ]; then
		echo "[NMAP] $nmapParam -p $udpPorts($ip)"
		nmap $nmapParam -p $udpPorts -oX $localPath/${ip}.xml $ip
	else
		echo "[NMAP] $nmapParam -p T:$tcpPorts,U:$udpPorts($ip)"
		nmap $nmapParam -p "T:$tcpPorts,U:$udpPorts" -oX $localPath/${ip}.xml $ip
	fi
done < $path/live-hosts.txt

end=$(date '+%d-%m-%Y %H:%M:%S')
echo "START: $start"
echo "END: $end"