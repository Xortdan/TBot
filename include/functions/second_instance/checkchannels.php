<?php 
function checkchannels()
	{
		global $config;
		global $tsAdmin;
		global $footer;
		global $channelcid;
		global $channeltopic;
		global $channels;
		$number = 0;
		$number2 = 0;
		$freechannelscount = 0;
		$descbusy = "";
		$descfree = "";
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
					$descbusy .= "[URL=channelid://".$channel['cid']."]".$number."[/URL], ";
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
		$data = str_replace('[COUNT]', $number2, $config['function']['checkchannels']['channelzonename']);
		$desc = "[b][size=15]Kanały zajęte: ".$descbusy."\nKanały wolne: ".$descfree."[/size][/b]";
		$tsAdmin->channelEdit($config['function']['checkchannels']['channelzone'], array
							(
							'channel_name' => $data,
							'channel_description' => $desc
							));
	}
?>