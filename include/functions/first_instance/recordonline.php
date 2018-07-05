<?php 
function recordonline()
	{
		global $config;
		global $tsAdmin;
		global $record;
		global $online;
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
			$tsAdmin->channelEdit($config['function']['recordonline']['channel'], Array('CHANNEL_NAME'=> $data));
		}
	}
?>