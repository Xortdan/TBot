<?php 
	function banlist()
	{
		global $footer;
		global $config;
		global $tsAdmin;
		global $nban;
		global $language;
		$nban = 1;
		$list2 = "";
		$blist = $tsAdmin->banList();
		$lban = count($blist);
		if(!empty($blist['data']))
		{
			foreach($blist['data'] as $ban)
			{
				if(empty($ban['lastnickname']))
				{
					continue;
				}
				else
				{
					if($ban['duration']>60 && $ban['duration']<3600)
					{
						$duration=$ban['duration']/60;
						$duration.=' '.$language['banlist']['minutes'];
					}
					else if($ban['duration']==3600)
					{
						$duration=$ban['duration']/3600;
						$duration.=' '.$language['banlist']['hour'];
					}
					else if($ban['duration']==7200 || $ban['duration']==10800 || $ban['duration']== 14400)
					{
						$duration=$ban['duration']/3600;
						$duration.=' '.$language['banlist']['hours'];
					}
					else if($ban['duration']>14400 && $ban['duration']<86400)
					{
						$duration=$ban['duration']/3600;
						$duration.=' '.$language['banlist']['hours2'];
					}
					else if($ban['duration']==86400)
					{
						$duration=$ban['duration']/86400;
						$duration.=' '.$language['banlist']['day'];
					}
					else if($ban['duration']>86400 && $ban['duration']<1528550754)
					{
						$duration=$ban['duration']/86400;
						$duration.=' '.$language['banlist']['days'];
					}
					else if($ban['duration']==0)
					{
						$duration=' '.$language['banlist']['permament'];
					}
					if($ban['duration']==0)
					{
						$to = "∞";
						$rem = "∞";
					}
					else
					{
						$to = $ban['created']+$ban['duration'];
						$to = date("d.m.o G:s",$to);
					}
					
					$created = date("j.m.o H:s",$ban['created']);
					$list2.='[size=12][color=blue]'.$nban.'.[/color] [b]'.$ban['lastnickname'].'[/b][/size] ['.$ban['banid'].'][hr]\n[size=10]'."[img]https://www.iconfinder.com/icons/2123927/download/png/20[/img] ".$language['banlist']['by'].': [URL=client://0/'.$ban['invokeruid'].']'.$ban['invokername'].'[/URL]'
					.'\n[img]https://www.iconfinder.com/icons/2124294/download/png/20[/img] '.$language['banlist']['reason'].': '.$ban['reason'].'\n[img]https://www.iconfinder.com/icons/2124097/download/png/20[/img] '.$language['banlist']['duration'].': '.$duration
					.'\n[img]https://www.iconfinder.com/icons/809573/download/png/20[/img] '.$language['banlist']['from'].': '.$created.'\n[img]https://www.iconfinder.com/icons/809573/download/png/20[/img] '.$language['banlist']['to'].': '.$to.'[/size]\n\n';
					$nban++;
				}
			}
		}
		$nban-=1;
		$list = "[center][color=blue][size=15][B]".$language['banlist']['banlist']."[/B][/size][/color]\n[size=12][B]".$language['banlist']['all'].": $nban \n\n[/B][/size][/center]";
		$data = $list.$list2.$footer;
		
		$channelname = str_replace('[COUNT]', $nban, $config['function']['banlist']['channel_name']);
		$tsAdmin->channelEdit($config['function']['banlist']['channel'], array(
		'channel_description' => $data, 
		));
		if($config['function']['banlist']['channel_name_enable'])
		{
			$check = $tsAdmin-> channelInfo($config['function']['banlist']['channel']);
			if(strcmp($check['data']['channel_name'], $channelname) != 0)
			{
				$tsAdmin->channelEdit($config['function']['banlist']['channel'], array(
				'channel_name' =>$channelname
				));
			}
		}
	}
?>