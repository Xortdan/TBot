<?php
////////////////////////////////////////////
////////////////DO NOT CHANGE///////////////
////////////////////////////////////////////
global $config;
require_once("include/cache/version.php");
$config['bot']['loop']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 1, 'seconds' => 0);
$config['bot']['loop']['datazero']= '1970-01-01 00:00:00';
$config['bot']['loop']['enable'] = true;
$config[1]['server']['defaultchannel'] = 28;
$config[1]['server']['defaultgroup'] = 8;
////////////////////////////////////////////
/////////////FIRST INSTANCE/////////////////
////////////////////////////////////////////
$config[1]['enable'] = true; //instance enable

$config[1]['server']['ip'] = '127.0.0.1'; //server ip
$config[1]['server']['port'] = 9987; //server port
$config[1]['server']['queryport'] = 10011; //server query port
$config[1]['query']['login'] = 'serveradmin'; //server query name
$config[1]['query']['password'] = ''; //server query password
$config[1]['bot']['name'] = "#1"; //bot name
$config[1]['bot']['channel'] =  28; //bot default channel
$config[1]['bot']['speed'] = 1; //bot interval

$config[1]['functions'] = Array('day', 'hour','useronline' ,'register' ,'recordonline' ,'afk' ,'pgroup' ,'banlist' ,'channelscount' ,'visitors');

//1. Day
 $config['function']['day'] = Array(
	'enable' => false,
	'channel' => 992,  //channel
	'channelname' => "[DAY].[MONTH].[YEAR]",  //channel name, [DAY], [MONTH], [YEAR]
	'interval' => Array('days' => 1, 'hours' => 0, 'minutes' => 0, 'seconds' => 0),  //interval
	'datazero' => '1970-01-01 00:00:00',
 );

//2. Hour
$config['function']['hour'] = Array(
	'enable' => false,
	'channel' => 992,  //channel
	'channelname' => "[HOUR]:[MINUTES]",  //channel name, [HOUR],[MINUTES]
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5), //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
//3. User online
$config['function']['useronline'] = Array(	
	'enable' => true,
	'channel'=> 8,  //channel
	'channelname' => "[cspacer]● Online: [ONLINE]●",  //channel name
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5), //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
//4. Register
$config['function']['register'] = Array(
	'enable' => true,
	'allgroup' => Array(14,15,87),	//all groups	
	'channeldelgroup' => 1061,  //channel id where client can delete registeer group
	'info' => Array(
	 1 => Array(
	 'group' => 14,  //group id
	 'channel' => 90  //channel id
	 ),
	 2 => Array(
	 'group' => 15,
	 'channel' => 91,
	 ),
	 3 => Array(
	 'group' => 87,
	 'channel' => 528
	 )
	),
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1), //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
//5. Rekord online
$config['function']['recordonline'] = Array(
	'enable' => false,
	'channel' => 857,//channel
	'channelname' => "Rekord: [RECORD]",  //channel name
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5), //interval
	'datazero' => '1970-01-01 00:00:00'
);

//6. AFK
$config['function']['afk'] = Array(
	'enable' => false,
	'mode' => 1, //1 - move to channel; 2 - give rang
	'idlechannel' => 677, //idle channel, if mode = 1
	'afkgroup' => 89, //afk group, if mode = 2
	'idletime' => 30,  //time after which the client will be moved
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 2), //interval
	'datazero' => '1970-01-01 00:00:00'
);

//7. Poke group
$config['function']['pgroup'] = Array(
	'enable' => true,
	'info' => Array(
	1 => Array(
	'group' => 8, //group id
	'message' => "Pamiętaj aby zarejestrować się (rejestracja dostępna w strefie pomocy)."  //message
	)
	),
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 20, 'seconds' => 0), //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
//8. Ban list
$config['function']['banlist'] = Array(
	'enable' => false,
	'channel_name_enable' => true, //enable/disable channel name
	'channel_name' => "Bany ([COUNT])",  //channel name, if enable
	'channel' => 992,  //channel
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5), //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
//9. channels count
$config['function']['channelscount'] = Array(
	'enable' => false,
	'channel' => 992,  //channel
	'channelname' => "Razem [COUNT]",  //channel name
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5), //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
//10. Visitors 
$config['function']['visitors'] = Array(
	'enable' => false,
	'channel' => 992,  //channel
	'channelname' => "Razem [COUNT]",  //channel name
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5), //interval
	'datazero' => '1970-01-01 00:00:00'
);

/////////////////////////////////////////
/////////////SECOND INSTANCE/////////////
/////////////////////////////////////////
$config[2]['enable'] = true; //instance enable

$config[2]['server']['ip'] = '127.0.0.1'; //server ip
$config[2]['server']['port'] = 9987; //server port
$config[2]['server']['queryport'] = 10011; //server query port
$config[2]['query']['login'] = 'serveradmin'; //server query name
$config[2]['query']['password'] = ''; //server query password
$config[2]['bot']['name'] = "#2"; //bot name
$config[2]['bot']['channel'] =  28; //bot default channel
$config[2]['bot']['speed'] = 1; //bot interval

$config[2]['functions'] = Array('groupclientcount', 'privatechannel', 'checkchannels', 'servername', 'clientstatus', 'timechannel', 'imieniny', 'monthrecord', 'youtube','welcomemessage');

//11. Group client count
$config['function']['groupclientcount'] = Array(
	'enable' => false,
	'info' => Array(
			1 => Array  //channel
			(
			'channel' => 992,  //channel id
			'group' => 30,  //group id
			'channelname' => '[RANG]: [ONLINE] / [MAX]',  //channel name, [RANG] - rang name, [ONLINE] - clients online, [MAX] - server slots
			'channeldesctopic' => '[center][color=blue][size=20][b][RANG][/b][/size][/color][/center]\n',  //description topic
			'channeldescription' => '[size=15][b][NUMBER]. [NICK] [STATUS][/b][/size]\n' //description
			),
			2 => Array  
			(
			'channel' => 993,
			'group' => 6,  
			'channelname' => '[RANG]: [ONLINE] / [MAX]', 
			'channeldesctopic' => '[center][color=blue][size=20][b][RANG][/b][/size][/color][/center]\n',  
			'channeldescription' => '[size=15][b][NUMBER]. [NICK] [STATUS][/b][/size]\n'
			)
		
	),
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5),  //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
//12. Private channel
$config['function']['privatechannel'] = Array(
	'enable' => false,
	'clientonchannel' => 992, //get channel in this channel
	'needgroup' => Array(14,15),  //need group to get channel
	'channelzone' => 1058, //private channel zone
	'admingroup' => 5,  //admin group
	'subchannels' => 2, //subchannels count
	'channeltopic' => "#fre", //channel topic
	'messageafter' => "Pamiętaj o zmianie hasła",  //message after 
	'channelname' => "Kanał prywatny - [NICK]",  //channel name
	'subchannelname' => "Podkanał",  //subchannel name
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1),  //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
//13. Check channels
$config['function']['checkchannels'] = Array(
	'enable' => false,
	'channelzone' => 992,  //channel zone
	'channelzonename' => "Kanałów prywatnych: [COUNT]",  //channel zone name, [COUNT] - count private channels
	'channeltopic' => "#fre", //topic name in free channels
	'channelname' => "[NUMBER]. Kanał prywatny - wolny",  //channel name
	'intervaldelete' => 2, //days after which the channel will be deleted
	'setdate' => true, //set curent date if someone is on channel
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 3),  //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
//14. Server name 
$config['function']['servername'] = Array(
	'enable' => false,
	'channelname' => "xTrust.pl [ONLINE]/[MAX]",  //channel name
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1),  //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
//15. Client status
$config['function']['clientstatus'] = Array(
	'enable' => true,
	'aalgroup' => Array(6, 30),  //all client group id
	'steamstatus' => true,  //enable steam info
	'steamapi' => "A3F4695EEF3317F8EE14941692AA7BA6",  //steam api
	'info' => Array(
	1 => Array(
	'dbid' => 2, //user dbid 
	'channel' => 184,  //channel
	'steamid' => 76561198101162681),  //steamid64
	2 => Array(
	'dbid' => 7,
	'channel' => 190,
	'steamid' => 76561198257069727),
	3 => Array(
	'dbid' => 797,
	'channel' => 187,
	'steamid' => 76561198088102844),
	4 => Array(
	'dbid' => 636,
	'channel' => 188,
	'steamid' => 76561197963803454),
	5 => Array(
	'dbid' => 8,
	'channel' => 189,
	'steamid' => 76561198167928642),
	6 => Array(
	'dbid' => 12,
	'channel' => 186,
	'steamid' => 76561198345510948),
	
	),
	'channelname' => "[cspacer]◥◣━[RANG]┃[NICK]┃[STATUS]━◢◤",  //channel name, [RANG], [NICK], [STATUS]
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 15),  //interval
	'interval2' => Array('days' => 0, 'hours' => 0, 'minutes' => 2, 'seconds' => 0),  //interval user info in description
	'datazero' => '1970-01-01 00:00:00',
	'datazero2' => '1970-01-01 00:00:00'
);

//16. Time channel
$config['function']['timechannel'] = Array(
	'enable' => false,
	'info' => Array(
	1 => Array(
	'channel' => 992,
	'channelnameon' => "Działa",  //channel name on
	'channelnameoff' => "Nie działa",  //channel name off
	'timeon' => "9:54",
	'timeoff' => "19:51"
	),
	2 => Array(
	'channel' => 993,
	'channelnameon' => "Działa2", 
	'channelnameoff' => "Nie działa2",
	'timeon' => "8:00",
	'timeoff' => "9:53"
	)
	),
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1),  //interval
	'datazero' => '1970-01-01 00:00:00'
);

//17. Imieniny [for Polish users]
$config['function']['imieniny'] = Array(
	'enable' => false,
	'channel' => 992,  //channel
	'channelname' => "Imieniny: [NAME]",  //channel name
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1),  //interval
	'datazero' => '1970-01-01 00:00:00'
);

//18. Month record
$config['function']['monthrecord'] = Array(
	'enable' => true,
	'channel' => 857,//channel
	'channelname' => "[cspacer]● Rekord miesiąca: [RECORD] ●",  //channel name
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5), //interval
	'datazero' => '1970-01-01 00:00:00'
);

//19. Youtube
$config['function']['youtube'] = Array(
	'enable' => true,
	'youtubeapi' => "AIzaSyDovcc8n_eHnRuTwKItjJLaPkFwG-u7lWk",
	'channnelname' => "[cspacer]✯[NICK] - [SUBSCOUNT]✯",
	'info' => Array(
	1 => Array(
	'channelid' => 611,
	'youtubechannel' => "UCswiY-euT4t-0gq-_2dZwKA"
	)
	),
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5), //interval
	'datazero' => '1970-01-01 00:00:00'
);

//20. Welcome message
$config['function']['welcomemessage'] = Array(
	'enable' => false,
	'message' => "[b]Witaj na naszym serwerze![/b] Teraz jest [online]/[/max] osób! Życzymy miłych rozmów![b][u]Aby korzystać za serwera- zarejestruj się.[/u][b]●",  //channel name
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5), //interval
	'datazero' => '1970-01-01 00:00:00'
);

/////////////////////////////////////////
/////////////HELP CHANNEL/////////////
/////////////////////////////////////////
$config[3]['enable'] = false; //help bot enable

$config[3]['server']['ip'] = '127.0.0.1'; //server ip
$config[3]['server']['port'] = 9987; //server port
$config[3]['server']['queryport'] = 10011; //server query port
$config[3]['query']['login'] = 'serveradmin'; //server query name
$config[3]['query']['password'] = ''; //server query password
$config[3]['bot']['name'] = "LiveHelp"; //help bot name
$config[3]['bot']['channel'] =  28; //bot default channel
$config[3]['bot']['speed'] = 0; //bot interval

$config[3]['functions'] = Array('helpchannel');

//19. Help channel
$config['function']['helpchannel'] = Array(
	'channel' => 992,
	'channelname' => "→ Pomoc (czytaj opis) [STATUS]",
	'admingroup' => Array(6, 30),
	'commandlist' => "!komendy",
	'grouplist' => "!grupy",
	'adminpokemessage' => "[NICK] potrzebuje pomocy!",
	'needgroup' => Array(
	1 => Array(
	'groupid' => 14,
	'command' => "!m"
	),
	2 => Array(
	'groupid' => 15,
	'command' => "!k"
	)),
	'servergroup' => Array(19,20,21,22,23,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,88,83),
	'maxservergroup' => 6,
	'channeldesctopic' => "[center][size=15][b]Komendy[/b][/size][/center]",
	'channeldesc' => "[COMMAND]",
	'info' => Array(
	1 => Array(
	'command' => "!poziomy",
	'message' => "\n[b]	Spis poziomów:[/b]\n	1 poziom - 1 godzina 
	2 poziom - 2 godziny 
	3 poziom - 4 godziny 
	4 poziom - 8 godziny 
	5 poziom - 12 godziny 
	6 poziom - 18 godziny 
	7 poziom - 24 godziny (1 dzień) 
	8 poziom - 48 godziny (2 dni) 
	9 poziom - 72 godziny (3 dni) 
	10 poziom - 120 godziny (5 dni) 
	11 poziom - 168 godziny (7 dni) 
	12 poziom - 216 godziny (9 dni) 
	13 poziom - 264 godziny (11 dni) 
	14 poziom - 312 godziny (13 dni) 
	15 poziom - 360 godziny (15 dni) 
	16 poziom - 432 godziny (18 dni) 
	17 poziom - 504 godziny (21 dni) 
	18 poziom - 576 godziny (24 dni) 
	19 poziom - 648 godziny (27 dni) 
	20 poziom - 720 godziny (30 dni) 
	21 poziom - 792 godziny (33 dni) 
	22 poziom - 864 godziny (36 dni) 
	23 poziom - 936 godziny (39 dni) 
	24 poziom - 1008 godziny (42 dni) 
	25 poziom - 1080 godziny (45 dni) 
	26 poziom - 1200 godziny (50 dni) 
	27 poziom - 1320 godziny (55 dni) 
	28 poziom - 1440 godziny (60 dni) 
	29 poziom - 1800 godziny (75 dni) 
	30 poziom - 2160 godziny (90 dni)",
	'desc' => "lista poziomów"
	),
	2 => Array(
	'command' => "!vip",
	'message' => "[b]Aby kupić rangę lub kanał VIP, udaj się na xtrust.pl[/b]",
	'desc' => "informacje o VIP"
	),
	),
	'datazero' => '1970-01-01 00:00:00',
	'datazeroadmin' => '1970-01-01 00:00:00'
);
	?>