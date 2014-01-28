
CREATE TABLE IF NOT EXISTS `tbl_notes_list` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `text` text,
  `date` varchar(50) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

INSERT INTO `tbl_notes_list` (`id`, `title`, `text`, `date`, `author`, `image`) VALUES
	(24, 'тест1', 'тест', '24-04-2013', 'тест', NULL),
	(25, 'тест2', 'тест', '24-04-2013', 'тест', '');

