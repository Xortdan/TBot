<?php 

function groupname2($search)
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

function clientstatus()
{
	global $config;
	global $tsAdmin;
	global $groups;	
	global $user;
	foreach($config['function']['clientstatus']['aalgroup'] as $group)
	{
		$usersgroup = $tsAdmin->serverGroupClientList($group, $names = true);
		foreach($usersgroup['data'] as $user)
		{
			foreach($config['function']['clientstatus']['info'] as $number)
			{
				if($user['cldbid'] == $number['dbid'])
				{
					$clientfind = $tsAdmin->clientFind($user['client_nickname']);
					if(!empty($clientfind['data']))
						{
							$status = "ONLINE";
						}
						else
						{
							$status = "OFFLINE";
						}
					$channelname = str_replace('[RANG]', groupname2($group), $config['function']['clientstatus']['channelname']);
					$channelname = str_replace('[NICK]', $user['client_nickname'], $channelname);
					$channelname = str_replace('[STATUS]', $status, $channelname);
					$tsAdmin->channelEdit($number['channel'], array('channel_name' => $channelname));
				}	
			}
		}	
	}			
}
		
?>