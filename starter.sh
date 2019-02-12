#!/bin/bash
#Starter tBot

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
for (( i=1; $i < 6; i++ ))
do
if ! screen -list | grep -q "tBot$i"; then
screen -AdmS tBot$i php core$i.php
echo -e $i'\e[32m instance: turned on\e[0m'
((count++))
else
echo -e $i"\e[91m instance is already running!\e[0m"
((count2++))
fi
done
echo "Turned $count instance"
echo "Turned $count instance" >> ./include/logs/log.txt
echo -e '-----------------------------' >> ./include/logs/log.txt


}

function start1
{

	if ! screen -list | grep -q "tBot1"; then
		screen -AdmS tBot1 php core1.php
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

	if ! screen -list | grep -q "tBot2"; then
		screen -AdmS tBot2 php core2.php
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

	if ! screen -list | grep -q "tBot3"; then
		screen -AdmS tBot3 php core3.php
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

function start4
{

	if ! screen -list | grep -q "tBot4"; then
		screen -AdmS tBot4 php core4.php
		echo "start core4.php" >> ./include/logs/log.txt 
		echo -n 'version: ' >> ./include/logs/log.txt 
		php include/cache/versionecho.php  >> ./include/logs/log.txt 
		echo -e '\n' >> ./include/logs/log.txt 
		date +"%d-%m-%Y %T" >> ./include/logs/log.txt
		echo -e '-----------------------------' >> ./include/logs/log.txt
		php ./include/cache/message.php
		echo -e '\n\e[30;48;5;82mFourth bot instance has been successfully started!\e[0m'
	else
		echo -e '\n\e[30;48;5;1mFourth instance is already running!\e[0m'
	fi

}

function start5
{

	if ! screen -list | grep -q "tBot5"; then
		screen -AdmS tBot5 php core5.php
		echo "start core5.php" >> ./include/logs/log.txt 
		echo -n 'version: ' >> ./include/logs/log.txt 
		php include/cache/versionecho.php  >> ./include/logs/log.txt 
		echo -e '\n' >> ./include/logs/log.txt 
		date +"%d-%m-%Y %T" >> ./include/logs/log.txt
		echo -e '-----------------------------' >> ./include/logs/log.txt
		php ./include/cache/message.php
		echo -e '\n\e[30;48;5;82mFifth bot instance has been successfully started!\e[0m'
	else
		echo -e '\n\e[30;48;5;1mFifth instance is already running!\e[0m'
	fi

}

function startc
{

	if ! screen -list | grep -q "tBotC"; then
		screen -AdmS tBotC php control.php
		echo "start control.php" >> ./include/logs/log.txt 
		echo -n 'version: ' >> ./include/logs/log.txt 
		php include/cache/versionecho.php  >> ./include/logs/log.txt 
		echo -e '\n' >> ./include/logs/log.txt 
		date +"%d-%m-%Y %T" >> ./include/logs/log.txt
		echo -e '-----------------------------' >> ./include/logs/log.txt
		php ./include/cache/message.php
		echo -e '\n\e[30;48;5;82mControl instance has been successfully started!\e[0m'
	else
		echo -e '\n\e[30;48;5;1mControl instance is already running!\e[0m'
	fi

}

function stop
{
	echo stop >> ./include/logs/log.txt
	date +"%d-%m-%Y %T" >> ./include/logs/log.txt
	if ! screen -list | grep -q "tBot1"; then
	echo -e '\n\e[30;48;5;1mFirst instance is currently turned off!\e[0m'
	else
		screen -X -S tBot1 quit
		echo -e '\n\e[30;48;5;82mFirst instance has been successfully stopped!\e[0m'
		echo 'First instance stopped' >> ./include/logs/log.txt
	fi
	if ! screen -list | grep -q "tBot2"; then
	echo -e '\n\e[30;48;5;1mSecond instance is currently turned off!\e[0m'
	else
		screen -X -S tBot2 quit
		echo -e '\n\e[30;48;5;82mSecond instance has been successfully stopped!\e[0m'
		echo 'Second instance stopped' >> ./include/logs/log.txt
	fi
	if ! screen -list | grep -q "tBot3"; then
	echo -e '\n\e[30;48;5;1mHelp bot is currently turned off!\e[0m'
	else
		screen -X -S tBot3 quit
		echo -e '\n\e[30;48;5;82mHelp bot has been successfully stopped!\e[0m'
		echo 'Help bot stopped' >> ./include/logs/log.txt
	fi
	if ! screen -list | grep -q "tBot4"; then
	echo -e '\n\e[30;48;5;1mFourth instance is currently turned off!\e[0m'
	else
		screen -X -S tBot4 quit
		echo -e '\n\e[30;48;5;82mFourth instance has been successfully stopped!\e[0m'
		echo 'Fourth instance stopped' >> ./include/logs/log.txt
	fi
	if ! screen -list | grep -q "tBot5"; then
	echo -e '\n\e[30;48;5;1mFifth instance is currently turned off!\e[0m'
	else
		screen -X -S tBot5 quit
		echo -e '\n\e[30;48;5;82mFifth instance has been successfully stopped!\e[0m'
		echo 'Fifth instance stopped' >> ./include/logs/log.txt
	fi

			echo '-----------------------------' >> ./include/logs/log.txt

}

function stop1
{
	if ! screen -list | grep -q "tBot1"; then
		echo -e '\n\e[30;48;5;1mFirst instance is currently turned off!\e[0m'
	else
		screen -X -S tBot1 quit
		echo "stop core1.php" >> ./include/logs/log.txt
		date +"%d-%m-%Y %T" >> ./include/logs/log.txt
		echo '-----------------------------' >> ./include/logs/log.txt
		echo -e '\n\e[30;48;5;82mFirst bot instance has been successfully stopped!\e[0m'
	fi
}

function stop2
{
	if ! screen -list | grep -q "tBot2"; then
		echo -e '\n\e[30;48;5;1mSecond instance is currently turned off!\e[0m'
	else
		screen -X -S tBot2 quit
		echo "stop core2.php" >> ./include/logs/log.txt
		date +"%d-%m-%Y %T" >> ./include/logs/log.txt
		echo '-----------------------------' >> ./include/logs/log.txt
		echo -e '\n\e[30;48;5;82mSecond bot instance has been successfully stopped!\e[0m'
	fi
}

function stop3
{
	if ! screen -list | grep -q "tBot3"; then
		echo -e '\n\e[30;48;5;1mHelp bot is currently turned off!\e[0m'
	else
		screen -X -S tBot3 quit
		echo "stop core3.php" >> ./include/logs/log.txt
		date +"%d-%m-%Y %T" >> ./include/logs/log.txt
		echo '-----------------------------' >> ./include/logs/log.txt
		echo -e '\n\e[30;48;5;82mHelp bot has been successfully stopped!\e[0m'
	fi
}

function stop4
{
	if ! screen -list | grep -q "tBot4"; then
		echo -e '\n\e[30;48;5;1mFourth instance is currently turned off!\e[0m'
	else
		screen -X -S tBot4 quit
		echo "stop core4.php" >> ./include/logs/log.txt
		date +"%d-%m-%Y %T" >> ./include/logs/log.txt
		echo '-----------------------------' >> ./include/logs/log.txt
		echo -e '\n\e[30;48;5;82mFourth bot instance has been successfully stopped!\e[0m'
	fi
}

function stop5
{
	if ! screen -list | grep -q "tBot5"; then
		echo -e '\n\e[30;48;5;1mFifth instance is currently turned off!\e[0m'
	else
		screen -X -S tBot5 quit
		echo "stop core1.php" >> ./include/logs/log.txt
		date +"%d-%m-%Y %T" >> ./include/logs/log.txt
		echo '-----------------------------' >> ./include/logs/log.txt
		echo -e '\n\e[30;48;5;82mFifth bot instance has been successfully stopped!\e[0m'
	fi
}

function stopc
{
	if ! screen -list | grep -q "tBotC"; then
		echo -e '\n\e[30;48;5;1mControl instance is currently turned off!\e[0m'
	else
		screen -X -S tBotC quit
		echo "stop control.php" >> ./include/logs/log.txt
		date +"%d-%m-%Y %T" >> ./include/logs/log.txt
		echo '-----------------------------' >> ./include/logs/log.txt
		echo -e '\n\e[30;48;5;82mControl instance has been successfully stopped!\e[0m'
	fi
}

function restart
{
	echo restart >> ./include/logs/log.txt
	date +"%d-%m-%Y %T" >> ./include/logs/log.txt
	if ! screen -list | grep -q "tBot1"; then
		echo -e '\n\e[30;48;5;1mFirst instance is currently turned off!\e[0m'
		screen -AdmS tBot1 php core1.php
		echo -e '\n\e[30;48;5;82mFirst bot instance has been successfully started!\e[0m'
		echo "start core1.php" >> ./include/logs/log.txt 
	else
		screen -X -S tBot1 quit
		screen -AdmS tBot1 php core1.php
		echo -e '\n\e[30;48;5;82mFirst has been successfully reset!\e[0m'
		echo 'First instance restarted' >> ./include/logs/log.txt
	fi
	if ! screen -list | grep -q "tBot2"; then
		echo -e '\n\e[30;48;5;1mSecond instance is currently turned off!\e[0m'
		screen -AdmS tBot2 php core2.php
		echo -e '\n\e[30;48;5;82mSecond bot instance has been successfully started!\e[0m'
		echo "start core2.php" >> ./include/logs/log.txt 
	else
		screen -X -S tBot2 quit
		screen -AdmS tBot2 php core2.php
		echo -e '\n\e[30;48;5;82mSecond instance has been successfully reset!\e[0m'
		echo 'Second instance restarted' >> ./include/logs/log.txt
	fi
	if ! screen -list | grep -q "tBot3"; then
		echo -e '\n\e[30;48;5;1mHelp bot is currently turned off!\e[0m'
		screen -AdmS tBot3 php core3.php
		echo -e '\n\e[30;48;5;82mHelp bot has been successfully started!\e[0m'
		echo "start core3.php" >> ./include/logs/log.txt 
	else
		screen -X -S tBot3 quit
		screen -AdmS tBot3 php core3.php
		echo -e '\n\e[30;48;5;82mHelp bot has been successfully reset!\e[0m'
		echo 'Help bot restarted' >> ./include/logs/log.txt
	fi
	if ! screen -list | grep -q "tBot4"; then
		echo -e '\n\e[30;48;5;1mFourth instance instance is currently turned off!\e[0m'
		screen -AdmS tBot4 php core4.php
		echo -e '\n\e[30;48;5;82mFourth instance bot instance has been successfully started!\e[0m'
		echo "start core4.php" >> ./include/logs/log.txt 
	else
		screen -X -S tBot4 quit
		screen -AdmS tBot4 php core4.php
		echo -e '\n\e[30;48;5;82mFourth instance has been successfully reset!\e[0m'
		echo 'Fourth instance instance restarted' >> ./include/logs/log.txt
	fi
	if ! screen -list | grep -q "tBot5"; then
		echo -e '\n\e[30;48;5;1mFourth instance instance is currently turned off!\e[0m'
		screen -AdmS tBot5 php core5.php
		echo -e '\n\e[30;48;5;82mFourth instance bot instance has been successfully started!\e[0m'
		echo "start core5.php" >> ./include/logs/log.txt 
	else
		screen -X -S tBot5 quit
		screen -AdmS tBot5 php core5.php
		echo -e '\n\e[30;48;5;82mFifth instance has been successfully reset!\e[0m'
		echo 'Fifth instance instance restarted' >> ./include/logs/log.txt
	fi
	

			echo '-----------------------------' >> ./include/logs/log.txt

}

function restart1
{
	if ! screen -list | grep -q "tBot1"; then
	echo -e '\n\e[30;48;5;1mFirst instance is currently turned off!\e[0m'
	else
	screen -X -S tBot1 quit
	screen -AdmS tBot1 php core1.php
	echo restart >> ./include/logs/log.txt
	date +"%d-%m-%Y %T" >> ./include/logs/log.txt
	echo '-----------------------------' >> ./include/logs/log.txt
	echo -e '\n\e[30;48;5;82mFirst bot instance has been successfully reset!\e[0m'
	fi
}

function restart2
{
	if ! screen -list | grep -q "tBot2"; then
	echo -e '\n\e[30;48;5;1mSecond instance is currently turned off!\e[0m'
	else
	screen -X -S tBot2 quit
	screen -AdmS tBot2 php core2.php
	echo restart >> ./include/logs/log.txt
	date +"%d-%m-%Y %T" >> ./include/logs/log.txt
	echo '-----------------------------' >> ./include/logs/log.txt
	echo -e '\n\e[30;48;5;82mSecond bot instance has been successfully reset!\e[0m'
	fi
}

function restart3
{
	if ! screen -list | grep -q "tBot3"; then
	echo -e '\n\e[30;48;5;1mHelp bot is currently turned off!\e[0m'
	else
	screen -X -S tBot3 quit
	screen -AdmS tBot3 php core3.php
	echo restart >> ./include/logs/log.txt
	date +"%d-%m-%Y %T" >> ./include/logs/log.txt
	echo '-----------------------------' >> ./include/logs/log.txt
	echo -e '\n\e[30;48;5;82mHelp bot has been successfully reset!\e[0m'
	fi
}

function restart4
{
	if ! screen -list | grep -q "tBot4"; then
	echo -e '\n\e[30;48;5;1mSecond instance is currently turned off!\e[0m'
	else
	screen -X -S tBot4 quit
	screen -AdmS tBot4 php core4.php
	echo restart >> ./include/logs/log.txt
	date +"%d-%m-%Y %T" >> ./include/logs/log.txt
	echo '-----------------------------' >> ./include/logs/log.txt
	echo -e '\n\e[30;48;5;82mFourth bot instance has been successfully reset!\e[0m'
	fi
}

function restart5
{
	if ! screen -list | grep -q "tBot5"; then
	echo -e '\n\e[30;48;5;1mFifth instance is currently turned off!\e[0m'
	else
	screen -X -S tBot5 quit
	screen -AdmS tBot5 php core5.php
	echo restart >> ./include/logs/log.txt
	date +"%d-%m-%Y %T" >> ./include/logs/log.txt
	echo '-----------------------------' >> ./include/logs/log.txt
	echo -e '\n\e[30;48;5;82mFifth bot instance has been successfully reset!\e[0m'
	fi
}

function restartc
{
	if ! screen -list | grep -q "tBotC"; then
	echo -e '\n\e[30;48;5;1mControl instance is currently turned off!\e[0m'
	else
	screen -X -S tBotC quit
	screen -AdmS tBotC php control.php
	echo restart >> ./include/logs/log.txt
	date +"%d-%m-%Y %T" >> ./include/logs/log.txt
	echo '-----------------------------' >> ./include/logs/log.txt
	echo -e '\n\e[30;48;5;82mControl instance has been successfully reset!\e[0m'
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
	"start3")
		start3
	;;
	"start4")
		start4
	;;
	"start5")
		start5
	;;
	"startc")
		startc
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
	"stop4")
		stop4
	;;
	"stop5")
		stop5
	;;
	"stopc")
		stopc
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
	"restart4")
		restart4
	;;
	"restart5")
		restart5
	;;
	"restartc")
		restartc
	;;
	*)
		echo -e 'Uzyj start | stop | restart'
	;;
esac
