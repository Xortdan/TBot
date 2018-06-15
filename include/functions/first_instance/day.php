<?php 
function day()
	{
		global $config;
		global $tsAdmin;
		$datad = date('d');
		$datam = date('m');
		$datay = date('Y');
		$data=str_replace('[DAY]', $datad, $config['function']['day']['channelname']);
		$data=str_replace('[MONTH]', $datam, $data);
		$data=str_replace('[YEAR]', $datay, $data);
		$check = $tsAdmin-> channelInfo($config['function']['day']['channel']);
		if(strcmp($check['data']['channel_name'], $data) != 0)
		{
			$tsAdmin->channelEdit($config['function']['day']['channel'], Array('CHANNEL_NAME'=> $data));
		}
	}
?>