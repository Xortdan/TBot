<?php 
function pgroup()
	{
		global $config;
		global $tsAdmin;
		global $serverInfo;
		global $user;
		$online = $serverInfo['virtualserver_clientsonline'];
		
		foreach($user['data'] as $client)
		{
			$groupclient = explode(',', $client['client_servergroups']);	
			foreach($groupclient as $group)
			{	
				foreach($config['function']['pgroup']['info'] as $channel)
				{
					if($group == $channel['group'])
					{
						$tsAdmin->clientPoke($client['clid'], $channel['message']);
					}
				}
			}  	
		} 
	}
?>