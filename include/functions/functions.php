<?php 
require_once("loop.php");
require_once("helpchannel.php");

require_once("first_instance/day.php");
require_once("first_instance/hour.php");
require_once("first_instance/useronline.php");
require_once("first_instance/register.php");
require_once("first_instance/recordonline.php");
require_once("first_instance/afk.php");
require_once("first_instance/pgroup.php");
require_once("first_instance/banlist.php");
require_once("first_instance/channelscount.php");
require_once("first_instance/visitors.php");
require_once("first_instance/packetloss.php");
require_once("first_instance/ping.php");
require_once("first_instance/uptime.php");

require_once("second_instance/groupclientcount.php");
require_once("second_instance/privatechannel.php");
require_once("second_instance/checkchannels.php");
require_once("second_instance/servername.php");
require_once("second_instance/clientstatus.php");
require_once("second_instance/timechannel.php");
require_once("second_instance/imieniny.php");
require_once("second_instance/monthrecord.php");
require_once("second_instance/youtube.php");
require_once("second_instance/welcomemessage.php");
require_once("second_instance/pokeonchannel.php");
require_once("second_instance/vpndetection.php");
require_once("second_instance/advertisement.php");
require_once("second_instance/botinfo.php");
require_once("second_instance/ddosdetection.php");



function groupname($search)
	{
		global $tsAdmin;
		global $groups;
		$groups = $tsAdmin->serverGroupList();
		$groupname = "";
		foreach($groups['data'] as $group)
		{
			if($group['sgid'] == $search)
			{
				$groupname = $group['name'];
			}
		}
		return $groupname;
	}
?>