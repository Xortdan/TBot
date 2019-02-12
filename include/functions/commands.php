<?php 
	function commands()
	{
		global $config;
		global $tsAdmin;
		global $do;
		global $footer;
		$do = false;
		
		//$online = $serverInfo['virtualserver_clientsonline'] - $serverInfo['virtualserver_queryclientsonline'];
		//$channels = $tsAdmin->channelList("-topic -flags -voice -limits -icon -secondsempty");
		//$groups = $tsAdmin->serverGroupList();
		
		$isadmin = false;
		$message = $tsAdmin -> readChatMessage('textchannel', true, $config[5]['bot']['channel'], $config[3]['bot']['speed']);
		$msg = $message['data']['msg'];
		if($msg != NULL)
		{
			$client = $tsAdmin -> clientInfo($message['data']['invokerid']);
			$groupclient = explode(',', $client['data']['client_servergroups']);
			foreach($config[5]['bot']['admins_bot'] as $admingroup)
			{
				$grou = array_search($admingroup, $groupclient);
				if(is_numeric($grou))
				{
					$isadmin = true;
				}
			}
			if($isadmin == true)
			{
				//msg server
				
				if(strpos(strtoupper($msg), strtoupper("!msg_server")) !== false && $do == false)
				{
					$command = str_ireplace("!msg_server", "", $msg);
					$serverInfo = $tsAdmin->getElement('data', $tsAdmin->serverInfo());
					$tsAdmin -> sendMessage(3, $serverInfo['virtualserver_id'], $command);
					$sendmsg = "Wysłano wiadomość: [b]".$command."[/b]";
					$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], $sendmsg);
					unset($serverInfo);
					$do = true;
				}
				
				//move client
				
				if(strpos(strtoupper($msg), strtoupper("!move_client")) !== false && $do == false)
				{
					$command = explode(" ", $msg);
					if($command[2] == 'here')
					{
						$tsAdmin -> clientMove($command[1], $config[5]['bot']['channel']);
						$sendmsg = "[b]Przeniesiono klienta[/b]";
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], $sendmsg);
					}
					else if(is_numeric($command[2]))
					{
						$tsAdmin -> clientMove($command[1], $command[2]);
						$sendmsg = "[b]Przeniesiono klienta[/b]";
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], $sendmsg);
					}
					$do = true;
				}
				
				//move to client
				
				if(strpos(strtoupper($msg), strtoupper("!move_to")) !== false && $do == false)
				{
					$command = explode(" ", $msg);
					if(isset($command[1]))
					{
						$clientlist = $tsAdmin->clientList();
						
						$client = array_search($command[1], array_column($clientlist['data'], 'client_nickname'));
						print_r($client['data']['cid']);
						if($client != false)
						{
							$client = $clientlist['data'][$client]['cid'];
							$tsAdmin -> clientMove($message['data']['invokerid'], $client);
						}
						else
						{
							$sendmsg = "[b]Nie znaleziono użytkownika[/b]";
							$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], $sendmsg);
						}
					}
					else
					{
						$sendmsg = "[b]Podaj nazwę użytkownika[/b]";
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], $sendmsg);
					}
					$do = true;
				}
				
				//meeting clients
				
				if(strpos(strtoupper($msg), strtoupper("!meeting_clients")) !== false && $do == false)
				{
					$command = explode(" ", $msg);
					if($command[1] == 'here')
					{
						$user = $tsAdmin->clientList("-uid -away -voice -times -groups -info -icon -country -ip -badges");
						foreach($user['data'] as $client)
						{
							if($client['client_database_id'] != 1)
							{
								if($client['clid'] != $message['data']['invokerid'])
								{
									$tsAdmin -> clientMove($client['clid'], $config[5]['bot']['channel']);
								}
								
							}
						}	
						$sendmsg = "[b]Przeniesiono użytkowników[/b]";
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], $sendmsg);
					}
					else if(is_numeric($command[1]))
					{
						$user = $tsAdmin->clientList("-uid -away -voice -times -groups -info -icon -country -ip -badges");
						foreach($user['data'] as $client)
						{
							if($client['client_database_id'] != 1)
							{
								if($client['clid'] != $message['data']['invokerid'])
								{
									$tsAdmin -> clientMove($client['clid'], $command[1]);
								}
							}
						}
						$sendmsg = "[b]Przeniesiono użytkowników[/b]";
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], $sendmsg);
					}
					$do = true;
				}
				
				//meeting admins
				
				if(strpos(strtoupper($msg), strtoupper("!meeting_admins")) !== false && $do == false)
				{
					$command = explode(" ", $msg);
					if($command[1] == 'here')
					{
						foreach($config[5]['bot']['admins_group'] as $group)
						{
							$groupclients = $tsAdmin->serverGroupClientList($group, $names = true);
							foreach($groupclients['data'] as $client)
							{
								$nick_array = $tsAdmin->clientFind($client['client_nickname']);
								if($nick_array['data'])
								{
									if($nick_array['data'][0]['clid'] != $message['data']['invokerid'])
									{
										$tsAdmin -> clientMove($nick_array['data'][0]['clid'], $config[5]['bot']['channel']);
									}
								}
							}
						}
						$sendmsg = "[b]Przeniesiono administratorów[/b]";
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], $sendmsg);
					}
					else if(is_numeric($command[1]))
					{
						foreach($config[5]['bot']['admins_group'] as $group)
						{
							$groupclients = $tsAdmin->serverGroupClientList($group, $names = true);
							foreach($groupclients['data'] as $client)
							{
								$nick_array = $tsAdmin->clientFind($client['client_nickname']);
								if($nick_array['data'])
								{
									if($client['client_nickname'] == $nick_array['data'][0]['client_nickname'])
									{
										if($nick_array['data'][0]['clid'] != $message['data']['invokerid'])
										{
											$tsAdmin -> clientMove($nick_array['data'][0]['clid'], $command[1]);
										}
									}
								}
							}
						}
						$sendmsg = "[b]Przeniesiono administratorów[/b]";
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], $sendmsg);
					}
					$do = true;
				}
				
				//poke
				
				if(strpos(strtoupper($msg), strtoupper("!poke")) !== false && $do == false)
				{
					$command = str_ireplace("!poke", "", $msg);
					$user = $tsAdmin->clientList("-uid -away -voice -times -groups -info -icon -country -ip -badges");
					foreach($user['data'] as $client)
					{
						if($client['client_database_id'] != 1)
						{
							if($client['clid'] != $message['data']['invokerid'])
							{
								$tsAdmin -> clientPoke($client['clid'], $command);
							}
						}
					}
					$sendmsg = "[b]Zaczepiono użytkowników[/b]";
					$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], $sendmsg);
					$do = true;
				}
				
				//message
				
				if(strpos(strtoupper($msg), strtoupper("!message")) !== false && $do == false)
				{
					$command = str_ireplace("!message", "", $msg);
					$user = $tsAdmin->clientList("-uid -away -voice -times -groups -info -icon -country -ip -badges");
					foreach($user['data'] as $client)
					{
						if($client['client_database_id'] != 1)
						{
							if($client['clid'] != $message['data']['invokerid'])
							{
								$tsAdmin -> sendMessage(1, $client['clid'], $command);
							}
						}
					}
					$sendmsg = "Wysłano wiadomość: [b]".$command."[/b]";
					$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], $sendmsg);
					$do = true;
				}
				
				//meeting group
				
				if(strpos(strtoupper($msg), strtoupper("!meeting_group")) !== false && $do == false)
				{
					$command = explode(" ", $msg);
					
					if($command[1] == 'here')
					{
						$groupclients = $tsAdmin->serverGroupClientList($command[1], $names = true);
						foreach($groupclients['data'] as $client)
						{
							$nick_array = $tsAdmin->clientFind($client['client_nickname']);
							if($nick_array['data'])
							{
								if($nick_array['data'][0]['clid'] != $message['data']['invokerid'])
								{
									$tsAdmin -> clientMove($nick_array['data'][0]['clid'], $command[2]);
								}
							}
						}
						$sendmsg = "[b]Przeniesiono[/b]";
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], $sendmsg);
					}
					else if(is_numeric($command[1]))
					{
						$groupclients = $tsAdmin->serverGroupClientList($command[1], $names = true);
						foreach($groupclients['data'] as $client)
						{
							$nick_array = $tsAdmin->clientFind($client['client_nickname']);
							if($nick_array['data'])
							{
								if($nick_array['data'][0]['clid'] != $message['data']['invokerid'])
								{
									$tsAdmin -> clientMove($nick_array['data'][0]['clid'], $command[2]);
								}
							}
						}
						$sendmsg = "[b]Przeniesiono[/b]";
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], $sendmsg);
					}
					$do = true;
				}
				
				//count online group client 
				
				if(strpos(strtoupper($msg), strtoupper("!cgroup")) !== false && $do == false)
				{
					$clients_online = 0;
					$clients_offline = 0;
					$all_clients = 0;
					$user = $tsAdmin->clientList("-uid -away -voice -times -groups -info -icon -country -ip -badges");
					//$takk = $tsAdmin->clientInfo(1);
					$nickk = $tsAdmin->clientFind('Klawy Dave');
					print_R($nickk);
					$command = explode(" ", $msg);
					
					if(is_numeric($command[1]))
					{
						$groupclients = $tsAdmin->serverGroupClientList($command[1], $names = true);
						foreach($groupclients['data'] as $client)
						{
							$nick_array = $tsAdmin->clientFind($client['client_nickname']);
							
							$is = array_search($client['cldbid'], array_column($user['data'], 'client_database_id'));
							
							if($is)
							{
								$clients_online++;
								echo $client['client_nickname']." ";
								echo $client['cldbid'];
							}
							else
							{
								$clients_offline++;
							}
							
						}
						$all_clients = $clients_offline + $clients_online;
						$sendmsg = "\n[b]Online: ".$clients_online."\nOffline: ".$clients_offline."\nŁącznie: ".$all_clients."[/b]";
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], $sendmsg);
					}
					unset($user);
					$do = true;
				}
				
				//ban
				
				if(strpos(strtoupper($msg), strtoupper("!addban")) !== false && $do == false)
				{
					$command = explode(" ", $msg);
					
					if(isset($command[1]) && isset($command[2]) && isset($command[3]))
					{
						$tsAdmin -> banAddByUid($command[1], $command[2], $command[3]);
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "Zbanowano");
					}
					else
					{
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "Podaj poprawne dane");
					}
					$do = true;
				}
				
				//ban delete
				
				if(strpos(strtoupper($msg), strtoupper("!delban")) !== false && $do == false)
				{
					$command = explode(" ", $msg);
					
					if(isset($command[1]))
					{
						$tsAdmin -> banDelete($command[1]);
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "Odbanowano");
					}
					else
					{
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "Podaj poprawne dane");
					}
					$do = true;
				}
				
				//bot refresh
				if(strpos(strtoupper($msg), strtoupper("!refresh")) !== false && $do == false)
				{
					if(strpos(strtoupper($msg), strtoupper("!refresh 1")) !== false)
					{
						shell_exec('./starter.sh restart1');
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "[b]Zresetowano 1 instancję[/b]");
					}
					else if(strpos(strtoupper($msg), strtoupper("!refresh 2")) !== false)
					{
						shell_exec('./starter.sh restart2');
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "[b]Zresetowano 2 instancję[/b]");
					}
					else if(strpos(strtoupper($msg), strtoupper("!refresh 3")) !== false)
					{
						shell_exec('./starter.sh restart3');
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "[b]Zresetowano 3 instancję[/b]");
					}
					else if(strpos(strtoupper($msg), strtoupper("!refresh 4")) !== false)
					{
						shell_exec('./starter.sh restart4');
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "[b]Zresetowano 4 instancję[/b]");
					}
					else if(strpos(strtoupper($msg), strtoupper("!refresh all")) !== false)
					{
						shell_exec('./starter.sh restart1');
						shell_exec('./starter.sh restart2');
						shell_exec('./starter.sh restart3');
						shell_exec('./starter.sh restart4');
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "[b]resetowano bota[/b]");
					}
					
					$do = true;
				}
				
				//bot stop
				if(strpos(strtoupper($msg), strtoupper("!stop")) !== false && $do == false)
				{
					if(strpos(strtoupper($msg), strtoupper("!stop 1")) !== false)
					{
						shell_exec('./starter.sh stop1');
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "[b]Zatrzymano 1 instancję[/b]");
					}
					else if(strpos(strtoupper($msg), strtoupper("!stop 2")) !== false)
					{
						shell_exec('./starter.sh stop2');
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "[b]Zatrzymano 2 instancję[/b]");
					}
					else if(strpos(strtoupper($msg), strtoupper("!stop 3")) !== false)
					{
						shell_exec('./starter.sh stop3');
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "[b]Zatrzymano 3 instancję[/b]");
					}
					else if(strpos(strtoupper($msg), strtoupper("!stop 4")) !== false)
					{
						shell_exec('./starter.sh stop4');
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "[b]Zatrzymano 4 instancję[/b]");
					}
					else if(strpos(strtoupper($msg), strtoupper("!stop all")) !== false)
					{
						shell_exec('./starter.sh stop1');
						shell_exec('./starter.sh stop2');
						shell_exec('./starter.sh stop3');
						shell_exec('./starter.sh stop4');
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "[b]Zatrzymano bota[/b]");
					}
					
					$do = true;
				}
				
				//bot start
				if(strpos(strtoupper($msg), strtoupper("!start")) !== false && $do == false)
				{
					if(strpos(strtoupper($msg), strtoupper("!start 1")) !== false)
					{
						shell_exec('./starter.sh start1');
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "[b]Włączono 1 instancję[/b]");
					}
					else if(strpos(strtoupper($msg), strtoupper("!start 2")) !== false)
					{
						shell_exec('./starter.sh start2');
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "[b]Włączono 2 instancję[/b]");
					}
					else if(strpos(strtoupper($msg), strtoupper("!start 3")) !== false)
					{
						shell_exec('./starter.sh start3');
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "[b]Włączono 3 instancję[/b]");
					}
					else if(strpos(strtoupper($msg), strtoupper("!start 4")) !== false)
					{
						shell_exec('./starter.sh start4');
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "[b]Włączono 4 instancję[/b]");
					}
					else if(strpos(strtoupper($msg), strtoupper("!start all")) !== false)
					{
						shell_exec('./starter.sh start1');
						shell_exec('./starter.sh start2');
						shell_exec('./starter.sh start3');
						shell_exec('./starter.sh start4');
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "[b]Włączono bota[/b]");
					}
					
					$do = true;
				}
				
				//delete msg to admin
				if(strpos(strtoupper($msg), strtoupper("!del_msg")) !== false && $do == false)
				{
					if($config['function']['helpchannel']['msgtoadminenable'])
					{
						$msg = str_ireplace("!del_msg", "", $msg);
						$msg = str_ireplace(" ", "", $msg);
						$connect = mysqli_connect($config[4]['database']['host'], $config[4]['database']['login'], $config[4]['database']['password'], $config[4]['database']['dbname']);
						if(is_int((int)$msg) && $msg != "")
						{	
							if($msg >= 1 && $msg <= $config['function']['helpchannel']['msgtoadminmax'])
							{
								$connect = mysqli_connect($config[4]['database']['host'], $config[4]['database']['login'], $config[4]['database']['password'], $config[4]['database']['dbname']);
								$desc = "[center][b][size=13][color=green]WIADOMOŚĆI DO ADMINISTRACJI[/color][/size][/b][/center]\n\n";
								$question = "DELETE FROM problems WHERE number = ".$msg;
								mysqli_query($connect, $question);
								
								$question = "UPDATE problems set number = number - 1 WHERE number > ".$msg;
								$problems = mysqli_query($connect, $question);
								
								$question = "SELECT nickname, DBID, UID, time, problem FROM problems ORDER BY number LIMIT ".$config['function']['helpchannel']['msgtoadminmax'];
								$problems = mysqli_query($connect, $question);
								
								$i = 1;	
								while($row=mysqli_fetch_array($problems))
								{
									$desc .= $i.". [b]Nick: [/b][URL=client://1/".$row['UID']."]".$row['nickname']."[/URL], [b]DBID:[/b] ".$row['DBID'].", [b]".date('H:i d.m.Y', $row['time'])."[/b]\n[b]Wiadomość:[/b] ".$row['problem']."[hr]\n";
									$i++;
								}
								$tsAdmin -> channelEdit($config['function']['helpchannel']['msgtoadminchannel'], Array('CHANNEL_DESCRIPTION'=> $desc.$footer));
								$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "[b]Usunięto ".$msg." wiadomość[/b]");
							} 
						}
						mysqli_close($connect);
					}
					else
					{
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], "[b]Wiadomości do administracji wyłączone[/b]");
					}
					$do = true;
				} 
				
				
				//log view
				if(strpos(strtoupper($msg), strtoupper("!log")) !== false && $do == false)
				{
					$msg = str_ireplace("!log", "", $msg);
					$msg = str_ireplace(" ", "", $msg);
					if(is_int((int)$msg) && $msg != "" && $msg > 0 & $msg <=100)
					{
						$logs = $tsAdmin -> logView($msg);
						foreach($logs['data'] as $log)
						{
							$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], $log['l']);
						}
					}
				}
				
				//fb
				if(strpos(strtoupper($msg), strtoupper("!fb")) !== false && $do == false)
				{
					
					//Set your App ID and App Secret.
					$appID = '1919742098329482';
					$appSecret = 'ab8ff6c2b3f9eee4ca6e3fcacc205942';
					
					//Create an access token using the APP ID and APP Secret.
					$accessToken = $appID . '|' . $appSecret;
					
					//The ID of the Facebook page in question.
					$id = '742851722717058';
					
					//Tie it all together to construct the URL
					$url = "http://graph.facebook.com/$id/posts?access_token=$accessToken";
					
					//Make the API call
					$result = file_get_contents($url);
					
					//Decode the JSON result.
					$decoded = json_decode($result, true);
					print_r($decoded);			
					
					
					$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], ".");
				}
				
				//test
				if(strpos(strtoupper($msg), strtoupper("!test")) !== false && $do == false)
				{
					//tablica z liczbami
					$tablica = Array(3,5,8,2,5,4,0,0,0,0,0,9,0,8,0,1,5,6,8,4,2,9,8,9,9,9,9);
					//Tablica w której zliczasz powtarzanie się
					$tab = Array(0 => 0,1 =>0,1 =>0,2 =>0,3 =>0,4 =>0,5 =>0,6 =>0,7 =>0,8 =>0,9 =>0);
					//Zliczanie
					foreach($tablica as $row)
					{
						$tab[$row] =  $tab[$row]+1;
					}
					//zmienna z najbardziej powtarzającą się liczbą
					$a = 0;
					//sprawdzanie czy dany element jest większy od $a, jeśli tak $a przyjmuje wartość bardziej powtaczającej się liczby
					for($i=0;$i<10;$i++)
					{
						if($tab[$i]>$tab[$a])
						{
							$a = $i;
						}
					}
					echo $a;
				
					//$version = file_get_contents("http://xtrust.pl/version.php");
					//echo $version;
					//$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], $version);
				}
				
				//channel group client list
				if(strpos(strtoupper($msg), strtoupper("!chgcl")) !== false && $do == false)
				{
					$msg = explode(" ", $msg);
					if(isset($msg[1]) && isset($msg[2]))
					{
						if($msg[1] == "cid")
						{
							if(is_int((int)$msg[2]) && $msg[2] != "")
							{
								$info = $tsAdmin ->channelGroupClientList($cid = $msg[2], $cldbid = NULL, $cgid = NULL);
							}
						}
						else if($msg[1] == "cldbid")
						{
							if(is_int((int)$msg[2]) && $msg[2] != "")
							{
								$info = $tsAdmin ->channelGroupClientList($cid = NULL, $cldbid = $msg[2], $cgid = NULL);
							}
						}
						else if($msg[1] == "cgid")
						{
							if(is_int((int)$msg[2]) && $msg[2] != "")
							{
								$info = $tsAdmin ->channelGroupClientList($cid = NULL, $cldbid = NULL, $cgid = $msg[2]);
							}
						}
						foreach($info['data'] as $key => $in)
						{
							$key++;
							$data = "\n";
						$client_info = $tsAdmin ->clientDbInfo($in['cldbid']);
						$data .= $key.".\n	Id kanału: ".$in['cid']."\n	User: [URL=client://1/".$client_info['data']['client_unique_identifier']."]".$client_info['data']['client_nickname']."[/URL] [".$client_info['data']['client_database_id']."]\n	Id grupy: ".$in['cgid']."\n";
						$tsAdmin -> sendMessage(2, $config[5]['bot']['channel'], $data);
						}
					}
				}
			}
		}
	}
	
	
	/* 
		[b]Wiadomość na serwer[/b]
		!msg_server [message]
		
		[b]Przeniesienie klienta[/b]
		!move_client [clientid] [channelid]
		
		[b]Przeniesienie do klienta[/b]
		!move_to[nick]
		
		[b]Przeniesienie wszystkich[/b]
		!meeting_clients [clientid] [channelid]
		
		[b]Przeniesienie adminów[/b]
		!meeting_admins [channelid]
		
		[b]Poke do wszystkich[/b]
		!poke [message]
		
		[b]Wiadomość do wszystkich[/b]
		!message [message]
		
		[b]Przeniesienie danej grupy[/b]
		!meeting_group [groupid] [channelid]
		
		[b]Liczenie osób z danej grupy[/b]
		!cgroup [groupid]
		
		[b]Lista użytkowników grupy kanałowej[/b]
		!cgcl ([cid], [cldbid], [cgid]) [number]
		
		[b]Zbanowanie[/b]
		!addban [uniqueid] [time] [reason]
		
		[b]Odbanowanie[/b]
		!delban [banid]
		
		[b]Reset bota[/b]
		!refresh [instance (or all)]
		
		[b]Zatrzymanie bota[/b]
		!stop [instance (or all)]
		
		[b]Włączenie bota[/b]
		!start [instance (or all)]
		
		[b]Usuwanie wiadomości[/b]
		!del_msg [number]
		
		[b]Logi[/b]
		!log [lines (1-100)] 
	*/
?>