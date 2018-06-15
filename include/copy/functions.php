<?php 
require_once("include/lib/ts3admin.class.php");
require_once("config.php");
	
	global $footer;
	$footer = "[hr][right][i]".$version."[/i][/right][hr] [right][i][b]xTrustBot[/b][/i]";

	function groupname($search)
	{
		global $tsAdmin;
		$groupname = "";
		$groups = $tsAdmin->serverGroupList();
		foreach($groups['data'] as $group)
		{
			if($search == $group['sgid'])
			{
				$groupname = $group['name'];
			}
		}
		return $groupname;
	}
	
	
	
	function loop()
	{
	global $config;
	global $tsAdmin;
	$a=0;
	$serverInfo = $tsAdmin->getElement('data', $tsAdmin->serverInfo());
	$online = $serverInfo['virtualserver_clientsonline'] - $serverInfo['virtualserver_queryclientsonline'];
	$a++;
	}
	function day()
	{
		global $config;
		global $tsAdmin;
		$datad = date('d');
		$datam = date('m');
		$datay = date('Y');
		$data=str_replace('[DAY]', $datad, $config['function']['day']['channelname']);
		$data=str_replace('[MONTH]', $datam, $data);
		$data=str_replace('[YEAR]', $datay, $data);
		$check = $tsAdmin-> channelInfo($config['function']['day']['channel']);
		if(strcmp($check['data']['channel_name'], $data) != 0)
		{
			$tsAdmin->channelEdit($config['function']['day']['channel'], Array('CHANNEL_NAME'=> $data));
		}
	}

	function hour()
	{
		global $config;
		global $tsAdmin;
		$dataH = date('H');
		$datai = date('i');
		$data=str_replace('[HOUR]', $dataH, $config['function']['hour']['channelname']);
		$data=str_replace('[MINUTES]', $datai, $data);
		$check = $tsAdmin-> channelInfo($config['function']['hour']['channel']);
		if(strcmp($check['data']['channel_name'], $data) != 0)
		{
			$tsAdmin->channelEdit($config['function']['hour']['channel'], Array('CHANNEL_NAME'=> $data));
		}
	}
	
	function useronline()
	{
		global $config;
		global $tsAdmin;
		global $online;
		$serverInfo = $tsAdmin->getElement('data', $tsAdmin->serverInfo());
		$online = $serverInfo['virtualserver_clientsonline'] - $serverInfo['virtualserver_queryclientsonline'];
		if($online==1)
		{
			$user="użytkownik";
		}
		else 
		{
			$user="użytkowników";
		}
		$data= str_replace('[ONLINE]', $online, $config['function']['useronline']['channelname']);
		$data= str_replace('[USER]', $user, $data);
		$check = $tsAdmin-> channelInfo($config['function']['useronline']['channel']);
		if(strcmp($check['data']['channel_name'], $data) != 0)
		{
			$tsAdmin->channelEdit($config['function']['useronline']['channel'], Array('CHANNEL_NAME'=> $data));
		}
	}
	
	function register()
	{
		global $tsAdmin;
		global $config;
		$isregister = 0;
		$channelcount = count($config['function']['register']['allchannel']);
		$channelcount = $channelcount-1;
		$allgroupcount = count($config['function']['register']['allgroup']);
		$allgroupcount  = $allgroupcount-1;
		for($i=0; $i<=$channelcount; $i++)
		{
			$chann=$config['function']['register']['allchannel'][$i];
			$user=$tsAdmin->channelClientList($chann, '-groups -uid');
			if(isset($user['data'][0]))
			{
				$clid=$user['data']['0']['clid'];
				$grou = $config['function']['register']['info'][$chann];
				$dbid=$user['data']['0']['client_database_id'];
				$groupclient = explode(',', $user['data'][0]['client_servergroups']);
				foreach($groupclient as $group)
				{
					if(in_array($group, $config['function']['register']['allgroup']))	
					{
						$isregister = 1;
						$tsAdmin->clientKick($clid, "channel", "Jesteś już zarejestrowany(a)");	
					}
				}
				if($isregister==0)	
				{
					$tsAdmin->serverGroupAddClient($grou, $dbid);
					$tsAdmin->clientKick($clid, "channel", "Zarejestrowano");
				}

			}
		}
	}
	
	function recordonline()
	{
		global $config;
		global $tsAdmin;
		global $record;
		$serverInfo = $tsAdmin->getElement('data', $tsAdmin->serverInfo());
		$online = $serverInfo['virtualserver_clientsonline'] - $serverInfo['virtualserver_queryclientsonline'];		
		if($record !=null)
		{
			if($online>$record)
			{
				$ff = fopen("include/cache/record.txt", "w");
				fputs($ff, $online);
				fclose($ff);
				$record=$online;
			}
		}
		else
		{
			$fo = fopen("include/cache/record.txt", "r");
			$record = fread($fo, filesize("include/cache/record.txt"));
			fclose($fo); 
		}
		$data= str_replace('[RECORD]', $record, $config['function']['recordonline']['channelname']);
		$check = $tsAdmin-> channelInfo($config['function']['recordonline']['channel']);
		if(strcmp($check['data']['channel_name'], $data) != 0)
		{
			$tsAdmin->channelEdit($config['function']['recordonline']['channel'], Array('CHANNEL_NAME'=> $data));
		}
	}
	
	function afk()
	{
		global $config;
		global $tsAdmin;
		$serverInfo = $tsAdmin->getElement('data', $tsAdmin->serverInfo());
		$online = $serverInfo['virtualserver_clientsonline'] - $serverInfo['virtualserver_queryclientsonline'];
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
	function pgroup()
	{
		global $config;
		global $tsAdmin;
		$countgroup = $config['function']['pgroup']['allgroup'];
		$serverInfo = $tsAdmin->getElement('data', $tsAdmin->serverInfo());
		$online = $serverInfo['virtualserver_clientsonline'];

		for($i=0; $i<$online; $i++)
		{
			$user = $tsAdmin->clientList("-groups");
			$user = $user['data'][$i];
			$groupclient = explode(',', $user['client_servergroups']);	
			count($groupclient);
			for($e=0; $e<count($groupclient); $e++)
			{	
				for($r=0; $r<count($countgroup); $r++)
				{
					if($groupclient[$e] == $countgroup[$r])
					{
						echo "tak";
						$tsAdmin->clientPoke($user['clid'], $config['function']['pgroup']['message'][$countgroup[$r]]);
					}
				}
			}  	
		}
	}
	
	function banlist()
	{
		global $footer;
		global $config;
		global $tsAdmin;
		global $nban;
		$nban = 1;
		$list2 = "";
		$blist = $tsAdmin->banList();
		$lban = count($blist);
		for($i=0; $i<$lban; $i++)
		{
			if(empty($blist['data'][$i]['lastnickname']))
			{
				continue;
			}
			else
			{
				if($blist['data'][$i]['duration']>60 && $blist['data'][$i]['duration']<3600)
				{
					$duration=$blist['data'][$i]['duration']/60;
					$duration.=' minut';
				}
				else if($blist['data'][$i]['duration']==3600)
				{
					$duration=$blist['data'][$i]['duration']/3600;
					$duration.=' godzina';
				}
				else if($blist['data'][$i]['duration']==7200 || $blist['data'][$i]['duration']==10800 || $blist['data'][$i]['duration']== 14400)
				{
					$duration=$blist['data'][$i]['duration']/3600;
					$duration.=' godziny';
				}
				else if($blist['data'][$i]['duration']>14400 && $blist['data'][$i]['duration']<86400)
				{
					$duration=$blist['data'][$i]['duration']/3600;
					$duration.=' godzin';
				}
				else if($blist['data'][$i]['duration']==86400)
				{
					$duration=$blist['data'][$i]['duration']/86400;
					$duration.=' dzień';
				}
				else if($blist['data'][$i]['duration']>86400 && $blist['data'][$i]['duration']<1528550754)
				{
					$duration=$blist['data'][$i]['duration']/86400;
					$duration.=' dni';
				}
				else if($blist['data'][$i]['duration']==0)
				{
					$duration=' permamentnie';
				}
				if($blist['data'][$i]['duration']==0)
				{
					$to = "∞";
					$rem = "∞";
				}
				else
				{
					$to = $blist['data'][$i]['created']+$blist['data'][$i]['duration'];
					$to = date("d.m.o G:s",$to);
				}
		
				$created = date("j.m.o H:s",$blist['data'][$i]['created']);
				$list2.='[color=blue][size=12]'.$nban.'.[/size][/color] '.$blist['data'][$i]['lastnickname'].'\nBanujący: [URL=client://0/'.$blist['data'][$i]['invokeruid'].'~'.$blist['data'][$i]['invokername'].']'.$blist['data'][$i]['invokername'].'[/URL]'
				.'\nPowód: '.$blist['data'][$i]['reason'].'\nCzas trwania: '.$duration
				.'\nOd: '.$created.'\nDo: '.$to.'\n\n';
				$nban++;
			}
		}
		$nban-=1;
		$list = "[center][color=blue][size=15][B]Lista banów[/B][/size][/color]\n[size=12][B]Wszystkich: $nban \n\n[/B][/size][/center]";
		$data = $list.$list2.$footer;
		$tsAdmin->channelEdit($config['function']['banlist']['channel'], array('channel_description' => $data));
	}
	
	function channelscount()
	{
		global $config;
		global $tsAdmin;		
		$serverInfo = $tsAdmin->getElement('data', $tsAdmin->serverInfo());
		$channels = $serverInfo['virtualserver_channelsonline'];
		$data= str_replace('[COUNT]', $channels, $config['function']['channelscount']['channelname']);
		$check = $tsAdmin-> channelInfo($config['function']['channelscount']['channel']);
		if(strcmp($check['data']['channel_name'], $data) != 0)
		{
			$tsAdmin->channelEdit($config['function']['channelscount']['channel'], array('channel_name' => $data));
		}
	}
	
	function visitors()
	{
		global $config;
		global $tsAdmin;
		$serverInfo = $tsAdmin->getElement('data', $tsAdmin->serverInfo());
		$count = $serverInfo['virtualserver_client_connections'];
		$data= str_replace('[COUNT]', $count, $config['function']['visitors']['channelname']);
		$check = $tsAdmin-> channelInfo($config['function']['visitors']['channel']);
		if(strcmp($check['data']['channel_name'], $data) != 0)
		{
			$tsAdmin->channelEdit($config['function']['visitors']['channel'], array('channel_name' => $data));
		}
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
				for($i=0; $i<count($channels['data']); $i++)
				{
					if($channels['data'][$i]['pid'] == $config['function']['privatechannel']['channelzone'])	
					{	
						$free1++;
						$number1++;
						if($channels['data'][$i]['channel_topic'] == $config['function']['privatechannel']['channeltopic'])
						{
							$channelname = str_replace('[NICK]', $nick, $config['function']['privatechannel']['channelname']);
							$date = date("d.m.o");
							$tsAdmin->clientMove($clientid, $channels['data'][$i]['cid']);
							$tsAdmin->channelGroupAddClient($config['function']['privatechannel']['admingroup'], $channels['data'][$i]['cid'], $clientdbid);
							$tsAdmin->channelEdit($channels['data'][$i]['cid'], array
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
									'cpid' => $channels['data'][$i]['cid'],
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
					$tsAdmin->clientKick($clientid, "channel");
				}
			}
		}
	}
	
	function checkchannels()
	{
		global $config;
		global $tsAdmin;
		global $footer;
		global $channelcid;
		global $channeltopic;
		$number = 0;
		$number2 = 0;
		$channels = $tsAdmin->channelList('-topic');	
		foreach($channels['data'] as $channel)
		{
			$date = date("d.m.o");
			if($channel['pid'] == $config['function']['checkchannels']['channelzone'])	
			{	
				$channeltopic = $channel['channel_topic'];
				$channelcid = $channel['cid'];
				$number++;  
				if($config['function']['checkchannels']['channeltopic'] != $channel['channel_topic'])
				{
					$number2++;
					$setdate = strtotime($channel['channel_topic']);
					$remainingtime = time() - $setdate;
					$interval = $config['function']['checkchannels']['intervaldelete']*24*60*60;
					if($interval<=$remainingtime)
					{	
						$channelname = str_replace('[NUMBER]', $number, $config['function']['checkchannels']['channelname']);
						$order = $channel['channel_order'];
						$tsAdmin->channelDelete($channel['cid']);
						$tsAdmin->channelCreate(array
						(
						'channel_name' => $channelname,
						'channel_topic' => $config['function']['checkchannels']['channeltopic'],
						'channel_description' => "[b][size=15]".$number.". Kanał wolny[/size][/b]".$footer,
						'cpid' => $config['function']['checkchannels']['channelzone'],
						'channel_flag_permanent' => 1,
						'channel_order' => $order,
						'channel_flag_maxclients_unlimited' => 0,
						'channel_flag_maxfamilyclients_unlimited' => 0,
						'channel_flag_maxfamilyclients_inherited' => 0,
						'channel_maxclients' => 0,
						'channel_maxfamilyclients' => 0,
						));	
						
					}
				}
				if(($channel['total_clients'] >= 1) && ($config['function']['checkchannels']['setdate'] == true) && ($channeltopic != $config['function']['checkchannels']['channeltopic']) && ($channeltopic!=$date) &&($channel['pid'] == $config['function']['checkchannels']['channelzone']) )
				{
				$tsAdmin->channelEdit($channel['cid'], array
							(
							'channel_topic' => $date,
							));
				}
			}
		
			if(($channel['pid']==$channelcid) && ($channel['total_clients'] >= 1) && ($config['function']['checkchannels']['setdate'] == true) && ($channeltopic!=$date) &&($channeltopic!=$config['function']['checkchannels']['channeltopic']))
			{
				$tsAdmin->channelEdit($channelcid, array
							(
							'channel_topic' => $date,
							));
							print_r($tsAdmin->channelList());
			}
		}
	}
	
	function servername()
	{
		global $config;
		global $tsAdmin;
		$serverInfo = $tsAdmin->getElement('data', $tsAdmin->serverInfo());
		$online = $serverInfo['virtualserver_clientsonline'] - $serverInfo['virtualserver_queryclientsonline'];
		$max = $serverInfo['virtualserver_maxclients'];
		$data = str_replace('[ONLINE]', $online, $config['function']['servername']['channelname']);
		$data = str_replace('[MAX]', $max, $data);
		$check = $serverInfo['virtualserver_name'];
		if(strcmp($check, $data) != 0)
		{
		$tsAdmin->serverEdit(array('virtualserver_name' => $data));	
		} 
	}
?>