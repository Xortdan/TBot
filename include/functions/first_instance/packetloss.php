<?php 
function packetloss()
	{
		global $config;
		global $tsAdmin;
		global $serverInfo;
		$data = str_replace('[COUNT]', round($serverInfo['virtualserver_total_packetloss_total']), $config['function']['packetloss']['channelname']);
		$check = $tsAdmin-> channelInfo($config['function']['packetloss']['channel']);
		if(strcmp($check['data']['channel_name'], $data) != 0)
		{
			$tsAdmin->channelEdit($config['function']['packetloss']['channel'], Array('CHANNEL_NAME'=> $data));
		}
	}
?>