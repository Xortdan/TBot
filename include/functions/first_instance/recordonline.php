<?php 
function recordonline()
	{
		global $config;
		global $tsAdmin;
		global $record;
		global $online;
		global $footer;
		if($record !=null)
		{
			if($online>$record)
			{
				$ff = fopen("include/cache/month_record.txt", "w");
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
			$time = filemtime("include/cache/record.txt"); 
			$date = date("G:i d.m.Y", $time);
			$desc = "[CENTER][SIZE=15][B]REKORD\n[COLOR=GREEN]".$record."[/COLOR]\n".$date."[/B][/SIZE][/CENTER]".$footer;
			$tsAdmin->channelEdit($config['function']['recordonline']['channel'], Array('CHANNEL_NAME'=> $data, 'CHANNEL_DESCRIPTION' => $desc));
		}
	}
?>