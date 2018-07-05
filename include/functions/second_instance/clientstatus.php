<?php 

	function groupname2($search)
	{
		global $tsAdmin;
		global $groups;
		$groupname = "";
		foreach($groups['data'] as $group)
		{
			if($group['sgid'] == $search)
			{
				$groupname = $group['name'];
			}
		}
		return $groupname;
	}

function clientstatus()
{
	global $config;
	global $tsAdmin;
	global $groups;	
	global $footer;
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
					$channelname = str_replace('[RANG]', groupname2($group), $config['function']['clientstatus']['channelname']);
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
							$status = "[color=red]".$status."[/color]\nOstatnie połączanie: ".date('Y-m-d G:i:s',$clientinfo['data']['client_lastconnected'])."\n";
						}
						
						$desc = "[CENTER][IMG]https://i.imgur.com/aD9xgKz.png[/IMG][/CENTER]\n[size=10][b][URL=client://1/".$user['client_unique_identifier']."]".$user['client_nickname']."[/url]\nStatus: ".$status."Widziany łącznie: ".$clientinfo['data']['client_totalconnections'];
					if($config['function']['clientstatus']['steamstatus'])
					{
						$api = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$config['function']['clientstatus']['steamapi']."&steamids=".$number['steamid'];
						$steamuser = json_decode(file_get_contents($api));
						$steam_status = $steamuser->response->players[0]->personastate;
						switch($steam_status)
						{
							case 0: $steam_status = "[color=red]Offline[/color]\nOstatnio widziany: ".date('Y-m-d G:i:s', $steamuser->response->players[0]->lastlogoff); 
							break;
							case 1: $steam_status = "[color=green]Online[/color]"; 
							break;
							case 2: $steam_status = "[color=blue]Zajęty[/color]"; 
							break;
							case 3: $steam_status = "[color=blue]ZW[/color]"; 
							break;
							case 4: $steam_status = "[color=blue]Drzemka[/color]"; 
							break;
							case 5: $steam_status = "[color=blue]Chce handlować[/color]"; 
							break;
							case 6: $steam_status = "[color=blue]Chce grać[/color]"; 
							break;
						}
						if(isset($steamuser->response->players[0]->gameextrainfo))
						{
							$gamename = $steamuser->response->players[0]->gameextrainfo;
							$game = "Aktualnie gra w [color=blue]".$gamename."[/color]";
						}
						else
						{
							$game = "Aktualnie w nic nie gra";
						}
						$nicksteam = $steamuser->response->players[0]->personaname;
						$profilelink = $steamuser->response->players[0]->profileurl;
					
						$desc .= "[/b][/size]\n[center][URL=".$profilelink."]"."[IMG]https://steamstore-a.akamaihd.net/public/shared/images/header/globalheader_logo.png?t=962016[/IMG][/URL][/center]\n"."[size=10][b]Nick steam: [URL=".$profilelink."]".$nicksteam."[/URL][/b][/SIZE]\n[size=10][b]Status: ".$steam_status."\n".$game."[/b][/size]".$footer;

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