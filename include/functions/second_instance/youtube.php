<?php 
function youtube()
	{
		global $config;
		global $tsAdmin;
		global $footer;
		
		foreach($config['function']['youtube']['info'] as $channel)
		{
			$api = 'https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&id='.$channel['youtubechannel'].'&key='.$config['function']['youtube']['youtubeapi'];
			$channelyt = json_decode(file_get_contents($api));
			if(isset($channelyt->items[0]))
			{
				$data = "[center][IMG]https://s.ytimg.com/yts/img/favicon_96-vflW9Ec0w.png[/IMG]\n[size=15][b][URL=https://www.youtube.com/channel/".$channel['youtubechannel']."]".$channelyt->items[0]->snippet->title."[/URL]\nSubskrybujących: ".$channelyt->items[0]->statistics->subscriberCount."\nWyświetleń: ".$channelyt->items[0]->statistics->viewCount."\nFilmów: ".$channelyt->items[0]->statistics->videoCount."[/b][/size][/center][size=12]\n[hr]\n".$channelyt->items[0]->snippet->description."[/size]".$footer;
				$channelname = 	str_replace("[NICK]", $channelyt->items[0]->snippet->title, $config['function']['youtube']['channnelname']);	
				$channelname = 	str_replace("[SUBSCOUNT]", $channelyt->items[0]->statistics->subscriberCount, $channelname);
				$tsAdmin->channelEdit($channel['channelid'], Array('CHANNEL_DESCRIPTION'=> $data, 'CHANNEL_NAME'=> $channelname));
			}
			else
			{
				echo "Brak kanału";
				$tsAdmin->channelEdit($channel['channelid'], Array('CHANNEL_DESCRIPTION'=> "Brak kanału".$footer,'CHANNEL_NAME'=> "Brak kanału"));
			}
		 }
	}
?>