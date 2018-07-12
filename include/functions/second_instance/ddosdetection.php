<?php 
function ddosdetection()
	{
		global $config;
		global $tsAdmin;
		global $serverInfo;
		if($serverInfo['virtualserver_total_packetloss_total'] > $config['function']['ddosdetection']['packetloss'])
			$tsAdmin->sendMessage(3, $serverInfo['virtualserver_id'], $config['function']['ddosdetection']['message']);
	}
?>
