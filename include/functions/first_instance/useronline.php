<?php 
function useronline()
	{
		global $config;
		global $tsAdmin;
		global $online;
		global $user;
		global $serverInfo;
		global $footer;
		$list = "[center][size=14][b]Lista osób online[/b][/size][/center][hr][b][size=9]";
		foreach($user['data'] as $client)
		{	
			if($client['client_database_id'] != 1)
			{
				$list .= "[color=green]● [/color][URL=client://1/".$client['client_unique_identifier']."]".$client['client_nickname']."[/url], ";
			} 
		}
		$userpercent = $online / ($serverInfo['virtualserver_maxclients']/100);
		$data = str_replace('[ONLINE]', $online, $config['function']['useronline']['channelname']);
		$data = str_replace('[%]', round($userpercent), $data);
		$check = $tsAdmin-> channelInfo($config['function']['useronline']['channel']);
		
		if(strcmp($check['data']['channel_name'], $data) != 0)
		{
			$tsAdmin->channelEdit($config['function']['useronline']['channel'], Array('CHANNEL_NAME'=> $data, 'channel_description' => $list."[/size][/b]".$footer));
		}
	}
?>