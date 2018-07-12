<?php 
function ping()
	{
		global $config;
		global $tsAdmin;
		global $serverInfo;
		$data = str_replace('[COUNT]', round($serverInfo['virtualserver_total_ping']), $config['function']['ping']['channelname']);
		$check = $tsAdmin-> channelInfo($config['function']['ping']['channel']);
		if(strcmp($check['data']['channel_name'], $data) != 0)
		{
			$tsAdmin->channelEdit($config['function']['ping']['channel'], Array('CHANNEL_NAME'=> $data));
		}
	}
?>