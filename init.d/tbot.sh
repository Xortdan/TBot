#!/bin/sh
### BEGIN INIT INFO
# Provides: ts3server
# Required-Start: $all
# Required-Stop: $all
# Default-Start: 2 3 4 5
# Default-Stop: 0 1 6
# Description: Teamspeak 3 Server
#
### END INIT INFO#!/bin/sh

su ts3 -c "/home/ts3/tbot/./starter.sh start"
su ts3 -c "/home/ts3/tbot/./starter.sh startc"
