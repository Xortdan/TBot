<?php
		
	function groupclientcount()
	{
		global $footer;
		global $config;
		global $tsAdmin;
		foreach($config['function']['groupclientcount']['info'] as $channel)
		{	
		$countclientgroup = 0;
			$r=0;
			$list = "";
			$group = $channel['group'];
			$groupname = groupname($group);
			$groupclients = $tsAdmin->serverGroupClientList($group, $names = true);
			$countclientsnumber = count($groupclients['data']);
			foreach($groupclients['data'] as $client)
			{
				$r++;
				$nick = $client['client_nickname'];
				$nick_array = $tsAdmin->clientFind($nick);
				
				if($nick_array['data'])
				{
					$status = "[img]https://xtrust.pl/icon/iconyes.png[/img] [color=green]ONLINE[/color]";
					$countclientgroup++;
				}
				else
				{
					$status = "[img]https://xtrust.pl/icon/iconnoo.png[/img] [color=red]OFFLINE[/color]";
				}
				$list.="[img]https://www.iconfinder.com/icons/2123927/download/png/20[/img] [size=10][b]".$nick." | ".$status."[/b][/size]\n";
			}
			$channelname = str_replace('[ONLINE]', $countclientgroup, $channel['channelname']);
			$channelname = str_replace('[MAX]', $countclientsnumber, $channelname);
			$channelname = str_replace('[RANG]', $groupname, $channelname);
			$channeldescription = "[size=15][b][color=blue]".$groupname."[/color][/b][/size][hr]\n".$list.$footer;
			$check = $tsAdmin-> channelInfo($channel['channel']);
			if(strcmp($channelname, $check['data']['channel_name']) != 0)
			{
			$tsAdmin->channelEdit($channel['channel'], array('channel_name' => $channelname));
			$tsAdmin->channelEdit($channel['channel'], array('channel_description' => $channeldescription));	
			}
			
		} 
	}
?>