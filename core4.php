<?php
	require_once("include/lib/ts3admin.class.php");
	require_once("include/configs/config.php");
	require_once("include/functions/functions.php");
	require_once("include/language/".$config['bot']['laguage'].".php");
	require_once("include/cache/version.php");
	
	global $serverInfo;	
	global $online;
	global $user;
	global $channels;
	global $groups;
	global $footer;
	global $config;
	global $connect;
	$datazero_banlist = '1970-01-01 00:00:00';
	$datazero_server_usage = '1970-01-01 00:00:00';
	$datazero_res_stats = '1970-01-01 00:00:00';
	$datazero_client_info = '1970-01-01 00:00:00';
	$datazero_group = '1970-01-01 00:00:00';
	$idletime = $config[4]['bot']['idletime']*60000;
	$checktime = time();
	$footer = "\n\n[hr][right][i]".$version."[/i][/right][hr] [right][url=https://xtrust.pl][img]https://xtrust.pl/botbanner.png[/img][/url]";
	$instance_number = str_replace("core", "", $_SERVER['SCRIPT_NAME']);
	$instance_number = str_replace(".php", "", $instance_number);
	$instance_number = (int) $instance_number;
	$functions_enable = 0;
	if($config[$instance_number]['enable'])
	{
		$tsAdmin = new ts3admin($config[$instance_number]['server']['ip'], $config[$instance_number]['server']['queryport']);
		if($tsAdmin->getElement('success', $tsAdmin->connect()))
		{
			echo "
			\e[1m \e[32m 
			▀▀█▀▀ █▀▀▄ █▀▀█ ▀▀█▀▀   ░█▀█░
			░░█░░ █▀▀▄ █░░█ ░░█░░   █▄▄█▄
			░░▀░░ ▀▀▀░ ▀▀▀▀ ░░▀░░   ░░░█░
			\e[0m
			";
			
			echo "Bot połączony pomyślnie\n\n";
			$tsAdmin->login($config[$instance_number]['query']['login'], $config[$instance_number]['query']['password']);
			$tsAdmin->selectServer($config[$instance_number]['server']['port']);
			$tsAdmin->setName("Tbot ".$config[$instance_number]['bot']['name']);
			$whoami = $tsAdmin->getElement('data', $tsAdmin->whoAmI());
			if($config[1]['server']['defaultchannel'] != $config[$instance_number]['bot']['channel'])
			{
				$tsAdmin->clientMove($whoami['client_id'] , $config[$instance_number]['bot']['channel']);	
			}	
			
			$instance = count($config[$instance_number]['functions']);
			for($i=0; $i<$instance; $i++)
			{
				$function_name = $config[$instance_number]['functions'][$i];
				if($config['function'][$function_name]['enable']==true) 
				{
					$functions_enable++;
				}
			}
			
			echo "/\/\ Instancja nr. ".$instance_number."\n";
			echo "/\/\ Aktywnych funkcji: ".$functions_enable."\n";
			
			function intervaltosecond($interval) 
			{
				$interval['hours']+= $interval['days']*24;
				$interval['minutes']+= $interval['hours']*60;
				$interval['seconds']+= $interval['minutes']*60;
				return $interval['seconds'];
			}
			
			function ready($data1, $data2, $interval) 
			{
				if((strtotime($data1) - strtotime($data2)) >= $interval) 
				{
					$now = true;
				}
				else 
				{
					$now  = false;
				}
				return $now;
			}
			
			$connect = mysqli_connect($config[4]['database']['host'], $config[4]['database']['login'], $config[4]['database']['password']);
			if (mysqli_connect_errno())
			{
				echo "Niepoprawne dane logowania do bazy danych";
				return;
			}
			else
			{
				mysqli_select_db($connect, $config[4]['database']['dbname']);
				$connect_error = mysqli_error($connect);
				if($connect_error != "")
				{
					echo 'Nie znaleziono bazy danych o nazwie "'.$config[4]['database']['dbname'].'"';
					$question = "CREATE DATABASE ".$config[4]['database']['dbname'];
					mysqli_query($connect, $question);
					mysqli_select_db($connect, $config[4]['database']['dbname']);
					$sql_file = file_get_contents('include/cache/ts_db.sql');
					mysqli_multi_query($connect,$sql_file);
					echo "\nUtworzono bazę";
					mysqli_close($connect);
					sleep(1);
					$connect = mysqli_connect($config[4]['database']['host'], $config[4]['database']['login'], $config[4]['database']['password'], $config[4]['database']['dbname']);
				}
				echo "\n\nWykorzystanie ramu: \n";
				while(true)
				{
					$time1 = microtime(true);
					$loopdate = date('Y-m-d G:i:s');
					
					if($config['bot']['loop']['enable']==true)
					{
						if(ready($loopdate, $config['bot']['loop']['datazero'], intervaltosecond($config['bot']['loop']['interval'])) == true)
						{
							loop();
							$config['bot']['loop']['datazero'] = $loopdate;
							
							$instance_info = "";
							$ram =  memory_get_usage(false);
							$ram = round($ram/1024/1024, 2);
							$instance_info = $ram.",".$functions_enable;
							$ff = fopen("include/cache/instance_info/core4.txt", "w+");
							fputs($ff, $instance_info);
							fclose($ff);
							echo date('H:i d.m.Y')." - ".$ram." MB\n";
						}
					}
					
					$serverInfo = $tsAdmin->getElement('data', $tsAdmin->serverInfo());
					$online = $serverInfo['virtualserver_clientsonline'] - $serverInfo['virtualserver_queryclientsonline'];
					$user = $tsAdmin->clientList("-uid -away -voice -times -groups -info -icon -country -ip -badges");
					$channels = $tsAdmin->channelList("-topic -flags -voice -limits -icon -secondsempty");
					$groups = $tsAdmin->serverGroupList();
					
					
					//res stats	
					if(ready($loopdate, $datazero_res_stats, 1800) == true)
					{	
						$dateweek = date("N");
						$datemonth = date("n");
						$res_stats = mysqli_query($connect, "SELECT week, month FROM res_stats WHERE id = 1");	
						$res_stats = mysqli_fetch_array($res_stats);
						if($res_stats['month'] != $datemonth)
						{
							mysqli_query($connect, "UPDATE user_stats set idle_month = 0, active_month = 0, time_month = 0 WHERE id = 1");
							$question = "UPDATE res_stats set month = ".$datemonth." WHERE id = 1";
							mysqli_query($connect, $question);
						}
						
						if($dateweek != 1)
						{
							mysqli_query($connect, "UPDATE res_stats set week = 1 WHERE id = 1");
						}
						else if(($res_stats['week'] == 1) && ($dateweek == 1))
						{
							mysqli_query($connect, "UPDATE res_stats set week = 0 WHERE id = 1");
							mysqli_query($connect, "UPDATE user_stats set idle_week = 0, active_week = 0, time_week = 0");
						}
						$datazero_res_stats = $loopdate;
					}
					//client info		
					if(ready($loopdate, $datazero_client_info, 10) == true)
					{
						foreach($user['data'] as $client)
						{
							$clientinfo = $tsAdmin->clientInfo($client['clid']);
							if($client['client_database_id'] != 1 && $client['client_unique_identifier'] != "ServerQuery")
							{
								$channel_list = "";
								$question = "SELECT * FROM user_stats WHERE DBID = ".$client['client_database_id'];
								$finduser = mysqli_query($connect, $question);
								
								if(mysqli_num_rows($finduser) == 0)
								{
									$question = "INSERT INTO user_stats (nickname, UID, DBID, CLID, ip, last_seen, connections, online, online_time, idle, idle_week, idle_month, idle_all, active_week, active_month, active_all, time_week, time_month, time_all) VALUES ('".$client['client_nickname']."', '".$client[	'client_unique_identifier']."', ".$client['client_database_id'].", ".$client['clid'].",'".$client['connection_client_ip']."' ,".time().", ".$clientinfo['data']['client_totalconnections']." , 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)";
									mysqli_query($connect, $question);
									$question = "SELECT * FROM user_stats WHERE DBID = ".$client['client_database_id'];
									$finduser = mysqli_query($connect, $question);
								}
								
								
								$userinfo = mysqli_fetch_array($finduser);
								
								if($userinfo['online_record'] < $userinfo['online_time'])
								{
									$question = "UPDATE user_stats set online_record = ".$userinfo['online_time']." WHERE DBID = ".$client['client_database_id'];
									mysqli_query($connect, $question);
								}
								
								$channel_id = array_keys(array_column($channels['data'], 'cid'),  $client['cid']);
								
								$channel_name = str_replace("[spacer]", "", $channels['data'][$channel_id[0]]['channel_name']);
								$channel_name = str_replace("[cspacer]", "", $channels['data'][$channel_id[0]]['channel_name']);
								
								$channels_list = $tsAdmin->channelGroupClientList($cid = NULL, $cldbid = $client['client_database_id'], $cgid = $config[4]['bot']['channel_admin_group']);
								if(!isset($channels_list['errors'][0]))
								{
									foreach($channels_list['data'] as $channel)
									{
										$channel_list .= $channel['cid'].",";
									}
									$channel_list = substr($channel_list, 0, strlen($channel_list)-1);
								}
								
								$addtime = time() - $checktime;
								if($client['client_idle_time'] < $idletime)
								{
									$question = "UPDATE user_stats set ip = '".md5($client['connection_client_ip'])."', nickname = '".$client['client_nickname']."', connections = ".$clientinfo['data']['client_totalconnections'].", online = 1, CLID = ".$client['clid'].", online_time = online_time + ".$addtime.", idle = 0, active_week = active_week + ".$addtime.", active_month = active_month + ".$addtime.", active_all = active_all + ".$addtime.", time_week = time_week + ".$addtime.", time_month = time_month + ".$addtime.", time_all = time_all + ".$addtime.", last_seen = ".time().", channel = '".$channel_name."', channel_id = ".$client['cid'].", admin_on_channels = '".$channel_list."' WHERE DBID = ".$client['client_database_id'];
									mysqli_query($connect, $question);
									
								}
								else
								{
									$question = "UPDATE user_stats set ip = '".md5($client['connection_client_ip'])."', nickname = '".$client['client_nickname']."',  connections = ".$clientinfo['data']['client_totalconnections'].", online = 1, CLID = ".$client['clid'].", online_time = online_time + ".$addtime.", idle = 1, idle_week = idle_week + ".$addtime.", idle_month = idle_month + ".$addtime.", idle_all = idle_all + ".$addtime.", time_week = time_week + ".$addtime.", time_month = time_month + ".$addtime.", time_all = time_all + ".$addtime.", last_seen = ".time().", channel = '".$channel_name."', channel_id = ".$client['cid'].", admin_on_channels = '".$channel_list."' WHERE DBID = ".$client['client_database_id'];
									mysqli_query($connect, $question);
									
								}
							}
							
							
						}
						//channels list				
						$channel_id = 1;
						mysqli_query($connect, "DELETE FROM channels");
						$question = "INSERT INTO `channels` (`id`, `CID`, `PID`, `channel_name`, `channel_desc`) VALUES ";
						foreach($channels['data'] as $channel)
						{
							$channel_name = str_replace("'", "&lsquo;", $channel['channel_name']);
							$channel_info = $tsAdmin->channelInfo($channel['cid']);
							$channel_description = str_replace("'", "&lsquo;", $channel_info['data']['channel_description']);
							$question .= "('".$channel_id."', '".$channel['cid']."', '".$channel['pid']."', '".$channel_name."', '".$channel_description."'),";
							$channel_id++;
						}
						$question = substr($question, 0, strlen($question)-1);
						mysqli_query($connect, $question);
						
						$erorrr = mysqli_error($connect);
						print_r($erorrr);
						
						
						$checktime = time();
						$datazero_client_info = $loopdate;
					}
					
					//user status				
					$userstatus = mysqli_query($connect, "SELECT nickname, online, idle, DBID FROM user_stats WHERE online = 1");
					$user_check_status = Array();
					$user_check_DBID = "";
					$change_status = false;
					while($clientinfo = mysqli_fetch_array($userstatus))
					{
						$user_check_status[] = Array($clientinfo['DBID'], $clientinfo['nickname']);
						$clientdb = $tsAdmin->clientFind($clientinfo['nickname']);
					}
					foreach($user_check_status as $client)
					{
						$find_user = in_array($client[1], array_column($user['data'], 'client_nickname'));
						if(!$find_user)
						{
							$user_check_DBID .= "DBID = ".$client[0]." OR ";
							$change_status = true;
						}
					}
					if($change_status)
					{
						$question = "UPDATE user_stats set online_time = 0, idle = 0, online = 0, CLID = 0, channel = '', channel_id = 0  WHERE ".$user_check_DBID;
						$question = substr($question, 0, strlen($question)-3);
						mysqli_query($connect, $question);
						$change_status = false;
					}
					
					//ban list				
					if(ready($loopdate, $datazero_banlist, 900) == true)
					{
						mysqli_query($connect, "DELETE FROM bans_list");
						
						$blist = $tsAdmin->banList();
						if(!empty($blist['data']))
						{
							foreach($blist['data'] as $ban)
							{
								if(!empty($ban['lastnickname']))
								{
									$banduration = $ban['duration']+$ban['created'];
									$question = "INSERT INTO bans_list(name_banned, reason, name_by, date_banned, date_delete) VALUES ('".$ban['lastnickname']."', '".$ban['reason']."', '".$ban['invokername']."', ".$ban['created'].", ".$banduration.")";
									mysqli_query($connect, $question);
								}
							}
						}
						$datazero_banlist = $loopdate;
					}
					
					if(ready($loopdate, $datazero_server_usage, 5) == true)
					{
						//server usage	
						$last_check = mysqli_query($connect, "Select * FROM server_usage ORDER BY time DESC LIMIT 1");
						$last_check = mysqli_fetch_array($last_check);
						if(($last_check['time'] + 900) <= time())
						{
							$question = "INSERT INTO server_usage(time, clients) VALUES (".time().", ".$online.")";
							mysqli_query($connect, $question);
						}	
						
						
						//server info
						$list_admins = "";
						foreach($config[4]['bot']['admins_group'] as $group)
						{
							$group_icon = array_keys(array_column($groups['data'], 'sgid'), $group);
							$group_icon =  $tsAdmin->getIconByID($groups['data'][$group_icon[0]]['iconid']);
							$groupname = groupname($group);
							$list_admins .= "<p class='h1_admin'> <img src='data:image/png;base64,".$group_icon['data']."'/> ".$groupname."</p>";
							$group_clients = $tsAdmin->serverGroupClientList($group, $names = true);
							$count_clients = count($group_clients['data']);
							
							foreach($group_clients['data'] as $client)
							{
								$nick = $client['client_nickname'];
								$nick_array = $tsAdmin->clientFind($nick);
								
								if($nick_array['data'])
								{
									$list_admins .= "<p>".$nick."<span style='background-color:green'>Online</span>";
								}
								else
								{
									$list_admins .= "<p>".$nick."<span style='background-color: #c70000'>Offline</span>";
								}	
							}
						}
						
						$question = 'UPDATE server_info set online = "'.$online.'", max_clients = '.$serverInfo['virtualserver_maxclients'].', uptime = '.$serverInfo['virtualserver_uptime'].', ping = '.round($serverInfo['virtualserver_total_ping']).', loss = '.round($serverInfo['virtualserver_total_packetloss_total']).', admins_list = "'.$list_admins.'" WHERE id = 1';
						mysqli_query($connect, $question);
						$datazero_server_usage = $loopdate;
					};
					
					//group
					if(ready($loopdate, $datazero_group, 1800) == true)
					{	
						mysqli_query($connect, "DELETE FROM server_groups");
						$group_id = 1;
						foreach($groups['data'] as $group)
						{
							$group_icon =  $tsAdmin->getIconByID($group['iconid']);
							$question ="INSERT INTO `server_groups` (`id`, `id_group`, `name`, `icon`) VALUES ('".$group_id."', '".$group['sgid']."', '".$group['name']."', '".$group_icon['data']."')";
							mysqli_query($connect, $question);
							$group_id++;
						}
						$datazero_group = $loopdate;
					}
					
					//command
					$question = 'SELECT * FROM commands';	
					$commands = mysqli_query($connect, $question);
					
					if(mysqli_num_rows($commands) > 0)
					{
						while($row=mysqli_fetch_array($commands))
						{
							if($row['type'] == 1)
							{
								$tsAdmin->sendMessage(1, $row['CLID'],  $row['command']);
							}
							else if($row['type'] == 2)
							{
								$tsAdmin->channelEdit($row['CID'], array
								(
								'channel_name' => $row['channel_name']
								));
								$tsAdmin->channelEdit($row['CID'], array
								(
								'channel_description' => $row['channel_desc']
								));
							}
							else if($row['type'] == 3)
							{
								$tsAdmin->sendMessage(1, $row['CLID'], $row['command']);
							}
							
							mysqli_query($connect, "DELETE FROM commands WHERE id= {$row['id']}");
						}
					}
					/* 
						Wyślij wiadomość: 
						type - 1
						CLID- clid
						command - wiadomość
						Edytuj kanał:
						type - 2
						CID-cid
						channel_desc - opis kanału
						
						
						
					*/
					
					$instance = count($config[$instance_number]['functions']);
					for($i=0; $i<$instance; $i++)
					{
						$function_name = $config[$instance_number]['functions'][$i];
						if($config['function'][$function_name]['enable']==true) 
						{
							if(ready($loopdate, $config['function'][$function_name]['datazero'], intervaltosecond($config['function'][$function_name]['interval'])) == true)
							{
								$function_name();
								$config['function'][$function_name]['datazero'] = $loopdate;
							}
						}
					}						
					
					$time2 = microtime(true);
					echo $time2 - $time1;
					echo "\n";
					
					sleep($config[$instance_number]['bot']['speed']);
				}
			}
			
		}	
		else
		{
			echo "Problem z połączeniem \n";
		}
	}
	else
	{
		echo "/\/\ Instancja nr. ".$instance_number." wyłączona\n";
	}
?>
