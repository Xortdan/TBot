<?php 


function helpchannel()
{
	global $config;
	global $tsAdmin;
	global $first;
	global $correct;
	global $footer;
	global $newinchannel;
	global $isregisted;
	global $needgroups;
	global $loopdate2;
	global $clientonchannel2;
	$isregisted = false;
	$user = $tsAdmin->clientList("-uid -away -voice -times -groups -info -icon -country -ip -badges");
	$correct = false;
	$number	= 0;
	$number2 = 0;
	$number3 = 0;
	$needgroupnumber = 0;
	$commandlist = "\n";
	$commandcommand = "[b]".$config['function']['helpchannel']['commandlist']."[/b] - lista komend";
	$commandgrouplist = "[b]".$config['function']['helpchannel']['grouplist']."[/b] - lista dostępnych grup";
	$grouplist = "\n";
	
	$connect = mysqli_connect($config[4]['database']['host'], $config[4]['database']['login'], $config[4]['database']['password'], $config[4]['database']['dbname']);
	
	$commands = Array($commandcommand,'[b]!admin[/b] - wezwij admina', "[b]!msg_admins[/b] - zostaw wiadomość do administracji, jeśli nie ma jej aktualnie na serwerze",$commandgrouplist, '[b]!add [nr grupy][/b] - nadaj rangę, np. [b]!add 22[/b]', '[b]!del [nr grupy][/b] - zabierz rangę, np. [b]!del 22[/b]', "[b]!info[/b] - informacje o połączeniu");
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
		$tsAdmin -> channelEdit($config['function']['helpchannel']['channel'], Array('CHANNEL_DESCRIPTION'=> $desc.$footer));
		foreach($config['function']['helpchannel']['needgroup'] as $needgroup)
		{
		$arraygroup[] = $needgroup['command'];
		$needgroups .= $needgroup['command'].'\n';
		}
		$first = true;
	}
	$whoami = $tsAdmin->getElement('data', $tsAdmin->whoAmI());
	
	$clientonchannel = array_keys(array_column($user['data'], 'cid'), $config['function']['helpchannel']['channel']);
	
	//send msg
	if(!isset($clientonchannel[0]))
	{
		$clientonchannel = Array();
		sleep($config[3]['bot']['speed']);
	}
	else
	{
		foreach($clientonchannel as $userid)
		{
			if(!isset($clientonchannel2[$userid]))
			{
				$clientonchannel2[$userid]['userid'] = $userid;
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
	if(isset($clientonchannel2))
	{
		foreach($clientonchannel2 as $userid)
		{
			$id = $userid['userid'];
			if($user['data'][$id]['cid'] != $config['function']['helpchannel']['channel'])
				{
					unset($clientonchannel2[$id]);
				} 
		}
	}
	
	


	if(isset($clientonchannel[0]))
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
							$admincount = 0;
							$admincount2 = 0;
							$config['function']['helpchannel']['datazeroadmin'] = $loopdate2;
							foreach($config['function']['helpchannel']['admingroup'] as $group)
							{
								$groupclient = $tsAdmin->serverGroupClientList($group, $names = true);	
								foreach($groupclient['data'] as $groupclient)
								{
									$find = $tsAdmin->clientFind($groupclient['client_nickname']);
									if($find['data'])
									{
										$admin = $tsAdmin-> clientInfo($find['data'][0]['clid']);
										if(!in_array($admin['data']['cid'], $config['function']['helpchannel']['ignoredonchannel']))
										{
											$admincount++;
											$message['data']['invokeruid'];
										$client_link_profile = "[URL=client://0/".$message['data']['invokeruid']."]".$message['data']['invokername']."[/URL]";
											$pokemessage = str_replace('[NICK]', $client_link_profile, $config['function']['helpchannel']['adminpokemessage']);
											$tsAdmin->clientPoke($find['data'][0]['clid'], $pokemessage);
										}
										else
										{
											$admincount2++;	
										}
									}
								}
			
							}
							if($admincount == 0 && $admincount2==1)
							{
								$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Administrator jest aktualnie zajęty[/b]");
								return;
							}
							else if($admincount == 0 && $admincount2>1)
							{
								$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Administratorzy są aktualnie zajęci[/b]");	
								return;
							}
							else if($admincount == 0)
							{
								$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Brak administracji na serwerze! Zostaw wiadomość korzystając z komendy !msg_admins[/b]");	
								return;
							}
							else if($admincount == 1)
							{
								$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Administrator został poinformowany[/b]");
								return;
							}
							else
							{
								$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Administratorzy zostali poinformowani[/b]");
								return;
							}
						}
						else
						{
							$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Poczekaj chwilę[/b]");	
						}
				
						return;
					}
					
	//!msg_admins
					
					if(strpos(strtoupper($msg), strtoupper("!msg_admins")) !== false && $config['function']['helpchannel']['msgtoadminenable'])
					{
						$msg = str_ireplace("!msg_admins", "", $msg);
						$admincount = 0;
						foreach($config['function']['helpchannel']['admingroup'] as $group)
						{
							$groupclient = $tsAdmin->serverGroupClientList($group, $names = true);	
							foreach($groupclient['data'] as $groupclient)
							{
								$find = $tsAdmin->clientFind($groupclient['client_nickname']);
								if($find['data'])
								{
									$admin = $tsAdmin-> clientInfo($find['data'][0]['clid']);
									if(!in_array($admin['data']['cid'], $config['function']['helpchannel']['ignoredonchannel']))
									{
										$admincount++;
									}
								}
							}
						}
						if($admincount == 0)
						{
							if($msg != "")
							{
								if(strlen($msg) <= 200)
								{
									$channel_info = $tsAdmin -> channelInfo($config['function']['helpchannel']['msgtoadminchannel']);
									$channel_desc = $channel_info['data']['channel_description'];
									$i = 1;
									$desc = "[center][b][size=13][color=green]WIADOMOŚĆI DO ADMINISTRACJI[/color][/size][/b][/center]\n\n";
					
									$question = "SELECT * FROM problems WHERE DBID = ".$client['client_database_id'];	
									$problems = mysqli_query($connect, $question);
						
									if(mysqli_num_rows($problems) == 0)
									{
										mysqli_query($connect, "UPDATE problems set number = number + 1");
										$question = "INSERT INTO problems(`number`, `nickname`, `DBID`, `UID`, `problem`, `time`) VALUES(1, '".$client['client_nickname']."', ".$client['client_database_id'].", '".$client['client_unique_identifier']."', '".$msg."', ".time().");";
										mysqli_query($connect, $question);
									}
									else
									{
										$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Wysłałeś juz wiadomość[/b]");
									}
							
										if($config['function']['helpchannel']['msgtoadmindelete'])
										{
											$question = "DELETE FROM problems WHERE number > ".$config['function']['helpchannel']['msgtoadminmax'];
											mysqli_query($connect, $question);
										}
						
									$question = "SELECT nickname, DBID, UID, time, problem FROM problems ORDER BY number LIMIT ".$config['function']['helpchannel']['msgtoadminmax'];
									$problems = mysqli_query($connect, $question);
						
									while($row=mysqli_fetch_array($problems))
									{
										$desc .= $i.". [b]Nick: [/b][URL=client://1/".$row['UID']."]".$row['nickname']."[/URL], [b]DBID:[/b] ".$row['DBID'].", [b]".date('H:i d.m.Y', $row['time'])."[/b]\n[b]Wiadomość:[/b] ".$row['problem']."[hr]\n";
										$i++;
									}
									$tsAdmin -> channelEdit($config['function']['helpchannel']['msgtoadminchannel'], Array('CHANNEL_DESCRIPTION'=> $desc.$footer));
									$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Wysłano[/b]");
								}
								else
								{
									$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Maksymalna liczba zanaków to 200![/b]");
								}
							}
							else
							{
								$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Podaj wiadomość[/b]");
							}
						}
						else
						{
							$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "\n[b]Administracja znajduje się na serwerze! użyj komendy !admin[/b]");
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
						"Platforma: ".$client['client_platform'].
						"Kraj: ".$client['client_country']."\n";
						if($config['function']['helpchannel']['profilelinkenable'])
						{
							$clientinfo .= "Profil: [url=".$config['function']['helpchannel']['profilelink']."/stats.php?user=".$client['client_database_id']."]Link[/url][/b]";	
						}
						else
						{
							$clientinfo .= "[/b]";
						}
						$tsAdmin -> sendMessage(1, $message['data']['invokerid'], $clientinfo);
						return;
					}
					
	//command list 				
					if($msg == $config['function']['helpchannel']['commandlist'])
					{	
						$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "[b]".$commandlist."[/b]");
						return;		
					}
					
	//ban on channel
					if(strpos(strtoupper($msg), strtoupper("!ban")) !== false)
					{	
						$comm = explode(" ", $msg);
						$isadminonchannel = false;
						if(isset($comm[1]) && isset($comm[2]) && is_numeric($comm[1]) && is_numeric($comm[1]) && $comm[1] != 1)
						{
							foreach($config['function']['helpchannel']['channeladmingroups'] as $group)
							{
								$checkgroup = $tsAdmin -> channelGroupClientList($comm[2], $client['client_database_id'], $group);
								if(isset($checkgroup['data'][0]))
								{
									$isadminonchannel = true;
								}
							}
							if($isadminonchannel)
							{
								$checkgroup = $tsAdmin -> channelGroupClientList($comm[2], $comm[1], $config['function']['helpchannel']['bangroup']);
								if(!isset($checkgroup['data'][0]))
								{
									$tsAdmin -> channelGroupAddClient($config['function']['helpchannel']['bangroup'], $comm[2], $comm[1]);
									$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "[b]Zbanowano[/b]");
									return;	
								}
								else
								{
									$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "[b]Wybrany użytkownik posiada już na twoim kanale bana[/b]");
									$tsAdmin->gm('ada');
									return;	
								}
							}
							else
							{
								$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "[b]Nie jesteś administratorem na tym kanale![/b]");
								return;	
							}
						}
						else
						{
							$tsAdmin -> sendMessage(1, $message['data']['invokerid'], "[b]Podaj poprawną wartość! !ban [dbid] [cid][/b]");
							return;	
						}						
					}
					
					if(!$correct)
					{
					foreach($config['function']['helpchannel']['info'] as $command)
					{
						if($command['command'] == $msg)
						{
							$tsAdmin -> sendMessage(1, $message['data']['invokerid'], substr($command['message'],0,1024));
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