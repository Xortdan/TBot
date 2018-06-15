<?php 
function groupname($search)
	{
		global $tsAdmin;
		global $groups;
		$groupname = "";
		foreach($groups['data'] as $group)
		{
			if($search == $group['sgid'])
			{
				$groupname = $group['name'];
			}
		}
		return $groupname;
	}
		
	function groupcount()
	{
		global $footer;
		global $config;
		global $tsAdmin;
		global $countclientgroup;
		$countclientgroup = 0;
		$countchannels = count($config['function']['groupcount']['allchannel']);
		for($i=0; $i<$countchannels; $i++)
		{
			$list = "";
			$channel = $config['function']['groupcount']['allchannel'][$i];
			$group = $config['function']['groupcount']['info'][$channel]['group'];
			$groupname = groupname($group);
			$countclients = $tsAdmin->serverGroupClientList($group, $names = true);
			$countclientsnumber = count($countclients['data']);
			for($e=0; $e<count($countclients['data']); $e++)
			{
				$r=$e+1;
				$nick = $countclients['data'][$e]['client_nickname'];
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
				$description = str_replace('[NICK]', $nick, $config['function']['groupcount']['info'][$channel]['channeldescription']);
				$description = str_replace('[STATUS]', $status, $description);
				$description = str_replace('[NUMBER]', $r, $description);
				$list.=$description;
			}
			$channelname = str_replace('[ONLINE]', $countclientgroup, $config['function']['groupcount']['info'][$channel]['channelname']);
			$channelname = str_replace('[MAX]', $countclientsnumber, $channelname);
			$channelname = str_replace('[RANG]', $groupname, $channelname);
			$channeldesctopic = str_replace('[RANG]', $groupname, $config['function']['groupcount']['info'][$channel]['channeldesctopic']);
			$channeldescription = $channeldesctopic.$list.$footer;
			$check = $tsAdmin-> channelInfo($channel);
			if(strcmp($channelname, $check['data']['channel_name']) != 0)
			{
				$tsAdmin->channelEdit($channel, array('channel_name' => $channelname));
				$tsAdmin->channelEdit($channel, array('channel_description' => $channeldescription));
			}
			$countclientgroup = 0;
			
		} 
	}
?>