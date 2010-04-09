ALTER TABLE `accounts` ADD `page_access` int(11)

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `time` int(18) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) DEFAULT NULL,
  `body` text NOT NULL,
  `time` int(18) NOT NULL DEFAULT '0',
  `author` varchar(64) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `forums` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `access` int(5) unsigned NOT NULL,
  `closed` int(1) unsigned NOT NULL COMMENT 'Min. access to see the board',
  `moderators` text NOT NULL,
  `order` int(6) DEFAULT NULL,
  `requireLogin` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `text` text NOT NULL,
  `time` int(16) unsigned NOT NULL,
  `author` varchar(64) NOT NULL,
  `board_id` int(16) unsigned NOT NULL,
  `thread_id` int(16) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `threads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `sticked` tinyint(1) unsigned NOT NULL,
  `closed` tinyint(1) unsigned NOT NULL,
  `author` varchar(64) NOT NULL,
  `time` int(12) unsigned NOT NULL,
  `board_id` int(12) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;