<?php 
function antyrecording()
	{
		global $config;
		global $tsAdmin;
		global $user;
		global $footer;
		global $language;
		
		foreach($user['data'] as $client)
		{
			if($client['client_is_recording'] == 1)
			{
				if($config['function']['antyrecording']['mode'] == 1)
				$tsAdmin->clientPoke($client['clid'], $config['function']['antyrecording']['message']);
				else
				$tsAdmin->clientKick($client['clid'], "server", $config['function']['antyrecording']['message']);	
			}
			
		 } 
	}
?>