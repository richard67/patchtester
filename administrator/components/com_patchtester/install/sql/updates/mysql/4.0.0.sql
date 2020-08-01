ALTER TABLE `#__patchtester_pulls` ADD COLUMN `is_npm` tinyint(1) DEFAULT 0 AFTER `is_rtc`;

CREATE TABLE IF NOT EXISTS `#__patchtester_pulls_labels`
(
    `id`      int(11)                                 NOT NULL AUTO_INCREMENT,
    `pull_id` int(11)                                 NOT NULL,
    `name`    varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
    `color`   varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
