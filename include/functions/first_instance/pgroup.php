<?php 
function pgroup()
	{
		global $config;
		global $tsAdmin;
		global $serverInfo;
		global $user;
		$countgroup = $config['function']['pgroup']['allgroup'];
		$online = $serverInfo['virtualserver_clientsonline'];

		foreach($user['data'] as $client)
		{
			$groupclient = explode(',', $client['client_servergroups']);	
			foreach($groupclient as $group)
			{	
				for($r=0; $r<count($countgroup); $r++)
				{
					if($group == $countgroup[$r])
					{
						$tsAdmin->clientPoke($client['clid'], $config['function']['pgroup']['message'][$countgroup[$r]]);
					}
				}
			}  	
		}
	}
?>