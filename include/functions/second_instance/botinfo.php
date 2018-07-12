<?php 
function botinfo()
	{
		global $config;
		global $tsAdmin;
		global $footer;
		global $language;
		$allramusage = 0;
		$desc = "";
		for($i=1; $i<4; $i++)
		{
			$corename = "core".$i.".php";
			$sheelsend = "pgrep -a php | grep '".$corename."'";
			$checkinstance = shell_exec('screen -list | grep -b "xTrustBot"'.$i);
			if(!empty($checkinstance))
			{
				$sheel = shell_exec($sheelsend);
				$delname = " php ".$corename;
				$pid = str_replace($delname, "", $sheel);
				$pid = trim($pid, " \n.");
				$sheelsend = "cat /proc/".$pid."/smaps | grep -m 1 -e ^Size: | awk '{print $2}'";
				$sheel = shell_exec($sheelsend);
				$ramusage =  round ((int)$sheel/1024 , 0);
				$allramusage += $ramusage;
				$desc .= "[img]https://www.iconfinder.com/icons/2318040/download/png/16[/img] [size=10][b]".$i." ".$language['botinfo']['instance']."[color=green] ".$language['botinfo']['on']."[/color] |  ".$language['botinfo']['ramusage'].": ".$ramusage." MB[/b][/size][hr]\n";
			}
			else
			{
				$desc .= "[img]https://www.iconfinder.com/icons/2318040/download/png/16[/img] [size=10][b]".$i." ".$language['botinfo']['instance']."[color=red] ".$language['botinfo']['off']."[/color][/b][/size][hr]\n";
			}
				
		}
		$desc .= "[size=10][b] ".$language['botinfo']['together']." : ".$allramusage." MB[/b][/size]\n";
		$tsAdmin->channelEdit($config['function']['botinfo']['channel'], Array('CHANNEL_DESCRIPTION'=> $desc.$footer));
	}
?>