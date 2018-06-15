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
?>