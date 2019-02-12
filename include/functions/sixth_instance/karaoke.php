<?php
function isAdmin($cid)
	{
		global $config;
		global $tsAdmin;
		$client = $tsAdmin -> clientInfo($cid);
		$groupclient = explode(',', $client['data']['client_servergroups']);
		foreach($config[5]['bot']['admins_bot'] as $admingroup)
		{
			$grou = array_search($admingroup, $groupclient);
			if(is_numeric($grou))
			{
				$isadmin = true;
				break;
			}
			else 
			{
				$isadmin = false;
			}
		}
		return $isadmin;
	}


function karaoke()
{
	global $footer;
	global $config;
	global $tsAdmin;
	global $user;
	global $admins;

	$connect = mysqli_connect($config[4]['database']['host'], $config[4]['database']['login'], $config[4]['database']['password'], $config[4]['database']['dbname']);

		
	$message = $tsAdmin -> readChatMessage('textchannel', true, $config[6]['bot']['channel'], 99999);
		
	$msg = $message['data']['msg'];
	if($msg != NULL)
	{
		if(strpos(strtoupper($msg), strtoupper("!start karaoke")) !== false && isAdmin($message['data']['invokerid']))
		{
				$tsAdmin -> sendMessage(2, $config[6]['bot']['channel'], "[b]Dodaj administrację[/b]");
				$create_table = true;
				$add_amins = true;
				while($create_table)
				{
					while($add_amins)
					{
						$message = $tsAdmin -> readChatMessage('textchannel', true, $config[6]['bot']['channel'], 99999);
						$msg = $message['data']['msg'];
						if(strpos(strtoupper($msg), strtoupper("!add ")) !== false && isAdmin($message['data']['invokerid']))
						{
							$admin_uid = str_ireplace("!add ", "", $msg);
							$user = $tsAdmin->clientList("-uid -away -voice -times -groups -info -icon -country -ip -badges");
							$find_admin = array_search($admin_uid, array_column($user['data'], 'client_unique_identifier'));
							if($find_admin != false)
							{
								$admins[] = $admin_uid;
								$tsAdmin -> sendMessage(2, $config[6]['bot']['channel'], "[b]Dodano [/b]".$user['data'][$find_admin]['client_nickname']);
							}
							else
							{
								$tsAdmin -> sendMessage(2, $config[6]['bot']['channel'], "[b]Nie dodano [/b]".$admin_uid);
							}
						}
						if(strpos(strtoupper($msg), strtoupper("!add end")) !== false)
						{
							$add_amins = false;
							$tsAdmin -> sendMessage(2, $config[6]['bot']['channel'], "[b]Zakończono[/b]");
							
						}
					}
					if(count($admins)>0)
					{
$question = "CREATE TABLE `event_karaoke` (
`id` int(6) UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
`number` int(6) NOT NULL,
`nickname` varchar(30) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
`DBID` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,\n";

						foreach($admins as $admin)
						{
							$question .= "`".$admin."` int(2) NOT NULL,\n";
						}
	
						$question .= "`count` int(6) NOT NULL);";
						mysqli_query($connect, $question);	
						$tsAdmin -> sendMessage(2, $config[6]['bot']['channel'], "[b]Uwtorzono bazę[/b]");	
						$create_table = false;						
					}
					else
					{
						$tsAdmin -> sendMessage(2, $config[6]['bot']['channel'], "[b]Dodaj administrację[/b]");	
					}
				}
				$play = true;
				$player = 0;
				while($play)	
				{
					$message = $tsAdmin -> readChatMessage('textchannel', true, $config[6]['bot']['channel'], 99999);
					$msg = $message['data']['msg'];
					if($msg != NULL)
					{
						if(strpos(strtoupper($msg), strtoupper("!add ")) !== false && isAdmin($message['data']['invokerid']))
						{
							$user_dbid = str_ireplace("!add ", "", $msg);
							$user = $tsAdmin->clientList("-uid -away -voice -times -groups -info -icon -country -ip -badges");
							$find_user = array_search($user_dbid, array_column($user['data'], 'client_database_id'));
							
							if($find_user != false)
							{
								$player++;
								$question = "INSERT INTO event_karaoke(`number`, `nickname`, `DBID`) VALUES(".$player.", '".$user['data'][$find_user]['client_nickname']."',".$user['data'][$find_user]['client_database_id'].")";
								mysqli_query($connect, $question);
								$tsAdmin -> sendMessage(2, $config[6]['bot']['channel'], "[b]Dodano [/b]".$user['data'][$find_user]['client_nickname']);
								$rating = true;
								while($rating)
								{
									$message = $tsAdmin -> readChatMessage('textchannel', true, $config[6]['bot']['channel'], 99999);
									$msg = $message['data']['msg'];
									
									if(strpos(strtoupper($msg), strtoupper("!give ")) !== false)
									{
										$question = "SELECT `".$message['data']['invokeruid']."` FROM event_karaoke";
										$rate = mysqli_query($connect, $question);
										if(!empty($rate))
										{
											$msg = str_ireplace("!give ", "", $msg);
											$question = "UPDATE event_karaoke set `".$message['data']['invokeruid']."` = ".$msg." WHERE number = ".$player;
											mysqli_query($connect, $question);
											$user = $tsAdmin->clientList("-uid -away -voice -times -groups -info -icon -country -ip -badges");
											$tsAdmin -> sendMessage(2, $config[6]['bot']['channel'], "[b]Ocena od ".$user['data'][array_search($message['data']['invokeruid'], array_column($user['data'], 'client_unique_identifier'))]['client_nickname']."[/b]: ".$msg);
										}
									}
									else if(strpos(strtoupper($msg), strtoupper("!next")) !== false && isAdmin($message['data']['invokerid']))
									{
										$rating = false;
										$tsAdmin -> sendMessage(2, $config[6]['bot']['channel'], "[b]Dodaj kolejną osobę[/b]");
										
										$question = "SELECT * FROM event_karaoke WHERE number = ".$player;
										$question = mysqli_query($connect, $question);
										$question = mysqli_fetch_array($question);
										$count = 0;
										foreach($admins as $admin)
										{
											$count = $count + $question[$admin];
										}
										$question = "UPDATE event_karaoke set count = ".$count." WHERE number = ".$player;
										mysqli_query($connect, $question);
									}
									else if(strpos(strtoupper($msg), strtoupper("!gg")) !== false && isAdmin($message['data']['invokerid']))
									{
										$rating = false;
										$play = false;
										$question = "SELECT * FROM event_karaoke WHERE number = ".$player;
										$question = mysqli_query($connect, $question);
										$question = mysqli_fetch_array($question);
										$count = 0;
										foreach($admins as $admin)
										{
											$count = $count + $question[$admin];
										}
										$question = "UPDATE event_karaoke set count = ".$count." WHERE number = ".$player;
										mysqli_query($connect, $question);
									}
									else
									{
										$tsAdmin -> sendMessage(2, $config[6]['bot']['channel'], "[b]Dodaj poprawną ocenę[/b]");
									}
								}
							}
							else
							{
								$tsAdmin -> sendMessage(2, $config[6]['bot']['channel'], "[b]Nie znaleziono użytkownika[/b]");
							}
						}
					}
				}
				$list = "\n";
				$tsAdmin -> sendMessage(2, $config[6]['bot']['channel'], "[b]KONIEC[/b]\n");
				$result = mysqli_query($connect, "SELECT * FROM event_karaoke ORDER BY count DESC");
				while($raw = mysqli_fetch_array($result))
				{
					$list .= "[b]".$raw['nickname']."[/b] - ".$raw['count']."\n"; 
					$tsAdmin -> sendMessage(2, $config[6]['bot']['channel'], "$list");
				}
		}
		else if(strpos(strtoupper($msg), strtoupper("!del db")) !== false && isAdmin($message['data']['invokerid']))
		{
			mysqli_query($connect, "DROP TABLE event_karaoke");
			$tsAdmin -> sendMessage(2, $config[6]['bot']['channel'], "[b]Usunięto bazę[/b]");				
		}
			
	}
		
		mysqli_close($connect);
	}
	
?> 