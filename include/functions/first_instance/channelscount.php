<?php 
function channelscount()
	{
		global $config;
		global $tsAdmin;		
		global $serverInfo;
		$channels = $serverInfo['virtualserver_channelsonline'];
		$data= str_replace('[COUNT]', $channels, $config['function']['channelscount']['channelname']);
		$check = $tsAdmin-> channelInfo($config['function']['channelscount']['channel']);
		if(strcmp($check['data']['channel_name'], $data) != 0)
		{
			$tsAdmin->channelEdit($config['function']['channelscount']['channel'], array('channel_name' => $data));
		}
	}
?>