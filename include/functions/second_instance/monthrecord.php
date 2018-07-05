<?php 
function monthrecord()
	{
		global $config;
		global $tsAdmin;
		global $monthrecord;
		global $online;
		$date = date('m-Y');
		$filelocation = "include/cache/month_record/".$date.".txt";
		if(isset($monthrecord))
		{
			if($online>$monthrecord)
			{
				$ff = fopen($filelocation, "w+");
				fputs($ff, $online);
				fclose($ff);
				$monthrecord=$online;
			}
		}
		else
		{
			$fo = fopen($filelocation, "a+");
				if(!filesize($filelocation))
				{
					$fo2 = fopen($filelocation, "w+");
					$monthrecord = $online;
					fputs($fo2, $monthrecord);
					fclose($fo2); 
				}
				else
				{		
					$monthrecord = fread($fo, filesize($filelocation));
				}
		
			fclose($fo); 
		}
		$data= str_replace('[RECORD]', $monthrecord, $config['function']['monthrecord']['channelname']);
		$check = $tsAdmin-> channelInfo($config['function']['monthrecord']['channel']);
		if(strcmp($check['data']['channel_name'], $data) != 0)
		{
			$tsAdmin->channelEdit($config['function']['monthrecord']['channel'], Array('CHANNEL_NAME'=> $data));
		}
	}
?>