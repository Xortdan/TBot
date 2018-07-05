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
for (( i=1; $i < 4; i++ ))
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

function start3
{

	if ! screen -list | grep -q "xTrustBot3"; then
		screen -AdmS xTrustBot3 php core3.php
		echo "start core3.php" >> ./include/logs/log.txt 
		echo -n 'version: ' >> ./include/logs/log.txt 
		php include/cache/versionecho.php  >> ./include/logs/log.txt 
		echo -e '\n' >> ./include/logs/log.txt 
		date +"%d-%m-%Y %T" >> ./include/logs/log.txt
		echo -e '-----------------------------' >> ./include/logs/log.txt
		php ./include/cache/message.php
		echo -e '\n\e[30;48;5;82mHelp bot has been successfully started!\e[0m'
	else
		echo -e '\n\e[30;48;5;1mHelp bot is already running!\e[0m'
	fi

}

function stop
{
	echo stop >> ./include/logs/log.txt
	date +"%d-%m-%Y %T" >> ./include/logs/log.txt
	if ! screen -list | grep -q "xTrustBot1"; then
	echo -e '\n\e[30;48;5;1mFirst instance is currently turned off!\e[0m'
	else
		screen -X -S xTrustBot1 quit
		echo -e '\n\e[30;48;5;82mFirst instance has been successfully stopped!\e[0m'
		echo 'First instance stopped' >> ./include/logs/log.txt
	fi
	if ! screen -list | grep -q "xTrustBot2"; then
	echo -e '\n\e[30;48;5;1mSecond instance is currently turned off!\e[0m'
	else
		screen -X -S xTrustBot2 quit
		echo -e '\n\e[30;48;5;82mSecond instance has been successfully stopped!\e[0m'
		echo 'Second instance stopped' >> ./include/logs/log.txt
	fi
	if ! screen -list | grep -q "xTrustBot3"; then
	echo -e '\n\e[30;48;5;1mHelp bot is currently turned off!\e[0m'
	else
		screen -X -S xTrustBot3 quit
		echo -e '\n\e[30;48;5;82mHelp bot has been successfully stopped!\e[0m'
		echo 'Help bot stopped' >> ./include/logs/log.txt
	fi

			echo '-----------------------------' >> ./include/logs/log.txt

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

function stop3
{
	if ! screen -list | grep -q "xTrustBot3"; then
		echo -e '\n\e[30;48;5;1mHelp bot is currently turned off!\e[0m'
	else
		screen -X -S xTrustBot3 quit
		echo "stopstart core3.php" >> ./include/logs/log.txt
		date +"%d-%m-%Y %T" >> ./include/logs/log.txt
		echo '-----------------------------' >> ./include/logs/log.txt
		echo -e '\n\e[30;48;5;82mHelp bot has been successfully stopped!\e[0m'
	fi
}

function restart
{
	echo restart >> ./include/logs/log.txt
	date +"%d-%m-%Y %T" >> ./include/logs/log.txt
	if ! screen -list | grep -q "xTrustBot1"; then
		echo -e '\n\e[30;48;5;1mFirst instance is currently turned off!\e[0m'
		screen -AdmS xTrustBot1 php core1.php
		echo -e '\n\e[30;48;5;82mFirst bot instance has been successfully started!\e[0m'
		echo "start core1.php" >> ./include/logs/log.txt 
	else
		screen -X -S xTrustBot1 quit
		screen -AdmS xTrustBot1 php core1.php
		echo -e '\n\e[30;48;5;82mFirst has been successfully reset!\e[0m'
		echo 'First instance restarted' >> ./include/logs/log.txt
	fi
	if ! screen -list | grep -q "xTrustBot2"; then
		echo -e '\n\e[30;48;5;1mSecond instance is currently turned off!\e[0m'
		screen -AdmS xTrustBot2 php core2.php
		echo -e '\n\e[30;48;5;82mSecond bot instance has been successfully started!\e[0m'
		echo "start core2.php" >> ./include/logs/log.txt 
	else
		screen -X -S xTrustBot2 quit
		screen -AdmS xTrustBot2 php core2.php
		echo -e '\n\e[30;48;5;82mSecond instance has been successfully reset!\e[0m'
		echo 'Second instance restarted' >> ./include/logs/log.txt
	fi
	if ! screen -list | grep -q "xTrustBot3"; then
		echo -e '\n\e[30;48;5;1mHelp bot is currently turned off!\e[0m'
		screen -AdmS xTrustBot3 php core3.php
		echo -e '\n\e[30;48;5;82mHelp bot has been successfully started!\e[0m'
		echo "start core3.php" >> ./include/logs/log.txt 
	else
		screen -X -S xTrustBot3 quit
		screen -AdmS xTrustBot3 php core3.php
		echo -e '\n\e[30;48;5;82mHelp bot has been successfully reset!\e[0m'
		echo 'Help bot restarted' >> ./include/logs/log.txt
	fi

			echo '-----------------------------' >> ./include/logs/log.txt

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
	screen -AdmS xTrustBot2 php core2.php
	echo restart >> ./include/logs/log.txt
	date +"%d-%m-%Y %T" >> ./include/logs/log.txt
	echo '-----------------------------' >> ./include/logs/log.txt
	echo -e '\n\e[30;48;5;82mSecond bot instance has been successfully reset!\e[0m'
	fi
}

function restart3
{
	if ! screen -list | grep -q "xTrustBot3"; then
	echo -e '\n\e[30;48;5;1mHelp bot is currently turned off!\e[0m'
	else
	screen -X -S xTrustBot3 quit
	screen -AdmS xTrustBot3 php core3.php
	echo restart >> ./include/logs/log.txt
	date +"%d-%m-%Y %T" >> ./include/logs/log.txt
	echo '-----------------------------' >> ./include/logs/log.txt
	echo -e '\n\e[30;48;5;82mHelp bot has been successfully reset!\e[0m'
	fi
}

function stopshell
{
	echo "stop shell" >> ./include/logs/log.txt
	date +"%d-%m-%Y %T" >> ./include/logs/log.txt
	if ! screen -list | grep -q "xTrustBotShell"; then
	echo -e '\n\e[30;48;5;1mShell is currently turned off!\e[0m'
	else
		screen -X -S xTrustBotShell quit
		echo -e '\n\e[30;48;5;82mShell has been successfully stopped!\e[0m'
		echo 'Shell stopped' >> ./include/logs/log.txt
	fi
			echo '-----------------------------' >> ./include/logs/log.txt

}

function startshell
{
	echo "start shell" >> ./include/logs/log.txt
	date +"%d-%m-%Y %T" >> ./include/logs/log.txt
	if  screen -list | grep -q "xTrustBotShell"; then
	echo -e '\n\e[30;48;5;1mShell is currently turned off!\e[0m'
	else
		screen -AdmS xTrustBotShell php shell.php
		echo -e '\n\e[30;48;5;82mShell has been successfully started!\e[0m'
		echo 'Shell stopped' >> ./include/logs/log.txt
	fi
			echo '-----------------------------' >> ./include/logs/log.txt

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
	"start3")
		start3
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
	"stop3")
		stop3
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
	"restart3")
		restart3
	;;
	"startshell")
		startshell
	;;
	"stopshell")
		stopshell
	;;
	*)
		echo -e 'Uzyj start | stop | restart'
	;;
esac
