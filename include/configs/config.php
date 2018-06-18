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
	'enable' => false,
	'channel'=> 993,  //channel
	'channelname' => "Jest [ONLINE] [USER]",  //channel name
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 10), //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
//4. Register
$config['function']['register'] = Array(
	'enable' => false,
	'defaultgroup' => 8,  //default group
	'allchannel' => Array(992,993),  //all channels
	'allgroup' => Array(14,15),	//all groups	
	'info' => Array(
	//		channel => group
			992 => 14,
			993 => 15
	),
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 0), //interval
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
	'enable' => false,
	'allgroup' => Array(8),  //all group
	'message' => Array(   
	// group => message
	8 => "Pamiętaj aby zarejestrować się (rejestracja dostępna w strefie pomocy)."
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

$config[2]['functions'] = Array('groupclientcount', 'privatechannel', 'checkchannels', 'servername', 'clientstatus');

//11. Group client count
$config['function']['groupclientcount'] = Array(
	'enable' => false,
	'allchannel' => Array(992, 993),  //all channel
	'info' => Array(
			992 => Array  //channel
			(
			'group' => 30,  //group
			'channelname' => '[RANG]: [ONLINE] / [MAX]',  //channel name, [RANG] - rang name, [ONLINE] - clients online, [MAX] - server slots
			'channeldesctopic' => '[center][color=blue][size=20][b][RANG][/b][/size][/color][/center]\n',  //description topic
			'channeldescription' => '[size=15][b][NUMBER]. [NICK] [STATUS][/b][/size]\n' //description
			),
			993 => Array  
			(
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
	'clientonchannel' => 19, //get channel in this channel
	'needgroup' => Array(14,15),  //need group to get channel
	'channelzone' => 857, //private channel zone
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
	'enable' => false,
	'aalgroup' => Array(27, 30),  //all group
	'info' => Array(
	1 => Array(
	'dbid' => 2, //user dbid 
	'channel' => 993), //channel
	2 => Array(
	'dbid' => 11,
	'channel' => 992)
	),
	'channelname' => "[RANG] [NICK] [STATUS]",  //channel name, [RANG], [NICK], [STATUS]
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1),  //interval
	'datazero' => '1970-01-01 00:00:00'
);
	?>