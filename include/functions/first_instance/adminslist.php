<?php
		
	function adminslist()
	{
		global $footer;
		global $config;
		global $tsAdmin;
		$list = "";
		foreach($config['function']['adminslist']['group'] as $group)
		{	
			$groupname = groupname($group);
			$list .= "[center][size=15][b][color=blue]".$groupname."[/color][/b][/size][/center][hr]\n";
			$groupclients = $tsAdmin->serverGroupClientList($group, $names = true);
			$countclientsnumber = count($groupclients['data']);
			foreach($groupclients['data'] as $client)
			{
				$nick = $client['client_nickname'];
				$nick_array = $tsAdmin->clientFind($nick);
				
				if($nick_array['data'])
				{
					$status = "[img]https://xtrust.pl/icon/iconyes.png[/img] [color=green]ONLINE[/color]";
				}
				else
				{
					$status = "[img]https://xtrust.pl/icon/iconnoo.png[/img] [color=red]OFFLINE[/color]";
				}
				$list .= "[img]https://www.iconfinder.com/icons/2123927/download/png/20[/img] [size=10][b]".$nick." | ".$status."[/b][/size]\n";
			}
			$list .= "\n";
		} 
		$tsAdmin->channelEdit($config['function']['adminslist']['channel'], array('channel_description' => $list.$footer));
	}
?> 