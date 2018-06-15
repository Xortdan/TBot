<?php 
function hour()
	{
		global $config;
		global $tsAdmin;
		$dataH = date('H');
		$datai = date('i');
		$data=str_replace('[HOUR]', $dataH, $config['function']['hour']['channelname']);
		$data=str_replace('[MINUTES]', $datai, $data);
		$check = $tsAdmin-> channelInfo($config['function']['hour']['channel']);
		if(strcmp($check['data']['channel_name'], $data) != 0)
		{
			$tsAdmin->channelEdit($config['function']['hour']['channel'], Array('CHANNEL_NAME'=> $data));
		}
	}
?>