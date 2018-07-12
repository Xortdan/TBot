# xTrustBot
bot for server TeamSpeak 3

Currently, the bot has 20 functions + help channel.

First instance
- day
- hour
- users online
- register
- record online
- afk
- poke groups
- ban list
- channels count
- visitors count
- average packetloss
- average ping
- uptime

Second instance
- group clients count
- get private channel
- check private channels
- server name 
- client status
- time channel
- imieniny (for polish users)
- month record
- youtube channel info
- welcome message
- poke on channel
- vpn detection
- advertisement
- bot info
- ddos detection

Help bot (thirded instance)
Command
- commands list
- poke admins
- group list
- add server groups
- del server groups
- infomation about client
- own commands

Configuration is located in include/config/config.php

For proper operation of the bot, set chmod 777 to all files (chmod -R 777 /xtrustbot).

If you want to run the bot automatically, place the file xtrustbot.sh from the init.d folder to /etc/init.d. In the file, change the location of the folder in which the bot is located
. Then type in the console "update-rc.d xtrustbot.sh defaults".


# How to run?
To start the bot enter "./starter.sh [command]".                                                                    
Commands:
- start
- stop
- restart

Optionally append 1 or 2 to perform the operation on the selected instance (for example: "./starter.sh start2").

# CHANGELOGS
version 0.0.2
- improved optimization

version 0.0.3
- improved optimization
- better config
- new options in the function of banlist and checkchannels

version 0.0.4
- the readability of the config has been improved
- some functions have been improved
- new function: time channel

version 0.0.5
- improved optimization - from now on, only the instance gets some data (including a list of users, a list of channels, groups), because in the past each function downloaded this data, which had negative impact on performance
- new function: imieniny (for polish users), month record, youtube channel info, welcome message
- in the clientstatus function, the steam status has been added
- help bot has been added, but it is not working properly yet

version 0.0.6
- new help bot - now the bot operates in private messages without delays, there is no limit of users using the bot

version 0.0.7
- translation has been added (except helpbot) - If you see any mistake in the translation send it to xortdan1998@gmail.com
- in the useronline function from now it is possible to enable a list of users in the description
- in the group clients count function, a list of users from this group has been added, along with their status
- in the clientstatus function steam status has been added (optional)
- new functions: average packetloss, average ping, uptime, poke on channel, vpn detection, advertisment, ddos detection and bot info (information about the status of the instance and the ram usage)
- improved boot file

# In the future I want add/change
- new functions
