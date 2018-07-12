<?php 
function register()
	{
		global $tsAdmin;
		global $config;
		global $user;
		global $language;
		$isregister = 0;
		foreach($config['function']['register']['info'] as $channel)
		{
			$clientinchannel = array_keys(array_column($user['data'], 'cid'), $channel['channel']);
			if(isset($clientinchannel[0]))
			{
				$clientinchannel = $clientinchannel[0];
				$clid=$user['data'][$clientinchannel]['clid'];
				$grou = $channel['group'];
				$dbid=$user['data'][$clientinchannel]['client_database_id'];
				$groupclient = explode(',', $user['data'][$clientinchannel]['client_servergroups']);
				foreach($groupclient as $group)
				{
					if(in_array($group, $config['function']['register']['allgroup']))	
					{
						$isregister = 1;
						$tsAdmin->clientKick($clid, "channel");	
						$tsAdmin->clientPoke($clid, $language['register']['isregistered']);
					}
				}
				if($isregister==0)	
				{
					$tsAdmin->serverGroupAddClient($grou, $dbid);
					$tsAdmin->clientKick($clid, "channel");
					$tsAdmin->clientPoke($clid, $language['register']['registered']);
				}

			}
		}
		
		$clientinchannel = array_keys(array_column($user['data'], 'cid'), $config['function']['register']['channeldelgroup']);
		
		if(isset($clientinchannel[0])) 
		{
			$clientinchannel = $clientinchannel[0];
			$clid=$user['data'][$clientinchannel]['clid'];
			$dbid=$user['data'][$clientinchannel]['client_database_id'];
			$groupclient = explode(',', $user['data'][$clientinchannel]['client_servergroups']);
			foreach($groupclient as $group)
			{
				$grou = array_search($group, $config['function']['register']['allgroup']);
				if(is_numeric($grou))	
				{
					$isregister = 1;
					$tsAdmin->serverGroupDeleteClient($config['function']['register']['allgroup'][$grou], $dbid);
					$tsAdmin->clientKick($clid, "channel");	
					$tsAdmin->clientPoke($clid, $language['register']['delrang']);
					return;
				}
			}
			if($isregister==0)	
			{
				$tsAdmin->clientKick($clid, "channel");
				$tsAdmin->clientPoke($clid, $language['register']['noregisted']);
			}

		}  
	}
?>