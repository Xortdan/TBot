<?php 
function channelzoneclient()
	{
		global $config;
		global $tsAdmin;
		global $serverInfo;
		global $channels;
		global $channelcid;
		$countclients = false;
		foreach($config['function']['channelzoneclient']['info'] as $zone)
		{
			$clientscount = 0;
			foreach($channels['data'] as $channel)
			{
				
				if($channel['cid'] == $zone['channelzonestart'])
					$countclients = true;
				
				if($channel['cid'] == $zone['channelzonestop'])
					$countclients = false;
				
				if($countclients)
					$clientscount += $channel['total_clients'];
			}
		$data = str_replace('[count]', $clientscount, $zone['channelname']);
		$tsAdmin->channelEdit($zone['channel'], array
							(
							'channel_name' => $data,
							)); 
		}
	}
?>