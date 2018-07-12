<?php 

function clientstatus()
{
	global $config;
	global $tsAdmin;
	global $groups;	
	global $footer;
	global $language;
	$loopdate3 = date('Y-m-d G:i:s');
	
	if(ready($loopdate3,$config['function']['clientstatus']['datazero2'], intervaltosecond($config['function']['clientstatus']['interval2'])) == true)
						{
							$changedesc = true;
							$config['function']['clientstatus']['datazero2'] = $loopdate3;
						}
						else
						{
							$changedesc = false;
						}
	
	foreach($config['function']['clientstatus']['aalgroup'] as $group)
	{
		$usersgroup = $tsAdmin->serverGroupClientList($group, $names = true);
		foreach($usersgroup['data'] as $user)
		{
			foreach($config['function']['clientstatus']['info'] as $number)
			{
				if($user['cldbid'] == $number['dbid'])
				{
					$clientfind = $tsAdmin->clientFind($user['client_nickname']);
					if(!empty($clientfind['data']))
						{
							$status = "ONLINE";
						}
						else
						{
							$status = "OFFLINE";
						}
					$channelname = str_replace('[RANG]', groupname($group), $config['function']['clientstatus']['channelname']);
					$channelname = str_replace('[NICK]', $user['client_nickname'], $channelname);
					$channelname = str_replace('[STATUS]', $status, $channelname);
					$tsAdmin->channelEdit($number['channel'], array('channel_name' => $channelname));
					$clientinfo = $tsAdmin->clientDbInfo($user['cldbid']);
						
						if($status == "ONLINE")
						{
							$status = "[color=green]".$status."[/color]\n";
						}
						else
						{
							$status = "[color=red]".$status."[/color]\n[img]https://www.iconfinder.com/icons/2672709/download/png/20[/img] ".$language['clientstatus']['lastconnection'].": ".date('Y-m-d G:i:s',$clientinfo['data']['client_lastconnected'])."\n";
						}
						
						$desc = "[CENTER][IMG]https://i.imgur.com/aD9xgKz.png[/IMG][/CENTER]\n[size=10][img]https://www.iconfinder.com/icons/2123927/download/png/20[/img] [b][URL=client://1/".$user['client_unique_identifier']."]".$user['client_nickname']."[/url]\n[img]https://www.iconfinder.com/icons/2672790/download/png/20[/img] Status: ".$status."[img]https://www.iconfinder.com/icons/2672732/download/png/20[/img] ".$language['clientstatus']['connections'].": ".$clientinfo['data']['client_totalconnections'];
					if($config['function']['clientstatus']['steamstatus'])
					{
						$api = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$config['function']['clientstatus']['steamapi']."&steamids=".$number['steamid'];
						$steamuser = json_decode(file_get_contents($api));
						$steam_status = $steamuser->response->players[0]->personastate;
						switch($steam_status)
						{
							case 0: $steam_status = "[color=red]Offline[/color]\n[img]https://www.iconfinder.com/icons/2672709/download/png/20[/img] ".$language['clientstatus']['lastseen'].": ".date('Y-m-d G:i:s', $steamuser->response->players[0]->lastlogoff); 
							break;
							case 1: $steam_status = "[color=green]Online[/color]"; 
							break;
							case 2: $steam_status = "[color=blue]".$language['clientstatus']['busy']."[/color]"; 
							break;
							case 3: $steam_status = "[color=blue]".$language['clientstatus']['away']."[/color]"; 
							break;
							case 4: $steam_status = "[color=blue]".$language['clientstatus']['snooze']."[/color]"; 
							break;
							case 5: $steam_status = "[color=blue]".$language['clientstatus']['lookingtotrade']."[/color]"; 
							break;
							case 6: $steam_status = "[color=blue]".$language['clientstatus']['lookingtoplay']."[/color]"; 
							break;
						}
						if(isset($steamuser->response->players[0]->gameextrainfo))
						{
							$gamename = $steamuser->response->players[0]->gameextrainfo;
							$game = "[img]https://www.iconfinder.com/icons/2672772/download/png/20[/img]".$language['clientstatus']['currentlyplaying']." [color=blue]".$gamename."[/color]";
						}
						else
						{
							$game = "[img]https://www.iconfinder.com/icons/2124251/download/png/20[/img] ".$language['clientstatus']['curentlynotplaying'];
						}
						$nicksteam = $steamuser->response->players[0]->personaname;
						$profilelink = $steamuser->response->players[0]->profileurl;
					
						$desc .= "[/b][/size]\n[center][URL=".$profilelink."]"."[IMG]https://steamstore-a.akamaihd.net/public/shared/images/header/globalheader_logo.png?t=962016[/IMG][/URL][/center]\n"."[size=10][b][img]https://www.iconfinder.com/icons/2123927/download/png/20[/img] Nick steam: [URL=".$profilelink."]".$nicksteam."[/URL][/b][/SIZE]\n[size=10][b][img]https://www.iconfinder.com/icons/2672790/download/png/20[/img] Status: ".$steam_status."\n".$game."[/b][/size]".$footer;

					}
						if($changedesc)
						{
							$tsAdmin->channelEdit($number['channel'], array('channel_description' => $desc));
						};
				}	
			}
		}	
	}			
}
		
?>