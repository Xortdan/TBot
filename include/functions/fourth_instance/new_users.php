<?php 
function new_users()
{
	global $config;
	global $tsAdmin;
	global $connect;
	global $footer;
	$number = 1;
	$data ="[center][size=14][b]Nowi użytkownicy[/b][/size][/center][hr]";
	$question = "Select nickname FROM user_stats ORDER BY id DESC limit ".$config['function']['new_users']['count'];
	$toptime = mysqli_query($connect, $question);	
				
				while($top = mysqli_fetch_array($toptime))
				{
					
					$data .= "[size=10][b]".$number.". ".$top['nickname']."[hr][/b][/size]";
					$number++;
				}
				$tsAdmin->channelEdit($config['function']['new_users']['channel'], array(
				'channel_description' => $data.$footer, 
				));
	
}
?>