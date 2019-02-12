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
	global $useruptime;
	$datazero_group_icon = '1970-01-01 00:00:00';
	$useruptime = Array();
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
			▀▀█▀▀ █▀▀▄ █▀▀█ ▀▀█▀▀   █▀█
			░░█░░ █▀▀▄ █░░█ ░░█░░   ░▄▀
			░░▀░░ ▀▀▀░ ▀▀▀▀ ░░▀░░   █▄▄
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
			echo "\n\nWykorzystanie ramu: \n";
			while(true)
			{
				$loopdate = date('Y-m-d G:i:s');
				
				$serverInfo = $tsAdmin->getElement('data', $tsAdmin->serverInfo());
				$online = $serverInfo['virtualserver_clientsonline'] - $serverInfo['virtualserver_queryclientsonline'];
				$user = $tsAdmin->clientList("-uid -away -voice -times -groups -info -icon -country -ip -badges");
				$channels = $tsAdmin->channelList("-topic -flags -voice -limits -icon -secondsempty");
				$groups = $tsAdmin->serverGroupList();
				
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
						$ff = fopen("include/cache/instance_info/core2.txt", "w+");
						fputs($ff, $instance_info);
						fclose($ff);
						echo date('H:i d.m.Y')." - ".$ram." MB\n";
					}
				}
				
				
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
				if(ready($loopdate, $datazero_group_icon, 3600) == true)
				{
					if($config[2]['bot']['icons']['enable'])
					{
						$files = glob($config[2]['bot']['icons']['localization'].'*');
						foreach($files as $file)
						{
							if(is_file($file))
							unlink($file);
						}
						foreach($groups['data'] as $group)
						{
							$group_icon = $tsAdmin->getIconByID($group['iconid']);
							if(!empty($group_icon['data']))
							{
								$base = $group_icon['data'];
								$img = base64_decode($base);
								$flie_name = $config[2]['bot']['icons']['localization'].$group['sgid'].".png";
								file_put_contents($flie_name, $img);
							}
						} 
						$datazero_group_icon = $loopdate;
					} 
				}
				
				
				sleep($config[$instance_number]['bot']['speed']);
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