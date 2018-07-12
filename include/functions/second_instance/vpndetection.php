<?php 
function vpndetection()
	{
		global $config;
		global $tsAdmin;
		global $user;
		global $footer;
		global $language;
		
		foreach($user['data'] as $client)
		{
			if($client['client_database_id'] != 1)
			{
				$api = "http://check.getipintel.net/check.php?ip=".$client['connection_client_ip']."&contact=xortdan1998@gmail.com&format=json";
				$checkvpn = json_decode(file_get_contents($api));
				$result = $checkvpn->result;
				
				if($result > 0.995)
				{
					$kick = false;
					$groupclient = explode(',', $client['client_servergroups']);
					foreach($config['function']['vpndetection']['ignore'] as $ignoregroup)
					{	
						if(in_array($ignoregroup, $groupclient))
						{
						$kick = true;
						}
					}
					if(!$kick)
					$tsAdmin->clientKick($client['clid'], $kickMode = "server", $kickmsg = $language['vpndetection']['detection']);
					
				} 
			}
			
		 }
	}
?>