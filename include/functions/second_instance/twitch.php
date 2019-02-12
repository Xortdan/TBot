<?php 
function twitch()
{
	global $config;
	global $tsAdmin;
	global $footer;
	global $language;
		
	foreach($config['function']['twitch']['info'] as $channel)
	{
		$nick = $channel['channelname'];
		$Header = array(
			'Client-ID: '.$config['function']['twitch']['twitchapi'],
			'Accept: application/vnd.twitchtv.v5+json'
		);
//channel_status
		$channel_curl = curl_init();
		curl_setopt($channel_curl, CURLOPT_AUTOREFERER, TRUE);
		curl_setopt($channel_curl, CURLOPT_HEADER, 0);
		curl_setopt($channel_curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($channel_curl, CURLOPT_URL, 'https://api.twitch.tv/helix/streams?user_login='.$nick);
		curl_setopt($channel_curl, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($channel_curl, CURLOPT_HTTPHEADER, $Header);
		$channel_stauts = curl_exec($channel_curl);
		curl_close($channel_curl);
		$channel_stauts = json_decode($channel_stauts);
	
//channel_info
		$channel_curl = curl_init();
		curl_setopt($channel_curl, CURLOPT_AUTOREFERER, TRUE);
		curl_setopt($channel_curl, CURLOPT_HEADER, 0);
		curl_setopt($channel_curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($channel_curl, CURLOPT_URL, 'https://api.twitch.tv/helix/users?login='.$nick);
		curl_setopt($channel_curl, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($channel_curl, CURLOPT_HTTPHEADER, $Header);
		$channel_info = curl_exec($channel_curl);
		curl_close($channel_curl);
		$channel_info = json_decode($channel_info);

		$channel_stauts = $channel_stauts->data;
		$channel_info = $channel_info->data;
		if(isset($channel_info[0]))
		{
			if(isset($channel_stauts[0]))
				$stauts = "ONLINE";
			else
				$stauts = "OFFLINE";
			
			$display_nick = $channel_info[0]->display_name;
			$channel_name = str_replace("[NICK]", $display_nick, $config['function']['twitch']['channelname']);
			$channel_name = str_replace("[STATUS]", $stauts, $channel_name);
			$avatar = $channel_info[0]->profile_image_url;
			$description = $channel_info[0]->description;
			$desc = "[center][img]https://www.iconfinder.com/icons/939743/download/png/128[/img]\n[size=15][b][url=https://www.twitch.tv/".$nick."]".$display_nick."[/url][/b][/size]\n\n[/center][hr][size=12]".$description."[/size]\n";
			echo $desc;
			$tsAdmin -> channelEdit($channel['channelid'], Array('CHANNEL_NAME' => $channel_name, 'CHANNEL_DESCRIPTION'=> $desc.$footer));
		}
		else
		{
			$tsAdmin -> channelEdit($channel['channelid'], Array('CHANNEL_NAME' => "[cspacer]BRAK KANAŁU", 'CHANNEL_DESCRIPTION'=> $desc.$footer));
		}

	}
	unset($channel_curl);
	unset($channel_stauts);
	unset($channel_info);
	unset($stauts);
	unset($display_nick);
	unset($channel_name);
	unset($avatar);
	unset($description);
	unset($desc);
}
?>