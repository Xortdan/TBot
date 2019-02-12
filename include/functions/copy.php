<?php 
function rank()
{
	global $config;
	global $tsAdmin;
	global $connect;
	global $footer;
	global $user;
	$count_rank = count($config['function']['rank']['info']);
	switch($config['function']['rank']['type'])
	{
		case 1: $type = "active_all"; break;
		case 2: $type = "time_all"; break;
		default: echo "Podaj poprawny typ"; break;
	}
	
	$question = "Select id, nickname, rank, next_rank, ".$type.", DBID, CLID, rank_sgid FROM user_stats WHERE online = 1;";
	
	$clients = mysqli_query($connect, $question);
	while($client = mysqli_fetch_array($clients))
	{
		$have_rank = false;
		$client_group = array_search($client['DBID'], array_column($user['data'], 'client_database_id'));
		$client_group = explode(",", $user['data'][$client_group]['client_servergroups']);
		foreach($config['function']['rank']['needrank'] as $need_rank)
		{
			foreach($client_group as $group)
			{
				if($group == $need_rank)
				{
					$have_rank = true;
				}
			}
		}
		if($have_rank)
		{
			$set_rank = false;
			foreach($config['function']['rank']['info'] as $key => $rank)
			{
				if($rank[1] > $client[$type])
				{
					if(($key - $client['rank']) > 1)
					{
						echo $client['nickname']."\n";
						$set_rank = true;
						$rank_id = $key - 1;
						$next_rank_id = $key;
						$rank_ssid = $rank[0];
					}
					break;
				}
				else if($key == $count_rank && $client[$type] > $rank[1] && $client['rank'] != $key)
				{
					$set_rank = true;
					$rank_id = $key;
					$next_rank_id = $key + 1;
					$rank_ssid = $rank[0];
				}
			}
		
			if($set_rank == true)
			{
				$question = "UPDATE user_stats set rank = ".$rank_id.", rank_sgid = ".$rank_ssid.", next_rank = ".$next_rank_id." WHERE id = '".$client['id']."';";
				mysqli_query($connect, $question);
				if($client['DBID'] == 2)
				{
					if($rank_id == $count_rank)
					{
						$msg = "Gratulacje użytkowniku. Osiągnąłeś ostatni ".$rank_id." poziom";
					}
					else
					{
						$data1 = time();
						$data2 = time() - $config['function']['rank']['info'][$next_rank_id][1] + $config['function']['rank']['info'][$rank_id][1];
						$difference = $data1 - $data2;
						$m = floor($difference / 60);
						$h = floor($m/60);
						$m = $m-($h*60);
						$d = floor($h/24);
						$h = $h-($d*24);
						$msg = "Awansowałeś na ".$rank_id." poziom. Następny poziom za {$d}d, {$h}h i {$m}m";
					}
				
					foreach($config['function']['rank']['info'] as $group)
					{
						//$tsAdmin -> serverGroupDeleteClient($group[0], $client['DBID']);
					}
					//$tsAdmin -> serverGroupAddClient($config['function']['rank']['info'][$rank_id][0], $client['DBID']);
					//$tsAdmin -> sendMessage(1, $client['CLID'], $msg);
					echo $client['nickname']." - ".$msg."\n";
				}
			}
		}
	}
}
?>