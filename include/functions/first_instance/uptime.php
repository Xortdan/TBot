<?php 
function uptime()
	{
		global $config;
		global $tsAdmin;
		global $serverInfo;
		
		$data1 = time();
		$data2 = time() - $serverInfo['virtualserver_uptime'];
		$difference = $data1 - $data2;
		$m = floor($difference / 60);
		$h = floor($m/60);
		$m = $m-($h*60);
		$d = floor($h/24);
		$h = $h-($d*24);

		$data = str_replace('[COUNT]', $d.'d '.$h.'h '.$m.'m ', $config['function']['uptime']['channelname']);
		$check = $tsAdmin-> channelInfo($config['function']['uptime']['channel']);
		if(strcmp($check['data']['channel_name'], $data) != 0)
		{
			$tsAdmin->channelEdit($config['function']['uptime']['channel'], Array('CHANNEL_NAME'=> $data));
		} 
	}
?>