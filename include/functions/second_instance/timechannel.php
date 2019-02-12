<?php 
function timechannel()
{
	global $config;
	global $tsAdmin;
	foreach($config['function']['timechannel']['info'] as $channel)
	{	
		$day = date('d');
		$month = date('m');
		$year = date('Y');
		$timeon = explode(":", $channel['timeon']);
		$timeoff = explode(":", $channel['timeoff']);
		$dateon = mktime($timeon[0], $timeon[1], 0, $month, $day, $year);
		$dateoff = mktime($timeoff[0], $timeoff[1], 0, $month, $day, $year);
		if(($dateon<=time()) && ($dateoff>=time()))
		{
			$tsAdmin->channelEdit($channel['channel'], array(
			'channel_name' => $channel['channelnameon'],
			'channel_maxclients' => -1
			));
		}
		else
		{
		$tsAdmin->channelEdit($channel['channel'], array(
			'channel_name' => $channel['channelnameoff'],
			'channel_maxclients' => 0
			));	
	}
	
	}
	unset($day);
	unset($month);
	unset($year);	
	unset($timeon);
	unset($timeoff);
	unset($dateon);
	unset($dateoff);
}
?>