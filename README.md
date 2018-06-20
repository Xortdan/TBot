# xTrustBot
bot for server TeamSpeak 3

Currently, the bot has 16 functions.

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

# In the future I want add/change
- language selection
- new functions
