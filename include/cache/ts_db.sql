CREATE TABLE `bans_list` (
 `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
 `name_banned` varchar(30) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
 `reason` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
 `name_by` varchar(30) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
 `date_banned` bigint(20) unsigned NOT NULL,
 `date_delete` bigint(20) unsigned NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `channels` (
 `id` int(9) NOT NULL AUTO_INCREMENT,
 `CID` int(9) NOT NULL,
 `PID` int(9) NOT NULL,
 `channel_name` text CHARACTER SET utf8 COLLATE utf8_polish_ci,
 `channel_desc` text CHARACTER SET utf8 COLLATE utf8_polish_ci,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `commands` (
 `id` int(9) NOT NULL AUTO_INCREMENT,
 `command` text NOT NULL,
 `type` int(2) NOT NULL,
 `CLID` int(6) DEFAULT NULL,
 `BDID` int(6) unsigned DEFAULT NULL,
 `CID` int(9) unsigned NOT NULL,
 `channel_name` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
 `channel_desc` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `problems` (
 `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
 `number` int(6) NOT NULL,
 `nickname` text NOT NULL,
 `DBID` int(6) NOT NULL,
 `UID` varchar(100) NOT NULL,
 `problem` text NOT NULL,
 `time` int(20) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `res_stats` (
 `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
 `week` tinyint(1) unsigned NOT NULL DEFAULT '0',
 `month` tinyint(2) unsigned NOT NULL DEFAULT '0',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `server_groups` (
 `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
 `id_group` int(6) unsigned NOT NULL,
 `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
 `icon` text NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `server_info` (
 `id` int(1) unsigned NOT NULL,
 `online` int(6) NOT NULL,
 `max_clients` int(6) NOT NULL,
 `uptime` int(9) NOT NULL,
 `ping` int(6) NOT NULL,
 `loss` int(6) NOT NULL,
 `admins_list` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `server_usage` (
 `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
 `time` bigint(20) unsigned NOT NULL,
 `clients` int(5) unsigned NOT NULL,
 `channels` int(6) unsigned NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18982 DEFAULT CHARSET=utf8mb4;

	
CREATE TABLE `user_stats` (
 `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
 `nickname` varchar(30) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
 `UID` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
 `DBID` int(6) NOT NULL,
 `CLID` int(6) NOT NULL,
 `ip` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
 `last_seen` bigint(20) unsigned NOT NULL,
 `channel` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
 `channel_id` int(6) unsigned NOT NULL,
 `admin_on_channels` text CHARACTER SET utf8 COLLATE utf8_polish_ci,
 `connections` int(6) unsigned NOT NULL DEFAULT '0',
 `online` tinyint(1) unsigned NOT NULL DEFAULT '0',
 `online_time` bigint(20) unsigned NOT NULL DEFAULT '0',
 `online_record` int(10) unsigned NOT NULL DEFAULT '0',
 `idle` tinyint(1) unsigned NOT NULL DEFAULT '0',
 `idle_week` bigint(20) unsigned NOT NULL DEFAULT '0',
 `idle_month` bigint(20) unsigned NOT NULL DEFAULT '0',
 `idle_all` bigint(20) unsigned NOT NULL DEFAULT '0',
 `active_week` bigint(20) unsigned NOT NULL DEFAULT '0',
 `active_month` bigint(20) unsigned NOT NULL DEFAULT '0',
 `active_all` bigint(20) unsigned NOT NULL DEFAULT '0',
 `time_week` bigint(20) unsigned NOT NULL DEFAULT '0',
 `time_month` bigint(20) unsigned NOT NULL DEFAULT '0',
 `time_all` bigint(20) unsigned NOT NULL DEFAULT '0',
 `rank` bigint(20) unsigned NOT NULL,
 `rank_sgid` int(6) NOT NULL,
 `next_rank` int(6) NOT NULL DEFAULT '1',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=892 DEFAULT CHARSET=utf8mb4;

INSERT INTO `res_stats` (`id`, `week`, `month`) VALUES
(1, 1, 1);

INSERT INTO `server_info` VALUES
(1, 0, 0, 0, 0, 0, '');