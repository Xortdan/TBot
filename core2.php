<?php
require_once("include/lib/ts3admin.class.php");
require_once("include/configs/config.php");
require_once("include/functions/functions.php");
require_once("include/language/".$config['bot']['laguage'].".php");

global $serverInfo;	
global $online;
global $user;
global $channels;
global $groups;
global $footer;
$footer = "[hr][right][i]".$version."[/i][/right][hr] [right][url=https://xtrust.pl][img]https://xtrust.pl/bannerbot.png[/img][/url]";
$instance_number = str_replace("core", "", $_SERVER['SCRIPT_NAME']);
$instance_number = str_replace(".php", "", $instance_number);
$instance_number = (int) $instance_number;
$instance_enable = 0;
if($config[$instance_number]['enable'])
{
	$tsAdmin = new ts3admin($config[$instance_number]['server']['ip'], $config[$instance_number]['server']['queryport']);
	if($tsAdmin->getElement('success', $tsAdmin->connect()))
	{
		echo "Bot połączony pomyślnie\n\n";
		$tsAdmin->login($config[$instance_number]['query']['login'], $config[$instance_number]['query']['password']);
		$tsAdmin->selectServer($config[$instance_number]['server']['port']);
		$tsAdmin->setName("xTrustBot ".$config[$instance_number]['bot']['name']);
		$whoami = $tsAdmin->getElement('data', $tsAdmin->whoAmI());
		$tsAdmin->clientMove($whoami['client_id'] , $config[$instance_number]['bot']['channel']);	

		$instance = count($config[$instance_number]['functions']);
		for($i=0; $i<$instance; $i++)
		{
			$function_name = $config[$instance_number]['functions'][$i];
			if($config['function'][$function_name]['enable']==true) 
			{
				$instance_enable++;
			}
		}
		
		echo "/\/\ Instancja nr. ".$instance_number."\n";
		echo "/\/\ Aktywnych funkcji: ".$instance_enable."\n";
		
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