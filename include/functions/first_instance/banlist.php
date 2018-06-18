<?php 
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
						$duration.=' minut';
					}
					else if($ban['duration']==3600)
					{
						$duration=$ban['duration']/3600;
						$duration.=' godzina';
					}
					else if($ban['duration']==7200 || $ban['duration']==10800 || $ban['duration']== 14400)
					{
						$duration=$ban['duration']/3600;
						$duration.=' godziny';
					}
					else if($ban['duration']>14400 && $ban['duration']<86400)
					{
						$duration=$ban['duration']/3600;
						$duration.=' godzin';
					}
					else if($ban['duration']==86400)
					{
						$duration=$ban['duration']/86400;
						$duration.=' dzień';
					}
					else if($ban['duration']>86400 && $ban['duration']<1528550754)
					{
						$duration=$ban['duration']/86400;
						$duration.=' dni';
					}
					else if($ban['duration']==0)
					{
						$duration=' permamentnie';
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
					$list2.='[color=blue][size=12]'.$nban.'.[/size][/color] '.$ban['lastnickname'].'\nBanujący: [URL=client://0/'.$ban['invokeruid'].'~'.$ban['invokername'].']'.$ban['invokername'].'[/URL]'
					.'\nPowód: '.$ban['reason'].'\nCzas trwania: '.$duration
					.'\nOd: '.$created.'\nDo: '.$to.'\n\n';
					$nban++;
				}
			}
		}
		$nban-=1;
		$list = "[center][color=blue][size=15][B]Lista banów[/B][/size][/color]\n[size=12][B]Wszystkich: $nban \n\n[/B][/size][/center]";
		$data = $list.$list2.$footer;
		
		$channelname = str_replace('[COUNT]', $nban, $config['function']['banlist']['channel_name']);
		$tsAdmin->channelEdit($config['function']['banlist']['channel'], array(
		'channel_description' => $data, 
		));
		if($config['function']['banlist']['channel_name_enable'])
		{
		$tsAdmin->channelEdit($config['function']['banlist']['channel'], array(
		'channel_name' =>$channelname
		));
		}
	}
?>