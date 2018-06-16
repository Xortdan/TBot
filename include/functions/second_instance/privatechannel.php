<?php 
function privatechannel()
	{
		global $footer;
		global $config;
		global $tsAdmin;
		$haschannel = false;
		$number1 = 0;
		$number2 = 0;
		$free1 = 0;
		$free2 = 0;

		$hasrang = false;
		$user=$tsAdmin->channelClientList($config['function']['privatechannel']['clientonchannel'], '-groups -uid');
		if(isset($user['data'][0]))
		{	
			$servergroupclient = explode(',', $user['data'][0]['client_servergroups']);
			$clientdbid = $user['data'][0]['client_database_id'];
			$clientid = $user['data'][0]['clid'];
			$nick = $user['data'][0]['client_nickname'];
			foreach($servergroupclient as $group)
			{
				if(in_array($group, $config['function']['privatechannel']['needgroup']))
				{
					$hasrang = true;
					break;
				}
				else
				{
					$hasrang = false;
				}
			}
			if($hasrang==false)
			{
				$tsAdmin->sendMessage(1, $clientid, "Zarejestruj się aby dostać prywatny kanał");
				return;
			}
			if($hasrang)
			{
				$userchannelgroup = $tsAdmin->channelGroupClientList(NULL, $clientdbid);
				if(empty($userchannelgroup['data']))
				{
					$haschannel = false;
				}
				else
				{

					for($i=0; $i<count($userchannelgroup['data']); $i++)
					{
						if($config['function']['privatechannel']['admingroup'] == $userchannelgroup['data'][$i]['cgid'])
						{
						$tsAdmin->clientPoke($clientid, "Posiadasz już prywatny kanał");
						$tsAdmin->clientMove($clientid, $userchannelgroup['data'][$i]['cid']);
						$haschannel = true;
						break;
						}
					}
				}
			}
			if(!$haschannel)
			{
				$channels = $tsAdmin->channelList('-topic');
				foreach($channels['data'] as $channel)
				{
					if($channel['pid'] == $config['function']['privatechannel']['channelzone'])	
					{	
						$free1++;
						$number1++;
						if($channel['channel_topic'] == $config['function']['privatechannel']['channeltopic'])
						{
							$channelname = str_replace('[NICK]', $nick, $config['function']['privatechannel']['channelname']);
							$date = date("d.m.o");
							$tsAdmin->clientMove($clientid, $channel['cid']);
							$tsAdmin->channelGroupAddClient($config['function']['privatechannel']['admingroup'], $channel['cid'], $clientdbid);
							$tsAdmin->channelEdit($channel['cid'], array
							(
							'channel_topic' => $date,
							'channel_name' => $number1.". ".$channelname,
							'channel_description' => "[center][size=15][b]".$nick."[/b][/size]\n[size=12][color=blue]data utworzenia: ".$date."[/color][/size][/center]".$footer,
							'channel_flag_maxclients_unlimited'=>1, 
							'channel_flag_maxfamilyclients_unlimited'=>1, 
							'channel_flag_maxfamilyclients_inherited'=>0,
							));
							$tsAdmin->clientPoke($clientid, "Dostałeś kanał prywatny nr ".$number1);
							$tsAdmin->clientPoke($clientid, $config['function']['privatechannel']['messageafter']);  
							for($e=0; $e<$config['function']['privatechannel']['subchannels']; $e++)
							{
							$number2++;
							$tsAdmin->channelCreate(array
								(
									'cpid' => $channel['cid'],
									'channel_name' => $number2." ".$config['function']['privatechannel']['subchannelname'], 
									'channel_flag_permanent' => 1, 
									'channel_flag_maxclients_unlimited' => 1, 
									'channel_flag_maxfamilyclients_inherited' => 1,
									'channel_flag_maxfamilyclients_unlimited' => 1
								));	
							}
							break;
						}
						else
						{	
							$free2++;
						} 
					}
				}
				if($free1==$free2)
				{
					$tsAdmin->clientPoke($clientid, "Brak wolnych kanałów");
					//$tsAdmin->clientKick($clientid, "channel");
				}
			}
		}
	}
?>