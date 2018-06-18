#!/bin/bash
#Starter xTrustbota

function start
{
php ./include/cache/message.php
echo start >> ./include/logs/log.txt 
echo -n 'version: ' >> ./include/logs/log.txt 
php include/cache/versionecho.php  >> ./include/logs/log.txt 
echo -e '' >> ./include/logs/log.txt 
date +"%d-%m-%Y %T" >> ./include/logs/log.txt
count=0	
count2=0	
for (( i=1; $i < 3; i++ ))
do
if ! screen -list | grep -q "xTrustBot$i"; then
screen -AdmS xTrustBot$i php core$i.php
echo -e $i'\e[32m instance: turned on\e[0m'
((count++))
else
echo -e $i"\e[91m instance is already running!\e[0m"
((count2++))
fi
done
echo "Turned $count instance"
echo "Turned $count instance (works $count2 instances)" >> ./include/logs/log.txt
echo -e '-----------------------------' >> ./include/logs/log.txt


}

function start1
{

	if ! screen -list | grep -q "xTrustBot1"; then
		screen -AdmS xTrustBot1 php core1.php
		echo "start core1.php" >> ./include/logs/log.txt 
		echo -n 'version: ' >> ./include/logs/log.txt 
		php include/cache/versionecho.php  >> ./include/logs/log.txt 
		echo -e '\n' >> ./include/logs/log.txt 
		date +"%d-%m-%Y %T" >> ./include/logs/log.txt
		echo -e '-----------------------------' >> ./include/logs/log.txt
		php ./include/cache/message.php
		echo -e '\n\e[30;48;5;82mFirst bot instance has been successfully started!\e[0m'
	else
		echo -e '\n\e[30;48;5;1mFirst instance is already running!\e[0m'
	fi

}

function start2
{

	if ! screen -list | grep -q "xTrustBot2"; then
		screen -AdmS xTrustBot2 php core2.php
		echo "start core2.php" >> ./include/logs/log.txt 
		echo -n 'version: ' >> ./include/logs/log.txt 
		php include/cache/versionecho.php  >> ./include/logs/log.txt 
		echo -e '\n' >> ./include/logs/log.txt 
		date +"%d-%m-%Y %T" >> ./include/logs/log.txt
		echo -e '-----------------------------' >> ./include/logs/log.txt
		php ./include/cache/message.php
		echo -e '\n\e[30;48;5;82mSecond bot instance has been successfully started!\e[0m'
	else
		echo -e '\n\e[30;48;5;1mSecond instance is already running!\e[0m'
	fi

}

function stop
{
	if ! screen -list | grep -q "xTrustBot1"; then
	if ! screen -list | grep -q "xTrustBot2"; then
		echo -e '\n\e[30;48;5;1mBot is currently turned off!\e[0m'
	fi
	else
		screen -X -S xTrustBot1 quit
		screen -X -S xTrustBot2 quit
		echo stop >> ./include/logs/log.txt
		date +"%d-%m-%Y %T" >> ./include/logs/log.txt
		echo '-----------------------------' >> ./include/logs/log.txt
		echo -e '\n\e[30;48;5;82mBot has been successfully stopped!\e[0m'
	fi
}

function stop1
{
	if ! screen -list | grep -q "xTrustBot1"; then
		echo -e '\n\e[30;48;5;1mFirst instance is currently turned off!\e[0m'
	else
		screen -X -S xTrustBot1 quit
		echo "stopstart core1.php" >> ./include/logs/log.txt
		date +"%d-%m-%Y %T" >> ./include/logs/log.txt
		echo '-----------------------------' >> ./include/logs/log.txt
		echo -e '\n\e[30;48;5;82mFirst bot instance has been successfully stopped!\e[0m'
	fi
}

function stop2
{
	if ! screen -list | grep -q "xTrustBot2"; then
		echo -e '\n\e[30;48;5;1mSecond instance is currently turned off!\e[0m'
	else
		screen -X -S xTrustBot2 quit
		echo "stopstart core2.php" >> ./include/logs/log.txt
		date +"%d-%m-%Y %T" >> ./include/logs/log.txt
		echo '-----------------------------' >> ./include/logs/log.txt
		echo -e '\n\e[30;48;5;82mSecond bot instance has been successfully stopped!\e[0m'
	fi
}

function restart
{
	if ! screen -list | grep -q "xTrustBot1"; then
	if ! screen -list | grep -q "xTrustBot2"; then
		echo -e '\n\e[30;48;5;1mBot is currently turned off!\e[0m'
	fi
	else
	screen -X -S xTrustBot1 quit
	screen -X -S xTrustBot2 quit
	screen -AdmS xTrustBot1 php core1.php
	screen -AdmS xTrustBot2 php core2.php
	echo restart >> ./include/logs/log.txt
	date +"%d-%m-%Y %T" >> ./include/logs/log.txt
	echo '-----------------------------' >> ./include/logs/log.txt
	echo -e '\n\e[30;48;5;82mBot has been successfully reset!\e[0m'
	fi
}

function restart1
{
	if ! screen -list | grep -q "xTrustBot1"; then
	echo -e '\n\e[30;48;5;1mFirst instance is currently turned off!\e[0m'
	else
	screen -X -S xTrustBot1 quit
	screen -AdmS xTrustBot1 php core1.php
	echo restart >> ./include/logs/log.txt
	date +"%d-%m-%Y %T" >> ./include/logs/log.txt
	echo '-----------------------------' >> ./include/logs/log.txt
	echo -e '\n\e[30;48;5;82mFirst bot instance has been successfully reset!\e[0m'
	fi
}

function restart2
{
	if ! screen -list | grep -q "xTrustBot2"; then
	echo -e '\n\e[30;48;5;1mSecond instance is currently turned off!\e[0m'
	else
	screen -X -S xTrustBot2 quit
	screen -AdmS xTrustBot2 php core1.php
	echo restart >> ./include/logs/log.txt
	date +"%d-%m-%Y %T" >> ./include/logs/log.txt
	echo '-----------------------------' >> ./include/logs/log.txt
	echo -e '\n\e[30;48;5;82mSecond bot instance has been successfully reset!\e[0m'
	fi
}



case "$1" in
	"start")
		start
	;;
	"start1")
		start1
	;;
	"start2")
		start2
	;;
	"stop")
		stop
	;;
	"stop1")
		stop1
	;;
	"stop2")
		stop2
	;;
	"restart")
		restart
	;;
	"restart1")
		restart1
	;;
	"restart2")
		restart2
	;;

	*)
		echo -e 'Uzyj start | stop | restart'
	;;
esac
