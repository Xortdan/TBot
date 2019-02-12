<?php 
function checkchannels()
	{
		global $config;
		global $tsAdmin;
		global $footer;
		global $channelcid;
		global $channeltopic;
		global $channels;
		global $language;
		global $editchannel;
		$number = 0;
		$number2 = 0;
		$freechannelscount = 0;
		$descbusy = "\n";
		$descfree = "";
		foreach($channels['data'] as $channel)
		{
			$date = date("d.m.o");
			if($channel['pid'] == $config['function']['checkchannels']['channelzone'])	
			{	
				$channeltopic = $channel['channel_topic'];
				$channelcid = $channel['cid'];
				$order = $channel['channel_order'];
				$number++;  
				if($config['function']['checkchannels']['channeltopic'] != $channel['channel_topic'])
				{
					$number2++;
					$descbusy .= "     [URL=channelid://".$channel['cid']."]".$number.".[/URL] ".str_replace($number.". ", "", $channel['channel_name'])."\n";
 					$setdate = strtotime($channel['channel_topic']);
					$remainingtime = time() - $setdate;
					$interval = $config['function']['checkchannels']['intervaldelete']*24*60*60;
					
					if($interval<=$remainingtime)
					{	
						$channelname = str_replace('[NUMBER]', $number, $config['function']['checkchannels']['channelname']);
						$tsAdmin->channelDelete($channel['cid']);
						$tsAdmin->channelCreate(array
						(
						'channel_name' => $channelname,
						'channel_topic' => $config['function']['checkchannels']['channeltopic'],
						'channel_description' => "[b][size=15]".$number.". ".$language['checkchannels']['freechannel']."[/size][/b]".$footer,
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
					else
					{
						//check channel name
						$loopdate = date('Y-m-d G:i:s');
						if($config['function']['checkchannels']['checkname'] == true)
						{
							if(ready($loopdate, $config['function']['checkchannels']['datazeroname'], intervaltosecond($config['function']['checkchannels']['intervalname'])) == true)
							{
								$block = explode(",", $config['function']['checkchannels']['block']);
							
								$change = false;
								for($i=0; $i<count($block); $i++)
								{
									$find = strpos(strtoupper($channel['channel_name']), strtoupper($block[$i]));
									if($find  !== false)
									{
										$change = true;
										break;
									}
								}
			
								if($change == true)
								{
									$needname = $number.". ";
									$tsAdmin->channelEdit($channelcid, array
								(
								'channel_name' => $needname.$config['function']['checkchannels']['message'],
								));	
								}
							}
						}
					}
					
					$needname = $number.". ";
					$neednamecheck =  substr_count($channel['channel_name'], $needname);
					if(!($neednamecheck >= 1))
					{
						$tsAdmin->channelEdit($channelcid, array
							(
							'channel_name' => substr($needname.$channel['channel_name'],0,40),
							));
					}
					
				}
				else
				{
					$freechannelscount++;
					$descfree .= "[URL=channelid://".$channel['cid']."]".$number."[/URL], ";				
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
			}
		}
		
		//check channel name
		$loopdate = date('Y-m-d G:i:s');
		if($config['function']['checkchannels']['checkname'] == true)
		{
			if(ready($loopdate, $config['function']['checkchannels']['datazeroname'], intervaltosecond($config['function']['checkchannels']['intervalname'])) == true)
			{
				$config['function']['checkchannels']['datazeroname'] = $loopdate;
			}
		}
		
		$descfree = substr($descfree, 0, strlen($descfree)-2);
		//$descbusy = substr($descbusy, 0, strlen($descbusy)-2);
		
		$data = str_replace('[COUNT]', $number2, $config['function']['checkchannels']['channelzonename']);
		$desc = "[b][size=10][img]https://www.iconfinder.com/icons/226568/download/png/20[/img] ".$language['checkchannels']['freechannels'].": ".$descfree."\n\n[img]https://www.iconfinder.com/icons/226568/download/png/20[/img] ".$language['checkchannels']['channelsoccupied'].": ".$descbusy."[/size][/b]".$footer;
		$tsAdmin->channelEdit($config['function']['checkchannels']['channelslist'], array
							(
							'channel_name' => $data,
							'channel_description' => $desc
							));
		if($editchannel)
		{
			$tsAdmin->channelEdit($config['function']['checkchannels']['channelslist'], array
							(
							'channel_description' => $desc
							));
			$editchannel = false;
		} 

		if($freechannelscount < $config['function']['checkchannels']['freechannelscount'])
		{
			$number++;
			
			$channelname = str_replace('[NUMBER]', $number, $config['function']['checkchannels']['channelname']);
			
			
			$tsAdmin->channelCreate(array
						(
						'channel_name' => $channelname,
						'channel_topic' => $config['function']['checkchannels']['channeltopic'],
						'channel_description' => "[b][size=15]".$number.". ".$language['checkchannels']['freechannel']."[/size][/b]".$footer,
						'cpid' => $config['function']['checkchannels']['channelzone'],
						'channel_flag_permanent' => 1,
						'channel_flag_maxclients_unlimited' => 0,
						'channel_flag_maxfamilyclients_unlimited' => 0,
						'channel_flag_maxfamilyclients_inherited' => 0,
						'channel_maxclients' => 0,
						'channel_maxfamilyclients' => 0,
						));	
			$editchannel = true;
		}
		else
		{
			if($config['function']['checkchannels']['channeltopic'] == $channeltopic && $freechannelscount > $config['function']['checkchannels']['freechannelscount'])
			{
				$tsAdmin->channelDelete($channelcid);
				$editchannel = true;
			}
		}
		
		unset($number);
		unset($number2);
		unset($freechannelscount);
		unset($descbusy);
		unset($descfree);
		unset($date);
		unset($channeltopic);
		unset($channelcid);
		unset($order);
		unset($setdate);
		unset($remainingtime);
		unset($interval);
		unset($channelname);
		unset($needname);
		unset($neednamecheck);
		unset($desc);
		unset($channel);
		unset($block);
		unset($i);
		unset($find);
	}
?>