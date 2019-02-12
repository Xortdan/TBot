<?php 
function advertisement()
{
	global $config;
	global $tsAdmin;
	global $online;
	global $serverInfo;
	$message = str_replace('[online]', $online, $config['function']['advertisement']['message']);
	$message = str_replace('[max]', $serverInfo['virtualserver_maxclients'], $message);
	$tsAdmin->sendMessage(3, $serverInfo['virtualserver_id'], $message);
	
	unset($message);
}
?>