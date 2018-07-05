<?php 
function groupname3($search)
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

function helpchannel()
{
	global $config;
	global $tsAdmin;
	global $first;
	global $first2;
	global $correct;
	global $newinchannel;
	$correct = false;
	$admincount = 0;
	$number	= 0;
	$number2 = 0;
	$needgroupnumber = 0;
	$commandlist = "\n";
	$commandcommand = "[b]".$config['function']['helpchannel']['commandlist']."[/b] - lista komend";
	$commandgrouplist = "[b]".$config['function']['helpchannel']['grouplist']."[/b] - lista dostępnych grup";
	$grouplist = "\n";
	$needsgroup = "";
	$commands = Array($commandcommand,'[b]!admin[/b] - wezwij admina', $commandgrouplist, '[b]!add [nr grupy][/b] - nadaj rangę, np. [b]!add 22[/b]', '[b]!del [nr grupy][/b] - zabierz rangę, np. [b]!del 22[/b]', "[b]!info[/b] - informacje o połączeniu");
	foreach($commands as $command)
	{
		$number++;
		$commandlist.=$number.'. '.$command.'\n';
	}
	foreach($config['function']['helpchannel']['info'] as $command)
	{
		$number++;
		$commandlist.=$number.'. '."[b]".$command['command']."[/b]".' - '.$command['desc'].'\n';
	}
	$desc = str_replace('[COMMAND]', $commandlist, $config['function']['helpchannel']['channeldesc']);
	$desc = $config['function']['helpchannel']['channeldesctopic']."\n".$desc;
	if(!$first)
	{
		$tsAdmin -> channelEdit($config['function']['helpchannel']['channel'], Array('CHANNEL_DESCRIPTION'=> $desc));
		$first = true;
	}
	$user = $tsAdmin -> channelClientList($config['function']['helpchannel']['channel'], '-country -ip -times -groups -uid -info');
	$whoami = $tsAdmin->getElement('data', $tsAdmin->whoAmI());	
		$tsAdmin->clientMove($whoami['client_id'] , $config[3]['bot']['channel']);
	
	if(isset($user['data'][0]))
	{
		$channelname = str_replace('[STATUS]', "[Zajęty]", $config['function']['helpchannel']['channelname']);
		$tsAdmin -> channelEdit($config['function']['helpchannel']['channel'], Array('CHANNEL_NAME'=> $channelname));
		
		$loopdate2 = date('Y-m-d G:i:s');
		$user = $tsAdmin -> channelClientList($config['function']['helpchannel']['channel'], '-country -ip -times -groups -uid -info');
		$tsAdmin->clientMove($whoami['client_id'] , $config['function']['helpchannel']['channel']);
		
		if($user['data'][0]['client_idle_time'] > 120000)
		{
		$tsAdmin-> clientKick($user['data'][0]['clid'], "channel", "Zbyt długi czas nieaktywności");
		}
		
//register		
		$groupclient = explode(',', $user['data'][0]['client_servergroups']);
		$countneedgroup = count($config['function']['helpchannel']['needgroup']);
		foreach($config['function']['helpchannel']['needgroup'] as $needgroup)
		{
			$arraygroup[] = $needgroup['command'];
			$needsgroup .= '\n'.$needgroup['command'];
			if(count($groupclient) > 1)
			{
				if(!in_array($needgroup['groupid'] ,$groupclient))
				{
					$needgroupnumber++;
				}
			}
			else if((count($groupclient) == 1) && ($needgroup['groupid'] != $groupclient))
			{
				$needgroupnumber++;
			}	
		}
		if($needgroupnumber == $countneedgroup)
		{
			
			$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], "\n[b]Zarejestruj się, wpisując jedną z poniższych komend, aby skorzystać z pomocy[/b]".$needsgroup);
			$messages = $tsAdmin -> readChatMessage('textchannel', false, $config['function']['helpchannel']['channel'], 30);
			$message = $messages['data']['msg'];
			sleep(1);
			if(in_array($message, $arraygroup))
			{
				$komenda = array_search($message, array_column($config['function']['helpchannel']['needgroup'], 'command'));
				$tsAdmin -> serverGroupAddClient($config['function']['helpchannel']['needgroup'][$komenda+1]['groupid'], $user['data'][0]['client_database_id']);
				$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], "\n[b]Zarejestrowano[/b]\n");
			}
			
			return;	
		}
		else
		{
			if(!$newinchannel)
		{
			$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], "[b]".$commandlist."[/b]");
		}
			$messages = $tsAdmin -> readChatMessage('textchannel', false, $config['function']['helpchannel']['channel'], 10);
			$message = $messages['data']['msg'];
		}

		if($message && ($messages['data']['invokerid'] == $user['data'][0]['clid']))
		{
		
//!admin
			if($message == "!admin")
			{
				sleep(1);
				if(ready($loopdate2, $config['function']['helpchannel']['datazeroadmin'], 30) == true)
				{
					$config['function']['helpchannel']['datazeroadmin'] = $loopdate2;
					foreach($config['function']['helpchannel']['admingroup'] as $group)
					{
						$clients = $tsAdmin->serverGroupClientList($group, $names = true);	
						foreach($clients['data'] as $client)
						{
							$find = $tsAdmin->clientFind($client['client_nickname']);
							if($find['data'])
							{
								$admincount++;
								$pokemessage = str_replace('[NICK]', $user['data'][0]['client_nickname'], $config['function']['helpchannel']['adminpokemessage']);
								$tsAdmin->clientPoke($find['data'][0]['clid'], $pokemessage);
							}
						}
			
					}
					if($admincount == 0)
					{
						$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], "\n[b]Brak administracji na serwerze[/b]");
					}
					else if($admincount == 1)
					{
						$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], "\n[b]Administrator został poinformowany[/b]");
					}
					else
					{
						$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], "\n[b]Administratorzy zostali poinformowani[/b]");
					}
				}
				else
				{
					$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], "\n[b]Poczekaj chwilę[/b]");	
				}
				
				$correct = true;
			}

//!group list
			if($message == $config['function']['helpchannel']['grouplist'])
			{
				sleep(1);
				foreach($config['function']['helpchannel']['servergroup'] as $group)
				{
					$number2++;
					$grouplist .= $number2.". [b]".groupname3($group)."[/b]\n";
				}
				$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], $grouplist);
				
				$correct = true;
			}
	
//!groupadd	
			if(substr($message, 0, 4) == "!add")
			{
				sleep(1);
				if(count($groupclient) >= $config['function']['helpchannel']['maxservergroup'])
				{
					$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], "\n[b]Posiadasz już maksymalną ilość grup[/b]");
				}
				else
				{
					$message = str_replace('!add ', '', $message);
					$message2 = str_replace('!add', '', $message);
					if(isset($config['function']['helpchannel']['servergroup'][$message-1]))
					{
						if(!in_array($config['function']['helpchannel']['servergroup'][$message-1], $groupclient))
						{
							$tsAdmin -> serverGroupAddClient($config['function']['helpchannel']['servergroup'][$message-1], $user['data'][0]['client_database_id']);
							$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], "\n[b]Dodano do grupy[/b]");	
						}
						else
						{
							$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], "\n[b]Posiadasz już tę grupe[/b]");
						}
					}
					else if($message2 == "")
					{
						$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], "\n[b]Podaj grupę[/b]");
					}
					else
					{
						$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], "\n[b]Podano błędną grupę[/b]");
					}
				}
				
				$correct = true;		
			}	
	
//!groupdel
			if(substr($message, 0, 4) == "!del")
			{
				sleep(1);
				$message = str_replace('!del ', '', $message);
				$message2 = str_replace('!del', '', $message);
				if(isset($config['function']['helpchannel']['servergroup'][$message-1]))
				{
					if(in_array($config['function']['helpchannel']['servergroup'][$message-1], $groupclient))
					{
						$tsAdmin -> serverGroupDeleteClient($config['function']['helpchannel']['servergroup'][$message-1], $user['data'][0]['client_database_id']);
						$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], "[b]Usunięto z grupy[/b]");	
					}
					else 
					{
						$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], "\n[b]Nie posiadasz tej grupy[/b]");
					}
				}
				else if($message2 == "")
				{
					$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], "\n[b]Podaj grupę[/b]");
				}
				else
				{
					$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], "\n[b]Podano błędną grupę[/b]");
				}
				
				$correct = true;		
			}	
			
//info
			if($message == "!info")
			{
				sleep(1);
				$user = $user['data'][0];
				$correct = true;
				$clientinfo = 
				"\n[b]Nick: [i]".$user['client_nickname']."[/i]\n".
				"Client_id: ".$user['clid']."\n".
				"Client_database_id: ".$user['client_database_id']."\n".
				"Unique ID: ".$user['client_unique_identifier']."\n".
				"IP: ".$user['connection_client_ip']."\n".
				"Pierwsze połączenie: ".date('Y-m-d G:i:s', $user['client_created'])."\n".
				"Platforma: ".$user['client_platform']."\n".
				"Kraj: ".$user['client_country']."[/b]\n";
				$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], $clientinfo);
				
			}
			
			
//comand list
			if($message == $config['function']['helpchannel']['commandlist'])
			{	
				sleep(1);
				$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], "[b]".$commandlist."[/b]");
				
				$correct = true;		
			}
			
//command	
			foreach($config['function']['helpchannel']['info'] as $command)
			{
				if($command['command'] == $message)
				{
					sleep(1);
					$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], $command['message']);
					$correct = true;
				}
			}	
		
			if(!$correct)
			{
				sleep(1);
				$tsAdmin -> sendMessage(2, $config['function']['helpchannel']['channel'], '\n[b]Komenda "[i]'.$message.'[/i]" nie istnieje. Użyj jednej z poniższych komend:'.$commandlist."[/b]");
			}
			$tsAdmin->clientMove($whoami['client_id'] , $config[3]['bot']['channel']);
		}
		$tsAdmin->clientMove($whoami['client_id'] , $config[3]['bot']['channel']);
		$user = $tsAdmin -> channelClientList($config['function']['helpchannel']['channel'], '-country -ip -times -groups -uid -info');
		$newinchannel = true;
	}
	else
	{
		$channelname = str_replace('[STATUS]', "[WOLNY]", $config['function']['helpchannel']['channelname']);
		$tsAdmin -> channelEdit($config['function']['helpchannel']['channel'], Array('CHANNEL_NAME'=> $channelname));
		$newinchannel = false;
		sleep(10);
	}
}
?>