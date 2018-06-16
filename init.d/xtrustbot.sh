#!/bin/sh
### BEGIN INIT INFO
# Provides: ts3server
# Required-Start: $local_fs $network
# Required-Stop: $local_fs $network
# Default-Start: 2 3 4 5
# Default-Stop: 0 1 6
# Description: Teamspeak 3 Server
#
### END INIT INFO#!/bin/sh

case $1 in
start)
sleep 60
cd /home/ts3/xtrustbot #bot location
su -c "./starter.sh start"
;;
stop)
cd /home/ts3/xtrustbot
su -c "./starter.sh stop" #bot location
;;
esac
exit 0