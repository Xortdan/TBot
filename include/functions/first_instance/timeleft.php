<?php
		
	function timeleft()
	{
		global $config;
		global $tsAdmin;
		
		function times($time)
	{
		$difference = $time - time();
		$m = floor($difference / 60);
		$h = floor($m/60);
		$m = $m-($h*60);
		$d = floor($h/24);
		$h = $h-($d*24);
		$echotime = $d."d ".$h."h ".$m."m";
		return $echotime;
	}
		
		foreach($config['function']['timeleft']['info'] as $lefttime)
		{
			$day = explode(".", $lefttime['time']);
			$year = explode(" ", $day[2]);
			$hour = explode(":", $year[1]);
			print_r($day);
			$time = mktime($hour[0], $hour[1], 0, $day[1], $day[0], $year[0]);
			if((time() - $time) < 0)
			{
				$data = str_replace("[left]", times($time), $lefttime['channelname']);
				$tsAdmin->channelEdit($lefttime['channel'], Array('CHANNEL_NAME'=> $data));
			}
			else
			{
				$tsAdmin->channelEdit($lefttime['channel'], Array('CHANNEL_NAME'=> $lefttime['channelnameafter']));
			}
		}
	}
?> 