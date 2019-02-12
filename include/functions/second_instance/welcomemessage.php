<?php 
function welcomemessage()
	{
		global $config;
		global $tsAdmin;
		global $serverInfo;
		global $online;
		
		$data = str_replace('[online]', $online, $config['function']['welcomemessage']['message']);
		$data = str_replace('[max]', $serverInfo['virtualserver_maxclients'], $data);
		
		if(strcmp($serverInfo['virtualserver_welcomemessage'], $data) != 0 && $config['function']['welcomemessage']['mode'] == 2)
		{
			$tsAdmin->serverEdit(array('virtualserver_welcomemessage' => $data, 'virtualserver_hostmessage' => ""));	
		}
		else if(strcmp($serverInfo['virtualserver_hostmessage'], $data) != 0 && $config['function']['welcomemessage']['mode'] == 1)
		{
			$tsAdmin->serverEdit(array('virtualserver_hostmessage' => $data, 'virtualserver_welcomemessage' => ""));	
		}
	}
?>