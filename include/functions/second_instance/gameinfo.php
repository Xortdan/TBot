<?php 
function gameinfo()
{
	global $config;
	global $tsAdmin;
	global $footer;
	global $language;
		
	foreach($config['function']['gameinfo']['info'] as $server)
	{
		$api = file_get_contents("http://api.gametracker.rs/demo/json/server_info/".$server['serverip']);
		$server_info = json_decode($api, true);
		if($server_info['apiError'] != 1)
		{
			$channelname = str_replace("[ONLINE]", $server_info['players'], $server['servername']);
			$channelname = str_replace("[MAX]", $server_info['playersmax'], $channelname);
			echo $channelname;
		}
		else
		{
			$channelname = "[cspacer]BRAK SERWERA";
		}
		$tsAdmin -> channelEdit( $server['channel'], Array('CHANNEL_NAME'=> $channelname));
	}
	unset($api);
	unset($server_info);
	unset($channelname);
}
?>