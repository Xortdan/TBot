<?php
global $config;
require_once("include/cache/version.php");
$config['bot']['speed'] = 1;
$config['bot']['loop']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 1, 'seconds' => 0);
$config['bot']['loop']['datazero']= '1970-01-01 00:00:00';
$config['bot']['loop']['enable'] = true;
////////////////////////////////////////////
/////////////PIERWSZA INSTANCJA/////////////
////////////////////////////////////////////
$config[1]['enable'] = true;

$config[1]['server']['ip'] = '127.0.0.1';
$config[1]['server']['port'] = 9987;
$config[1]['query']['login'] = 'serveradmin';
$config[1]['query']['password'] = 'nUx7c3dv';
$config[1]['server']['queryport'] = 10011;
$config[1]['server']['defaultchannel'] = 28;
$config[1]['server']['defaultgroup'] = 8;
$config[1]['bot']['name'] = "xtrust BOT #1";
$config[1]['bot']['channel'] =  28;
$config[1]['bot']['speed'] = 1;

$config[1]['functions'] = Array('day', 'hour','useronline' ,'register' ,'recordonline' ,'afk' ,'pgroup' ,'banlist' ,'channelscount' ,'visitors');

//1. Dzień
	$config['function']['day']['enable'] = false;
	$config['function']['day']['channel']= 993;
	$config['function']['day']['channelname'] = "[DAY].[MONTH].[YEAR]";
	$config['function']['day']['interval']=Array('days' => 1, 'hours' => 0, 'minutes' => 0, 'seconds' => 0);
	$config['function']['day']['datazero']= '1970-01-01 00:00:00';
	
//2. Godzina
	$config['function']['hour']['enable'] = true;
	$config['function']['hour']['channel']= 992;
	$config['function']['hour']['channelname'] = "[HOUR]:[MINUTES]";
	$config['function']['hour']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5);
	$config['function']['hour']['datazero']= '1970-01-01 00:00:00';
	
//3. Osób online	
	$config['function']['useronline']['enable'] = false;
	$config['function']['useronline']['channel']= 857;
	$config['function']['useronline']['channelname'] = "Jest [ONLINE] [USER]";
	$config['function']['useronline']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 10);
	$config['function']['useronline']['datazero']= '1970-01-01 00:00:00';
	
//4. Rejestracja
	$config['function']['register']['enable'] = false;
	$config['function']['register']['defaultgroup']= 8;
	$config['function']['register']['channeldefault']= 675;
	$config['function']['register']['allchannel']=Array(676,677);
	$config['function']['register']['allgroup']=Array(14,15);		
	$config['function']['register']['info'] =Array(
	//		channel => group
			676 => 14,
			677 => 15
	);
	$config['function']['register']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 0);
	$config['function']['register']['datazero']= '1970-01-01 00:00:00';
	
//5. Rekord online
	$config['function']['recordonline']['enable'] = false;
	$config['function']['recordonline']['channel']= 857;
	$config['function']['recordonline']['channelname'] = "Rekord: [RECORD]";
	$config['function']['recordonline']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5);
	$config['function']['recordonline']['datazero']= '1970-01-01 00:00:00';

//6. AFK
	$config['function']['afk']['enable'] = false;
	$config['function']['afk']['mode'] = 1; //1 - move to channel; 2 - give rang;
	$config['function']['afk']['idlechannel'] = 677; //if mode=1;
	$config['function']['afk']['afkgroup'] = 89; //if mode=2;
	$config['function']['afk']['idletime'] = 30;
	$config['function']['afk']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 2);
	$config['function']['afk']['datazero']= '1970-01-01 00:00:00';

//7. Poke group
	$config['function']['pgroup']['enable'] = false;
	$config['function']['pgroup']['allgroup'] = Array(8);
	$config['function']['pgroup']['message'] =Array(   
	8 => "Pamiętaj aby zarejestrować się (rejestracja dostępna w strefie pomocy).");
	$config['function']['pgroup']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 20, 'seconds' => 0);
	$config['function']['pgroup']['datazero']= '1970-01-01 00:00:00';
	
//8. Ban list
	$config['function']['banlist']['enable'] = false;
	$config['function']['banlist']['channel'] = 857;  //channel
	$config['function']['banlist']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5);
	$config['function']['banlist']['datazero']= '1970-01-01 00:00:00';
	
//9. channels count
	$config['function']['channelscount']['enable'] = false;
	$config['function']['channelscount']['channel'] = 857;  //channel
	$config['function']['channelscount']['channelname'] = "Razem [COUNT]";  //channel name
	$config['function']['channelscount']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5);
	$config['function']['channelscount']['datazero']= '1970-01-01 00:00:00';
	
//10. visitors 
	$config['function']['visitors']['enable'] = false;
	$config['function']['visitors']['channel'] = 857;  //channel
	$config['function']['visitors']['channelname'] = "Razem [COUNT]";  //channel name
	$config['function']['visitors']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5);
	$config['function']['visitors']['datazero']= '1970-01-01 00:00:00';

/////////////////////////////////////////
/////////////DRUGA INSTANCJA/////////////
/////////////////////////////////////////
$config[2]['enable'] = true;

$config[2]['server']['ip'] = '127.0.0.1';
$config[2]['server']['port'] = 9987;
$config[2]['query']['login'] = 'serveradmin';
$config[2]['query']['password'] = 'nUx7c3dv';
$config[2]['server']['queryport'] = 10011;
$config[2]['server']['defaultchannel'] = 28;
$config[2]['server']['defaultgroup'] = 8;
$config[2]['bot']['name'] = "xtrust BOT #2";
$config[2]['bot']['channel'] =  28;
$config[2]['bot']['speed'] = 1;

$config[2]['functions'] = Array('groupcount', 'privatechannel', 'servername');




//11. groupcount
	$config['function']['groupcount']['enable'] = false;
	$config['function']['groupcount']['allchannel']=Array(857);  //all channel
	$config['function']['groupcount']['allgroup']=Array(30);  //all group
	$config['function']['groupcount']['info'] =Array(
			857 => Array  //channel
			(
			'group' => 6,  //group
			'channelname' => '[RANG]: [ONLINE] / [MAX]',  //channel name
			'channeldesctopic' => '[center][color=blue][size=20][b][RANG][/b][/size][/color][/center]\n',
			'channeldescription' => '[size=15][b][NUMBER]. [NICK] [STATUS][/b][/size]\n'
			)
		
	);
	
	$config['function']['groupcount']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5);
	$config['function']['groupcount']['datazero']= '1970-01-01 00:00:00';
	
//12. private channel
	$config['function']['privatechannel']['enable'] = false;
	$config['function']['privatechannel']['clientonchannel'] = 992; //get channel in this 
	$config['function']['privatechannel']['needgroup'] = Array(14,15);  //need group to get channel
	$config['function']['privatechannel']['admingroup'] = 5;  //admin gropu
	$config['function']['privatechannel']['channelzone'] = 859; //private channel zone
	$config['function']['privatechannel']['subchannels'] = 2; //subchannels
	$config['function']['privatechannel']['channeltopic'] = "#fre"; //subchannels topic
	$config['function']['privatechannel']['messageafter'] = "Pamiętaj o zmianie hasła";  //message after 
	$config['function']['privatechannel']['channelname'] = "Kanał prywatny - [NICK]";  //chanell name
	$config['function']['privatechannel']['subchannelname'] = "Podkanał";  //subchannel name
	$config['function']['privatechannel']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1);
	$config['function']['privatechannel']['datazero']= '1970-01-01 00:00:00';
	
//13. check channels
	$config['function']['checkchannels']['enable'] = false;
	$config['function']['checkchannels']['channelzone'] = 859;
	$config['function']['checkchannels']['channeltopic'] = "#fre";
	$config['function']['checkchannels']['channelname'] = "[NUMBER]. Kanał prywatny - wolny";
	$config['function']['checkchannels']['intervaldelete'] = 2;
	$config['function']['checkchannels']['setdate'] = true;
	$config['function']['checkchannels']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 3);
	$config['function']['checkchannels']['datazero']= '1970-01-01 00:00:00';
	
//14. server name 
	$config['function']['servername']['enable'] = false;
	$config['function']['servername']['channelname'] = "xTrust.pl [ONLINE]/[MAX]";  //channel name
	$config['function']['servername']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1);
	$config['function']['servername']['datazero']= '1970-01-01 00:00:00';
	?>