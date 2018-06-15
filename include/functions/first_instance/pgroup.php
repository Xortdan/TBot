<?php 
function pgroup()
	{
		global $config;
		global $tsAdmin;
		global $serverInfo;
		$countgroup = $config['function']['pgroup']['allgroup'];
		$online = $serverInfo['virtualserver_clientsonline'];

		for($i=0; $i<$online; $i++)
		{
			$user = $tsAdmin->clientList("-groups");
			$user = $user['data'][$i];
			$groupclient = explode(',', $user['client_servergroups']);	
			count($groupclient);
			for($e=0; $e<count($groupclient); $e++)
			{	
				for($r=0; $r<count($countgroup); $r++)
				{
					if($groupclient[$e] == $countgroup[$r])
					{
						echo "tak";
						$tsAdmin->clientPoke($user['clid'], $config['function']['pgroup']['message'][$countgroup[$r]]);
					}
				}
			}  	
		}
	}
?>