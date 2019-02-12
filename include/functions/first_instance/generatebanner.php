<?php 
function generatebanner()
	{
		global $footer;
		global $config;
		global $tsAdmin;
		global $online;
		$admincount = 0;
		
		$image = ImageCreateFromPng($config['function']['generatebanner']['image']);
		
	//user online	
		
		if($config['function']['generatebanner']['useronline']['enable'])
		{
			$color = $config['function']['generatebanner']['useronline']['color'];
			$position = $config['function']['generatebanner']['useronline']['position'];
			$color = ImageColorAllocate($image, $color[0],$color[0],$color[2]);
			ImageTTFText($image, $position[0],$position[1],$position[2],$position[3], $color, "include/cache/fonts/".$config['function']['generatebanner']['adminonline']['font'].".ttf", $online);
		}
		
	//admin online	
		
		if($config['function']['generatebanner']['adminonline']['enable'])
		{
			$color = $config['function']['generatebanner']['adminonline']['color'];
			$position = $config['function']['generatebanner']['adminonline']['position'];
			$color = ImageColorAllocate($image, $color[0],$color[0],$color[2]);
			
			foreach($config['function']['generatebanner']['adminonline']['adminsgroup'] as $group)
			{
				$admins = $tsAdmin -> serverGroupClientList($group, $names = true);
				foreach($admins['data'] as $admin)
				{
					$adminfind = $tsAdmin->clientFind($admin['client_nickname']);
					if($adminfind['data'])
					{
						$admincount++;
					}
				}
			
			}
			ImageTTFText($image, $position[0],$position[1],$position[2],$position[3], $color, "include/cache/fonts/".$config['function']['generatebanner']['adminonline']['font'].".ttf", $admincount);
		}
		
	//record online	
		
		if($config['function']['generatebanner']['recordonline']['enable'])
		{
			$filelocation = "include/cache/record.txt";
			$fo = fopen($filelocation, "r");
			$record = fread($fo, filesize($filelocation));
			$color = $config['function']['generatebanner']['recordonline']['color'];
			$position = $config['function']['generatebanner']['recordonline']['position'];
			$color = ImageColorAllocate($image, $color[0],$color[0],$color[2]);
			ImageTTFText($image, $position[0],$position[1],$position[2],$position[3], $color, "include/cache/fonts/".$config['function']['generatebanner']['recordonline']['font'].".ttf", $record);
		}
		
	//month record	
		
		if($config['function']['generatebanner']['monthrecord']['enable'])
		{
			$date = date('m-Y');
			$filelocation = "include/cache/month_record/".$date.".txt";
			$fo = fopen($filelocation, "r");
			$monthrecord = fread($fo, filesize($filelocation));
			
			$color = $config['function']['generatebanner']['monthrecord']['color'];
			$position = $config['function']['generatebanner']['monthrecord']['position'];
			$color = ImageColorAllocate($image, $color[0],$color[0],$color[2]);
			ImageTTFText($image, $position[0],$position[1],$position[2],$position[3], $color, "include/cache/fonts/".$config['function']['generatebanner']['monthrecord']['font'].".ttf", $monthrecord);
		}
		
	//time
	
		if($config['function']['generatebanner']['time']['enable'])
		{
			$color = $config['function']['generatebanner']['time']['color'];
			$position = $config['function']['generatebanner']['time']['position'];
			$color = ImageColorAllocate($image, $color[0],$color[0],$color[2]);
			ImageTTFText($image, $position[0],$position[1],$position[2],$position[3], $color, "include/cache/fonts/".$config['function']['generatebanner']['time']['font'].".ttf", date('H:i'));
		}
		
	//date	
		
		if($config['function']['generatebanner']['date']['enable'])
		{
			$color = $config['function']['generatebanner']['date']['color'];
			$position = $config['function']['generatebanner']['date']['position'];
			$color = ImageColorAllocate($image, $color[0],$color[0],$color[2]);
			ImageTTFText($image, $position[0],$position[1],$position[2],$position[3], $color, "include/cache/fonts/".$config['function']['generatebanner']['date']['font'].".ttf", date('d.m.Y'));
		}
		
		imagepng($image, $config['function']['generatebanner']['savethere']); 
    		imagedestroy($image);
	}
?>