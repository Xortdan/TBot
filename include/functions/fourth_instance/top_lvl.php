<?php 
function top_lvl()
{
	global $config;
	global $tsAdmin;
	global $connect;
	global $footer;
	$number = 1;
	$desc ="[center][size=14][color=green][b]Top lvl[/b][/color][/size][/center][hr]\n";
	$question = "Select nickname, rank, rank_sgid, UID FROM user_stats ORDER BY rank DESC limit ".$config['function']['top_lvl']['count'];
	$toplvl = mysqli_query($connect, $question);	
				
				while($top = mysqli_fetch_array($toplvl))
				{
					
					$desc .= "[size=12][b]".$number." . [URL=client://1/".$top['UID']."]".$top['nickname']."[/url] - [/b][/size]";
					$number++;
					if($config['function']['top_lvl']['icon'] && $top['rank'] != 0)
				{
						 	$desc .= "[img]".$config[2]['bot']['icons']['adress'].$top['rank_sgid'].".png[/img]"."\n";
						}
						else
						{
							$desc .= "[size=10][b]".$top['rank']." poziom[/b][/size]"."\n";
						}
				}
					
				$tsAdmin->channelEdit($config['function']['top_lvl']['channel'], array(
				'channel_description' => $desc.$footer, 
				));
	
}
?>