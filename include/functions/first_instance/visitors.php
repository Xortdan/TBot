<?php 
function visitors()
	{
		global $config;
		global $tsAdmin;
		global $serverInfo;
		$count = $serverInfo['virtualserver_client_connections'];
		$data= str_replace('[COUNT]', $count, $config['function']['visitors']['channelname']);
		$check = $tsAdmin-> channelInfo($config['function']['visitors']['channel']);
		if(strcmp($check['data']['channel_name'], $data) != 0)
		{
			$tsAdmin->channelEdit($config['function']['visitors']['channel'], array('channel_name' => $data));
		}
	}
?>