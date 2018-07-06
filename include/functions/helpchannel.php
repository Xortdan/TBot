<?php 


function helpchannel()
{
	global $config;
	global $tsAdmin;
	global $first;
	global $first2;
	global $correct;
	global $newinchannel;
	global $isregisted;
	global $needgroups;
	global $loopdate2;
	global $clientonchannel;
	$isregisted = false;
	$user = $tsAdmin->clientList("-uid -away -voice -times -groups -info -icon -country -ip -badges");
	$correct = false;
	$admincount = 0;
	$number	= 0;
	$number2 = 0;
	$number3 = 0;
	$needgroupnumber = 0;
	$commandlist = "\n";
	$commandcommand = "[b]".$config['function']['helpchannel']['commandlist']."[/b] - lista komend";
	$commandgrouplist = "[b]".$config['function']['helpchannel']['grouplist']."[/b] - lista dostępnych grup";
	$grouplist = "\n";
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
		foreach($config['function']['helpchannel']['needgroup'] as $needgroup)
		{
		$arraygroup[] = $needgroup['command'];
		$needgroups .= $needgroup['command'].'\n';
		}
		$first = true;
	}
	$whoami = $tsAdmin->getElement('data', $tsAdmin->whoAmI());
	
	$clientinchannel = array_keys(array_column($user['data'], 'cid'), $config['function']['helpchannel']['channel']);
	
	
	//send msg
	if(!isset($clientinchannel[0]))
	{
		$clientonchannel = Array();
		sleep($config[3]['bot']['speed']);
	}
	else
	{
		foreach($clientinchannel as $userid)
		{
			if(!isset($clientonchannel[$userid]))
			{
				$clientonchannel[$userid]['userid'] = $userid;
				$clientgroup = explode(',', $user['data'][$userid]['client_servergroups']);
				foreach($config['function']['helpchannel']['needgroupall'] as $needgroup)
				{
					if(in_array($needgroup, $clientgroup))
					$isregisted = true;
				}
				if($isregisted == false)
				{	
					$tsAdmin -> sendMessage(1, $user['data'][$userid]['clid'], "\n[b]Zarejestruj się, wpisując jedną z poniższych komend, aby skorzystać z pomocy\n".$needgroups."[/b]");
				}
				else
				{
					$tsAdmin -> sendMessage(1, $user['data'][$userid]['clid'], $commandlist);
				}
			}
		}
	}
	
	foreach($clientonchannel as $userid)
	{
		$id = $userid['userid'];
		if($user['data'][$id]['cid'] != $config['function']['helpchannel']['channel'])
			{
				unset($clientonchannel[$id]);
			} 
	}
	
	


	if(isset($clientinchannel[0]))
	{
		$message = $tsAdmin -> readChatMessage('textprivate', true, -1, $config[3]['bot']['speed']);
		$msg = $message['data']['msg'];
		if($msg != NULL)
		{
			$client = $tsAdmin -> clientInfo($message['data']['invokerid']);
			$client = $client['data'];
			
		//register	
			if($client['cid'] == $config['function']['helpchannel']['channel'])
			{
				$clientgroup = explode(',', $client['client_servergroups']);
				
				foreach($config['function']['helpchannel']['needgroupall'] as $needgroup)
				{
					if(in_array($needgroup, $clientgroup))
						$isregisted = true;
				}

				if($isregisted == false)
				{
					foreach($config['function']['helpchannel']['needgroup'] as $regroup)
					{
						if($msg == $regroup['command'])	
						{
							$tsAdmin -> serverGroupAddClient($regroup['groupid'], $client['client_database_id']);
							$tsAdmin ->clientPoke($message['data']['invokerid'], "[b]Zarejestrowano"."[/b]");
							$tsAdmin -> sendMessage(1, $message['data']['invokerid'], $commandlist);
							return;
						}
						else
						{
						$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Podaj właściwą grupę\n".$needgroups."[/b]");	
						return;
						}
					}
				}
				else
				{
					
	//!admin
					if($msg == "!admin")
					{
						if(ready($loopdate2, $config['function']['helpchannel']['datazeroadmin'], 30) == true)
						{
							$config['function']['helpchannel']['datazeroadmin'] = $loopdate2;
							foreach($config['function']['helpchannel']['admingroup'] as $group)
							{
								$groupclient = $tsAdmin->serverGroupClientList($group, $names = true);	
								foreach($groupclient['data'] as $groupclient)
								{
									$find = $tsAdmin->clientFind($groupclient['client_nickname']);
									if($find['data'])
									{
										$admincount++;
										$pokemessage = str_replace('[NICK]', $message['data']['invokername'], $config['function']['helpchannel']['adminpokemessage']);
										$tsAdmin->clientPoke($find['data'][0]['clid'], $pokemessage);
									}
								}
			
							}
							if($admincount == 0)
							{
								$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Brak administracji na serwerze[/b]");
							}
							else if($admincount == 1)
							{
								$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Administrator został poinformowany[/b]");
							}
							else
							{
								$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Administratorzy zostali poinformowani[/b]");
							}
						}
						else
						{
							$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Poczekaj chwilę[/b]");	
						}
				
						return;
					}
					
	//!group list
					if($msg == $config['function']['helpchannel']['grouplist'])
					{
						foreach($config['function']['helpchannel']['servergroup'] as $group)
						{
							$number2++;
							$grouplist .= $number2.". [b]".groupname($group)."[/b]\n";
						}
						$tsAdmin -> sendMessage(1, $message['data']['invokerid'], $grouplist);
				
						return;
					}
					
	//!groupadd	
					if(substr($msg, 0, 4) == "!add")
					{
						if(count($clientgroup) >= $config['function']['helpchannel']['maxservergroup'])
						{
							$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Posiadasz już maksymalną ilość grup[/b]");
						}
						else
						{
							$msg = str_replace('!add ', '', $msg);
							$msg2 = str_replace('!add', '', $msg);
							
							if(!((int)$msg>0 && (int)$msg<9999999))
							{
								$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Podano błędną grupę[/b]");
								return;
							}
							
							if(isset($config['function']['helpchannel']['servergroup'][$msg-1]))
							{
								if(!in_array($config['function']['helpchannel']['servergroup'][$msg-1], $clientgroup))
								{
									$tsAdmin -> serverGroupAddClient($config['function']['helpchannel']['servergroup'][$msg-1], $client['client_database_id']);
									$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Dodano do grupy[/b]");	
								}
								else
								{
									$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Posiadasz już tę grupe[/b]");
								}
							}
							else if($msg2 == "" || $msg == "")
							{
								$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Podaj grupę[/b]");
							}
							else
							{
								$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Podano błędną grupę[/b]");
							}	
						}
				
						return;		
					}	
	
	//!groupdel
					if(substr($msg, 0, 4) == "!del")
					{
						$msg = str_replace('!del ', '', $msg);
						$message2 = str_replace('!del', '', $msg);
						
						if(!((int)$msg>0 && (int)$msg<9999999))
							{
								$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Podano błędną grupę[/b]");
								return;
							}
							
						if(isset($config['function']['helpchannel']['servergroup'][$msg-1]))
						{
							if(in_array($config['function']['helpchannel']['servergroup'][$msg-1], $clientgroup))
							{
								$tsAdmin -> serverGroupDeleteClient($config['function']['helpchannel']['servergroup'][$msg-1], $client['client_database_id']);
								$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "[b]Usunięto z grupy[/b]");	
							}
						else 
							{
								$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Nie posiadasz tej grupy[/b]");
							}
						}
						else if($message2 == "")
						{
							$tsAdmin ->sendMessage(1, $message['data']['invokerid'], "\n[b]Podaj grupę[/b]");
						}
						else
						{
							$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Podano błędną grupę[/b]");
						}
				
						return;		
					}
					
	//info				
					if($msg == "!info")
					{
						$clientinfo = 
						"\n[b]Nick: [i]".$client['client_nickname']."[/i]\n".
						"Client_id: ".$message['data']['invokerid']."\n".
						"Client_database_id: ".$client['client_database_id']."\n".
						"Unique ID: ".$client['client_unique_identifier']."\n".
						"IP: ".$client['connection_client_ip']."\n".
						"Pierwsze połączenie: ".date('Y-m-d G:i:s', $client['client_created'])."\n".
						"Platforma: ".$client['client_platform']."\n".
						"Kraj: ".$client['client_country']."[/b]\n";
						$tsAdmin -> sendMessage(1, $message['data']['invokerid'], $clientinfo);
						return;
					}
					
	//command list 				
					if($msg == $config['function']['helpchannel']['commandlist'])
					{	
						$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "[b]".$commandlist."[/b]");
						return;		
					}
					
					if(!$correct)
					{
					foreach($config['function']['helpchannel']['info'] as $command)
					{
						if($command['command'] == $msg)
						{
							$tsAdmin -> sendMessage(1, $message['data']['invokerid'], $command['message']);
							return;
						}
					}	
						
					$tsAdmin -> sendMessage(1, $message['data']['invokerid'], '\n[b]Komenda "[i]'.$msg.'[/i]" nie istnieje. Użyj jednej z poniższych komend:'.$commandlist."[/b]");
					}	
				}
			}
		}
	}
	else
	{
		sleep($config[3]['bot']['speed']);
	}
}
?>