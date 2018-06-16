<?php 
	function groupname($search)
	{
		global $tsAdmin;
		global $groups;
		$groupname = "";
		foreach($groups['data'] as $group)
		{
			if($group['sgid'] == $search)
			{
				$groupname = $group['name'];
			}
		}
		return $groupname;
	}
		
	function groupclientcount()
	{
		global $footer;
		global $config;
		global $tsAdmin;
		$countchannels = count($config['function']['groupclientcount']['allchannel']);
		foreach($config['function']['groupclientcount']['allchannel'] as $channel)
		{	
		$countclientgroup = 0;
			$r=0;
			$list = "";
			$group = $config['function']['groupclientcount']['info'][$channel]['group'];
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
					$status = "[color=green]ONLINE[/color]";
					$countclientgroup++;
				}
				else
				{
					$status = "[color=red]OFFLINE[/color]";
				}
				$description = str_replace('[NICK]', $nick, $config['function']['groupclientcount']['info'][$channel]['channeldescription']);
				$description = str_replace('[STATUS]', $status, $description);
				$description = str_replace('[NUMBER]', $r, $description);
				$list.=$description;
			}
			$channelname = str_replace('[ONLINE]', $countclientgroup, $config['function']['groupclientcount']['info'][$channel]['channelname']);
			$channelname = str_replace('[MAX]', $countclientsnumber, $channelname);
			$channelname = str_replace('[RANG]', $groupname, $channelname);
			$channeldesctopic = str_replace('[RANG]', $groupname, $config['function']['groupclientcount']['info'][$channel]['channeldesctopic']);
			$channeldescription = $channeldesctopic.$list.$footer;
			$check = $tsAdmin-> channelInfo($channel);
			if(strcmp($channelname, $check['data']['channel_name']) != 0)
			{
			$tsAdmin->channelEdit($channel, array('channel_name' => $channelname));
			$tsAdmin->channelEdit($channel, array('channel_description' => $channeldescription));	
			}
			
		} 
	}
?>