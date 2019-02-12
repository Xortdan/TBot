<?php 

function clientstatus()
	{
	global $config;
	global $tsAdmin;
	global $user;
	global $groups;	
	global $footer;
	global $language;
	$interval = intervaltosecond($config['function']['clientstatus']['interval']);
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
		foreach($usersgroup['data'] as $client)
		{
			foreach($config['function']['clientstatus']['info'] as $number)
			{
				if($client['cldbid'] == $number['dbid'])
				{
					$clientfind = $tsAdmin->clientFind($client['client_nickname']);
					if(!empty($clientfind['data']))
					{
						$status = "ONLINE";
					}
					else
					{
						$status = "OFFLINE";
					}
					$channelname = str_replace('[RANG]', groupname($group), $config['function']['clientstatus']['channelname']);
					$channelname = str_replace('[NICK]', $client['client_nickname'], $channelname);
					$channelname = str_replace('[STATUS]', $status, $channelname);
					$tsAdmin->channelEdit($number['channel'], array('channel_name' => $channelname));
					if($changedesc)
					{
							
						$clientinfo = $tsAdmin->clientDbInfo($client['cldbid']);
						
						if($status == "ONLINE")
						{
							$data1 = time();
							$data2 = $clientinfo['data']['client_lastconnected'];
							$difference = $data1 - $data2;
							$m = floor($difference / 60);
							$h = floor($m/60);
							$m = $m-($h*60);
							
							$status = "[color=green]".$status."[/color]\n[img]https://www.iconfinder.com/icons/3325091/download/png/20[/img] ".$language['clientstatus']['activeby'].": ".$h."h ".$m."m"."\n";
						}
						else
						{
							$status = "[color=red]".$status."[/color]\n[img]https://www.iconfinder.com/icons/2672709/download/png/20[/img] ".$language['clientstatus']['lastconnection'].": ".date('Y-m-d G:i:s',$clientinfo['data']['client_lastconnected'])."\n";
						}
						
						$desc = "[CENTER][IMG]https://i.imgur.com/aD9xgKz.png[/IMG][/CENTER]\n[size=10]";
						if($config[2]['bot']['icons']['enable'])
						{
							$desc .= "[img]".$config[2]['bot']['icons']['adress'].$group.".png[/img] ";
						}
						else
						{
							$desc .= "[img]https://www.iconfinder.com/icons/2123927/download/png/20[/img] ";
						}
						$desc .= "[b][URL=client://1/".$client['client_unique_identifier']."]".$client['client_nickname']."[/url]\n[img]https://www.iconfinder.com/icons/2672790/download/png/20[/img] Status: ".$status."[img]https://www.iconfinder.com/icons/2672732/download/png/20[/img] ".$language['clientstatus']['connections'].": ".$clientinfo['data']['client_totalconnections'];
						
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
						$tsAdmin->channelEdit($number['channel'], array('channel_description' => $desc));
					}
				}		
			}
		}	
	}
	
	unset($changedesc);
	unset($channelname);
	unset($clientinfo);
	unset($status);
	unset($data1);
	unset($data2);
	unset($difference);
	unset($h);
	unset($m);
	unset($status);
	unset($desc);
	unset($steam_status);
	unset($api);
	unset($steamuser);
	unset($gamename);
	unset($game);
	unset($nicksteam);
	unset($profilelink);
	unset($group);
	unset($usersgroup);
	unset($names);
	unset($number);
	unset($clientfind);
	unset($http_response_header);
}
		
?>