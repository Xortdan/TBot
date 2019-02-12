<?php 
function botinfo()
	{
		global $config;
		global $tsAdmin;
		global $footer;
		global $language;
		$allramusage = 0;
		$all_active_functions = 0;
		$help_bot_status = "";
		$desc = "";
		for($i=1; $i<=5; $i++)
		{
			$corename = "core".$i.".php";
			$sheelsend = "pgrep -a php | grep '".$corename."'";
			$checkinstance = shell_exec('screen -list | grep -b "tBot"'.$i);
			if(!empty($checkinstance))
			{
				$file_name = "include/cache/instance_info/core".$i.".txt";
				$instance_info = file_get_contents($file_name);
				$instance_info = explode(",", $instance_info);
				$allramusage += $instance_info[0];
				if($instance_info[1] != 0)
				{
					$all_active_functions += $instance_info[1];
					 $functions_enable = "\naktywnych funkcji: ".$instance_info[1];
				}
				 else
					 $functions_enable = "";
				$desc .= "[img]https://www.iconfinder.com/icons/2318040/download/png/16[/img] [size=10][b]".$i." ".$language['botinfo']['instance']."[color=green] ".$language['botinfo']['on']."[/color] |  ".$language['botinfo']['ramusage'].": ".$instance_info[0]." MB".$functions_enable."[/b][/size][hr]\n";
				if($i == 3)
				{
					$help_bot_status = " (+helpbot)";
				}
			}
			else
			{
				$desc .= "[img]https://www.iconfinder.com/icons/2318040/download/png/16[/img] [size=10][b]".$i." ".$language['botinfo']['instance']."[color=red] ".$language['botinfo']['off']."[/color][/b][/size][hr]\n";
			}
				
		}
		$desc .= "[size=10][b] ".$language['botinfo']['together']." : ".$allramusage." MB\nAktywnych funkcji łącznie: ".$all_active_functions.$help_bot_status."[/b][/size]\n[right]Ostatnie sprawdzenie: ".date("H:i")."[/right]";
		$tsAdmin->channelEdit($config['function']['botinfo']['channel'], Array('CHANNEL_DESCRIPTION'=> $desc.$footer));
		
		unset($corename);
		unset($sheelsend);
		unset($sheel);
		unset($delname);
		unset($pid);
		unset($sheelsend);
		unset($ramusage);
		unset($allramusage);
		unset($desc);
	}
?>