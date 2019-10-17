CREATE TABLE IF NOT EXISTS `#__patchtester_chain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `insert_id` int(11) NOT NULL,
  `pull_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;