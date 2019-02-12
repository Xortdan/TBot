<?php
require_once("include/configs/config.php");
echo "
		\e[1m \e[32m 
▀▀█▀▀ █▀▀▄ █▀▀█ ▀▀█▀▀
░░█░░ █▀▀▄ █░░█ ░░█░░
░░▀░░ ▀▀▀░ ▀▀▀▀ ░░▀░░
\e[0m";
	
while($config['control']['enable'])
{
	for($i=1; $i<=5; $i++)
	{
		$corename = "core".$i.".php";
		
		$checkinstance = shell_exec('screen -list | grep -b "tBot"'.$i);
		if(!empty($checkinstance))
		{
			$file_name = "include/cache/instance_info/core".$i.".txt";
			$ramusage = file_get_contents($file_name);
			$ramusage = explode(",", $ramusage);
			if($ramusage[0] >= $config['control']['max_ram'])
			{
				$sheelsend = "./starter.sh restart".$i;
				shell_exec($sheelsend);
				$msg = date('H:i d.m.Y')." zresetowano ".$i." instancję\n";
				echo $msg;
				$fo = fopen("include/logs/control.txt", "a");
				fputs($fo, $msg);
				fclose($fo);
			}		
		}
	 	else
		{
			if($config[$i]['enable'])
			{
				shell_exec('./starter.sh start'.$i);
				$msg = date('H:i d.m.Y')." Uruchomiono ".$i." instancję\n";
				echo $msg;
				$fo = fopen("include/logs/control.txt", "a");
				fputs($fo, $msg);
				fclose($fo);
			}
		} 
				
	}
	unset($corename);
	unset($sheelsend);
	unset($checkinstance);
	unset($file_name);
	unset($ramusage);
	unset($msg);
	sleep($config['control']['speed']);
}	
?>