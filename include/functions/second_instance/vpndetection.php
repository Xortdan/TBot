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
				$api = "http://proxycheck.io/v2/".$client['connection_client_ip']."?key=".$config['function']['vpndetection']['key']."&vpn=1";
				//$api = "http://check.getipintel.net/check.php?ip=".$client['connection_client_ip']."&contact=xortdan1998@gmail.com&format=json";
				//$checkvpn = json_decode();
				//$result = $checkvpn;
				echo file_get_contents($api);
				$checkvpn = json_decode(json_encode(file_get_contents($api)), true);
				$aa = Array();
				foreach($checkvpn as $tak)
				{
					$aa[] = $tak;
				}
				
				print_r($aa);
				
				/* if($result > 0.995)
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
					
				}  */
			}
			
		 }
		//unset($api);
		//unset($checkvpn);
		//unset($result);
		//unset($kick);
		//unset($groupclient);
	}
?>