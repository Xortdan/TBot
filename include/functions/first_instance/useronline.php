<?php 
function useronline()
	{
		global $config;
		global $tsAdmin;
		global $online;
		if($online==1)
		{
			$user="użytkownik";
		}
		else 
		{
			$user="użytkowników";
		}
		$data= str_replace('[ONLINE]', $online, $config['function']['useronline']['channelname']);
		$data= str_replace('[USER]', $user, $data);
		$check = $tsAdmin-> channelInfo($config['function']['useronline']['channel']);
		if(strcmp($check['data']['channel_name'], $data) != 0)
		{
			$tsAdmin->channelEdit($config['function']['useronline']['channel'], Array('CHANNEL_NAME'=> $data));
		}
	}
?>