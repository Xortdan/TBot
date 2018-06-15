<?php 
function afk()
	{
		global $config;
		global $tsAdmin;
		global $online;
		for($i=0; $i<$online; $i++)
		{
			$clist=$tsAdmin->clientList("-times");
			$idle_sec=$clist['data'][$i]['client_idle_time']/1000;
			$idle_sec = floor($idle_sec);
			if($idle_sec>$config['function']['afk']['idletime'])
			{
				if($config['function']['afk']['mode'] == 1)
				{
					$tsAdmin->clientMove($clist['data'][$i]['clid'], $config['function']['afk']['idlechannel']);
				}
				else if($config['function']['afk']['mode'] == 2)
				{
					$tsAdmin->serverGroupAddClient($config['function']['afk']['afkgroup'], $clist['data'][$i]['client_database_id']);
				}
			}
			else
			{
				$tsAdmin->serverGroupDeleteClient($config['function']['afk']['afkgroup'], $clist['data'][$i]['client_database_id']);
			}	
		}
	}
?>