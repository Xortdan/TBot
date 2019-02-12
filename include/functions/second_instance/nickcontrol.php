<?php 
function nickcontrol()
	{
		global $config;
		global $tsAdmin;
		global $user;
		global $language;
		
		foreach($user['data'] as $client)
		{
			$kick = false;
			$block = explode(",", $config['function']['nickcontrol']['block']);
			for($i=0; $i<count($block); $i++)
			{
				$find = strpos(strtoupper($client['client_nickname']), strtoupper($block[$i]));
				if($find  !== false)
				{
					$kick = true;
					break;
				}
			}
			
			if($kick == true)
			{
				$tsAdmin->clientKick($client['clid'], "server", $config['function']['nickcontrol']['message']);	
			}
			
		} 
		unset($kick);
		unset($block);
		unset($find);
	}
?>