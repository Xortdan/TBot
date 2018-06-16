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
$config[1]['query']['login'] = 'serveradmin'; //server query name
$config[1]['query']['password'] = ''; //server query password
$config[1]['server']['queryport'] = 10011; //server query port
$config[1]['bot']['name'] = "#1"; //bot name
$config[1]['bot']['channel'] =  28; //bot default channel
$config[1]['bot']['speed'] = 1; //bot interval

$config[1]['functions'] = Array('day', 'hour','useronline' ,'register' ,'recordonline' ,'afk' ,'pgroup' ,'banlist' ,'channelscount' ,'visitors');

//1. Day
	$config['function']['day']['enable'] = false;
	$config['function']['day']['channel']= 992;  //channel
	$config['function']['day']['channelname'] = "[DAY].[MONTH].[YEAR]";  //channel name, [DAY], [MONTH], [YEAR]
	$config['function']['day']['interval']=Array('days' => 1, 'hours' => 0, 'minutes' => 0, 'seconds' => 0);  //interval
	$config['function']['day']['datazero']= '1970-01-01 00:00:00';
	
//2. Hour
	$config['function']['hour']['enable'] = false;
	$config['function']['hour']['channel']= 992;  //channel
	$config['function']['hour']['channelname'] = "[HOUR]:[MINUTES]";  //channel name, [HOUR],[MINUTES]
	$config['function']['hour']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5); //interval
	$config['function']['hour']['datazero']= '1970-01-01 00:00:00';
	
//3. User online	
	$config['function']['useronline']['enable'] = false;
	$config['function']['useronline']['channel']= 992;  //channel
	$config['function']['useronline']['channelname'] = "Jest [ONLINE] [USER]";  //channel name
	$config['function']['useronline']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 10); //interval
	$config['function']['useronline']['datazero']= '1970-01-01 00:00:00';
	
//4. Register
	$config['function']['register']['enable'] = false;
	$config['function']['register']['defaultgroup']= 8;  //default group
	$config['function']['register']['allchannel']=Array(992,993);  //all channels
	$config['function']['register']['allgroup']=Array(14,15);	//all groups	
	$config['function']['register']['info'] =Array(
	//		channel => group
			992 => 14,
			993 => 15
	);
	$config['function']['register']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 0); //interval
	$config['function']['register']['datazero']= '1970-01-01 00:00:00';
	
//5. Rekord online
	$config['function']['recordonline']['enable'] = false;
	$config['function']['recordonline']['channel']= 857;//channel
	$config['function']['recordonline']['channelname'] = "Rekord: [RECORD]";  //channel name
	$config['function']['recordonline']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5); //interval
	$config['function']['recordonline']['datazero']= '1970-01-01 00:00:00';

//6. AFK
	$config['function']['afk']['enable'] = false;
	$config['function']['afk']['mode'] = 1; //1 - move to channel; 2 - give rang;
	$config['function']['afk']['idlechannel'] = 677; //idle channel, if mode = 1;
	$config['function']['afk']['afkgroup'] = 89; //afk group, if mode = 2;
	$config['function']['afk']['idletime'] = 30;  //time after which the client will be moved
	$config['function']['afk']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 2); //interval
	$config['function']['afk']['datazero']= '1970-01-01 00:00:00';

//7. Poke group
	$config['function']['pgroup']['enable'] = false;
	$config['function']['pgroup']['allgroup'] = Array(8);  //all group
	$config['function']['pgroup']['message'] =Array(   
	// group => message
	8 => "Pamiętaj aby zarejestrować się (rejestracja dostępna w strefie pomocy)."
	);
	$config['function']['pgroup']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 20, 'seconds' => 0); //interval
	$config['function']['pgroup']['datazero']= '1970-01-01 00:00:00';
	
//8. Ban list
	$config['function']['banlist']['enable'] = false;
	$config['function']['banlist']['channel'] = 992;  //channel
	$config['function']['banlist']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5); //interval
	$config['function']['banlist']['datazero']= '1970-01-01 00:00:00';
	
//9. channels count
	$config['function']['channelscount']['enable'] = false;
	$config['function']['channelscount']['channel'] = 992;  //channel
	$config['function']['channelscount']['channelname'] = "Razem [COUNT]";  //channel name
	$config['function']['channelscount']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5); //interval
	$config['function']['channelscount']['datazero']= '1970-01-01 00:00:00';
	
//10. Visitors 
	$config['function']['visitors']['enable'] = false;
	$config['function']['visitors']['channel'] = 992;  //channel
	$config['function']['visitors']['channelname'] = "Razem [COUNT]";  //channel name
	$config['function']['visitors']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5); //interval
	$config['function']['visitors']['datazero']= '1970-01-01 00:00:00';

/////////////////////////////////////////
/////////////SECOND INSTANCE/////////////
/////////////////////////////////////////
$config[2]['enable'] = true; //instance enable

$config[2]['server']['ip'] = '127.0.0.1'; //server ip
$config[2]['server']['port'] = 9987; //server port
$config[2]['query']['login'] = 'serveradmin'; //server query name
$config[2]['query']['password'] = ''; //server query password
$config[2]['server']['queryport'] = 10011; //server query port
$config[2]['bot']['name'] = "#2"; //bot name
$config[2]['bot']['channel'] =  28; //bot default channel
$config[2]['bot']['speed'] = 1; //bot interval

$config[2]['functions'] = Array('groupclientcount', 'privatechannel', 'checkchannels', 'servername', 'clientstatus');

//11. Group client count
	$config['function']['groupclientcount']['enable'] = false;
	$config['function']['groupclientcount']['allchannel']=Array(992, 993);  //all channel
	$config['function']['groupclientcount']['info'] =Array(
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
		
	);
	$config['function']['groupclientcount']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5);  //interval
	$config['function']['groupclientcount']['datazero']= '1970-01-01 00:00:00';
	
//12. Private channel
	$config['function']['privatechannel']['enable'] = false;
	$config['function']['privatechannel']['clientonchannel'] = 19; //get channel in this channel
	$config['function']['privatechannel']['needgroup'] = Array(14,15);  //need group to get channel
	$config['function']['privatechannel']['channelzone'] = 857; //private channel zone
	$config['function']['privatechannel']['admingroup'] = 5;  //admin group
	$config['function']['privatechannel']['subchannels'] = 2; //subchannels count
	$config['function']['privatechannel']['channeltopic'] = "#fre"; //channel topic
	$config['function']['privatechannel']['messageafter'] = "Pamiętaj o zmianie hasła";  //message after 
	$config['function']['privatechannel']['channelname'] = "Kanał prywatny - [NICK]";  //channel name
	$config['function']['privatechannel']['subchannelname'] = "Podkanał";  //subchannel name
	$config['function']['privatechannel']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1);  //interval
	$config['function']['privatechannel']['datazero']= '1970-01-01 00:00:00';
	
//13. Check channels
	$config['function']['checkchannels']['enable'] = false;
	$config['function']['checkchannels']['channelzone'] = 992;  //channel zone
	$config['function']['checkchannels']['channeltopic'] = "#fre"; //topic name in free channels
	$config['function']['checkchannels']['channelname'] = "[NUMBER]. Kanał prywatny - wolny";  //channel name
	$config['function']['checkchannels']['intervaldelete'] = 2; //days after which the channel will be deleted
	$config['function']['checkchannels']['setdate'] = true; //set curent date if someone is on channel
	$config['function']['checkchannels']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 3);  //interval
	$config['function']['checkchannels']['datazero']= '1970-01-01 00:00:00';
	
//14. Server name 
	$config['function']['servername']['enable'] = false;
	$config['function']['servername']['channelname'] = "xTrust.pl [ONLINE]/[MAX]";  //channel name
	$config['function']['servername']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1);  //interval
	$config['function']['servername']['datazero']= '1970-01-01 00:00:00';
	
//15. Client status
	$config['function']['clientstatus']['enable'] = false;
	$config['function']['clientstatus']['aalgroup'] = Array(27, 30);  //all group
	$config['function']['clientstatus']['info'] = Array(
	1 => Array(
	'dbid' => 2, //user dbid 
	'channel' => 993), //channel
	2 => Array(
	'dbid' => 11,
	'channel' => 992)
	);
	$config['function']['clientstatus']['channelname'] = "[RANG] [NICK] [STATUS]";  //channel name, [RANG], [NICK], [STATUS]
	$config['function']['clientstatus']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1);  //interval
	$config['function']['clientstatus']['datazero']= '1970-01-01 00:00:00';
	?>