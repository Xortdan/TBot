# xTrustBot
bot for server TeamSpeak 3

Configuration is located in include/config/config.php

For proper operation of the bot, set chmod 777 to all files.

If you want to run the bot automatically, place the file xtrustbot.sh from the init.d folder to /etc/init.d. In the file, change the location of the folder in which the bot is located
. Then type in the console "update-rc.d xtrustbot.sh defaults".


# How to run?
To start the bot enter "./starter.sh [command]".                                                                    
Commands:
- start
- stop
- restart

Optionally append 1 or 2 to perform the operation on the selected instance.

# CHANGELOGS
version 0.0.2
- improved optimization

# In the future I want add/change
- language selection
- new functions
