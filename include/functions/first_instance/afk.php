<?php 
function afk()
	{
		global $config;
		global $tsAdmin;
		global $online;
		global $user;
		
		
		foreach($user['data'] as $client)
		{
			//print_r($client);
			$idle_sec=$client['client_idle_time']/1;
			$idle_sec = floor($idle_sec);
			if($idle_sec>$config['function']['afk']['idletime'])
			{
				if($config['function']['afk']['mode'] == 1)
				{
					$tsAdmin->clientMove($client['clid'], $config['function']['afk']['idlechannel']);
				}
				else if($config['function']['afk']['mode'] == 2)
				{
					$tsAdmin->serverGroupAddClient($config['function']['afk']['afkgroup'], $client['client_database_id']);
				}
			}
			else
			{
				$tsAdmin->serverGroupDeleteClient($config['function']['afk']['afkgroup'], $client['client_database_id']);
			}	
		} 
	}
?>