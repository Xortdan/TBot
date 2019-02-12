<?php 
function pokeonchannel()
	{
		global $config;
		global $tsAdmin;
		global $user;
		global $language;
		
		foreach($config['function']['pokeonchannel']['info'] as $pokeid)
		{
			$admincount = 0;
			$admincount2 = 0;
			$clientonchannel = array_keys(array_column($user['data'], 'cid'), $pokeid['channel']);
			if(isset($clientonchannel[0]))
			{
				foreach($pokeid['pokegroup'] as $pokegroup)
				{
					$groupclients = $tsAdmin -> serverGroupClientList($pokegroup, $names = true);
					foreach($groupclients['data'] as $clientid)
					{
						$client = $tsAdmin -> clientFind($clientid['client_nickname']);
						if($client['data'])
						{
							$admin = $tsAdmin-> clientInfo($client['data'][0]['clid']);
							if(!in_array($admin['data']['cid'], $config['function']['helpchannel']['ignoredonchannel']))
							{
								$pokemessage = str_replace('[NICK]', $user['data'][$clientonchannel[0]]['client_nickname'], $pokeid['message']);
								$tsAdmin -> clientPoke($client['data'][0]['clid'], $pokemessage);
								$admincount++;
							}
							else
							{
								$admincount2++;
							}
						}
					}
				}
				if($admincount == 0 && $admincount2==1)
							{
								$tsAdmin -> clientPoke($user['data'][$clientonchannel[0]]['clid'], "\n[b]".$language['pokeonchannel']['busy']."[/b]");
								return;
							}
							else if($admincount == 0 && $admincount2>1)
							{
								$tsAdmin -> clientPoke($user['data'][$clientonchannel[0]]['clid'], "\n[b]".$language['pokeonchannel']['busy2']."[/b]");	
								return;
							}
							else if($admincount == 0)
							{
								$tsAdmin -> clientPoke($user['data'][$clientonchannel[0]]['clid'], "\n[b]".$language['pokeonchannel']['lackadministration']."[/b]");	
								return;
							}
							else if($admincount == 1)
							{
								$tsAdmin -> clientPoke($user['data'][$clientonchannel[0]]['clid'], "\n[b]".$language['pokeonchannel']['aware']."[/b]");
								return;
							}
							else
							{
								$tsAdmin -> clientPoke($user['data'][$clientonchannel[0]]['clid'], "\n[b]".$language['pokeonchannel']['aware2']."[/b]");
								return;
							}
				
			}
		}
		unset($admincount);
		unset($admincount2);
		unset($clientonchannel);
		unset($groupclients);
		unset($client);
		unset($admin);
		unset($pokemessage);
	}
?>