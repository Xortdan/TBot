<?php 
function register()
	{
		global $tsAdmin;
		global $config;
		$isregister = 0;
		$channelcount = count($config['function']['register']['allchannel']);
		$channelcount = $channelcount-1;
		for($i=0; $i<=$channelcount; $i++)
		{
			$chann=$config['function']['register']['allchannel'][$i];
			$user=$tsAdmin->channelClientList($chann, '-groups -uid');
			if(isset($user['data'][0]))
			{
				$clid=$user['data']['0']['clid'];
				$grou = $config['function']['register']['info'][$chann];
				$dbid=$user['data']['0']['client_database_id'];
				$groupclient = explode(',', $user['data'][0]['client_servergroups']);
				foreach($groupclient as $group)
				{
					if(in_array($group, $config['function']['register']['allgroup']))	
					{
						$isregister = 1;
						$tsAdmin->clientKick($clid, "channel", "Jesteś już zarejestrowany(a)");	
					}
				}
				if($isregister==0)	
				{
					$tsAdmin->serverGroupAddClient($grou, $dbid);
					$tsAdmin->clientKick($clid, "channel", "Zarejestrowano");
				}

			}
		}
	}
?>