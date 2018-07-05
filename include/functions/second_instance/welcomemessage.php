<?php 
function welcomemessage()
	{
		global $config;
		global $tsAdmin;
		global $serverInfo;
		global $online;
		
		$max = $serverInfo['virtualserver_maxclients'];
		$data = str_replace('[ONLINE]', $online,$config['function']['welcomemessage']['message']);
		$data = str_replace('[MAX]', $max, $data);
		$tsAdmin->serverEdit(array('virtualserver_welcomemessage' => $data));	
	}
?>