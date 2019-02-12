<?php 
function servername()
	{
		global $config;
		global $tsAdmin;
		global $serverInfo;
		global $online;
		
		$max = $serverInfo['virtualserver_maxclients'];
		$data = str_replace('[ONLINE]', $online, $config['function']['servername']['channelname']);
		$data = str_replace('[MAX]', $max, $data);
		$check = $serverInfo['virtualserver_name'];
		if(strcmp($check, $data) != 0)
		{
		$tsAdmin->serverEdit(array('virtualserver_name' => $data));	
		}
		unset($max);
		unset($check);
	}
?>