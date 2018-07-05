# xTrustBot
bot for server TeamSpeak 3

Currently, the bot has 20 functions.

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
# In the future I want add/change
- language selection
- new functions
