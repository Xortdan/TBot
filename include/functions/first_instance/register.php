<?php 
function register()
	{
		global $tsAdmin;
		global $config;
		$isregister = 0;
		foreach($config['function']['register']['allchannel'] as $channel)
		{
			$user=$tsAdmin->channelClientList($channel, '-groups -uid');
			if(isset($user['data'][0]))
			{
				$clid=$user['data']['0']['clid'];
				$grou = $config['function']['register']['info'][$channel];
				$dbid=$user['data']['0']['client_database_id'];
				$groupclient = explode(',', $user['data'][0]['client_servergroups']);
				foreach($groupclient as $group)
				{
					if(in_array($group, $config['function']['register']['allgroup']))	
					{
						$isregister = 1;
						$tsAdmin->clientKick($clid, "channel");	
						$tsAdmin->clientPoke($clid, "Jesteś już zarejestrowany(a)");
					}
				}
				if($isregister==0)	
				{
					$tsAdmin->serverGroupAddClient($grou, $dbid);
					$tsAdmin->clientKick($clid, "channel");
					$tsAdmin->clientPoke($clid, "Zarejestrowano");
				}

			}
		}
	}
?>