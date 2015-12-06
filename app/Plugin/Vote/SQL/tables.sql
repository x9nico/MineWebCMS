CREATE TABLE IF NOT EXISTS `vote__votes` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `ip` int(16) NOT NULL,
  `website` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `vote__configurations` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `rewards_type` int(1) NOT NULL DEFAULT '0',
  `rewards` text NOT NULL,
  `websites` text NOT NULL,
  `servers` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `vote__configurations` (`id`, `rewards_type`, `rewards`, `websites`, `servers`) VALUES (1, 1, 'a:1:{i:0;a:4:{s:4:\"type\";s:6:\"server\";s:4:\"name\";s:7:\"Un /say\";s:7:\"command\";s:15:\"say récompense\";s:5:\"proba\";s:2:\"10\";}}', 'a:1:{i:0;a:4:{s:9:\"time_vote\";s:2:\"10\";s:9:\"page_vote\";s:16:\"http://google.fr\";s:12:\"website_type\";s:5:\"other\";s:6:\"rpg_id\";s:0:\"\";}}', 'a:1:{i:0;s:1:\"1\";}');