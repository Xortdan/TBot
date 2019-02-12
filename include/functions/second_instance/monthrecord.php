<?php 
function monthrecord()
	{
		global $config;
		global $tsAdmin;
		global $monthrecord;
		global $online;
		global $footer;
		$date = date('m-Y');
		$filelocation = "include/cache/month_record/".$date.".txt";
		/* $fo = fopen($filelocation, "w+");
		$monthrecord = fread($fo, filesize($filelocation));
		fclose($fo);
		if(!filesize($filelocation))
		{
			$fo = fopen($filelocation, "w+");
			fputs($fo, $online);
			fclose($fo);
		}
		else
		{
			if($online>$monthrecord)
			{
				$fo = fopen($filelocation, "w+");
				fputs($fo, $online);
				fclose($fo);
			}
		} */
		
		if(is_file($filelocation))
		{
			$fo = fopen($filelocation, "r");
				$monthrecord = fread($fo, filesize($filelocation));
				fclose($fo);
			if($online>$monthrecord)
			{
				$fo = fopen($filelocation, "w+");
				$monthrecord = $online;
				fputs($fo, $online);
				fclose($fo);
			}
		}
		else
		{
				$fo = fopen($filelocation, "w+");
				fputs($fo, $online);
				fclose($fo);
				$monthrecord = $online;
				echo "tst";
		}
		
		/* if(isset($monthrecord))
		{
			//$monthrecord = fread($fo, filesize($filelocation));
			
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
		} */
		$data = str_replace('[RECORD]', $monthrecord, $config['function']['monthrecord']['channelname']);
		$check = $tsAdmin-> channelInfo($config['function']['monthrecord']['channel']);
		if(strcmp($check['data']['channel_name'], $data) != 0)
		{
			$time = filemtime($filelocation); 
			$date = date("G:i d.m.Y", $time);
			$desc = "[CENTER][SIZE=15][B]REKORD MIESIĄCA\n[COLOR=GREEN]".$monthrecord."[/COLOR]\n".$date."[/B][/SIZE][/CENTER]".$footer;
			$tsAdmin->channelEdit($config['function']['monthrecord']['channel'], Array('CHANNEL_NAME' => $data, 'CHANNEL_DESCRIPTION' => $desc));
		}
		
		unset($date);
		unset($filelocation);
		unset($check);
	}
?>