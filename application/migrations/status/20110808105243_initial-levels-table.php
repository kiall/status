<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Initial Levels Table
 *
 * @package    Status
 * @category   Model
 * @author     Kiall Mac Innes
 * @copyright  (c) 2011 Kiall Mac Innes
 */
class Migration_Status_20110808105243 extends Minion_Migration_Base {

	/**
	 * Run queries needed to apply this migration
	 *
	 * @param Kohana_Database Database connection
	 */
	public function up(Kohana_Database $db)
	{
		$db->query(NULL, 'CREATE TABLE  `event_levels` (
`id` INT( 255 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 255 ) NOT NULL ,
`image` VARCHAR( 255 ) NOT NULL ,
`created` INT( 10 ) NOT NULL ,
`updated` INT( 10 ) NULL DEFAULT NULL
) ENGINE = INNODB');

		$db->query(NULL, "INSERT INTO `event_levels` (`id`, `name`, `image`, `created`, `updated`) VALUES
	(NULL, 'info', 'media/img/info.png', UNIX_TIMESTAMP(), NULL),
	(NULL, 'normal', 'media/img/normal.png', UNIX_TIMESTAMP(), NULL),
	(NULL, 'warning', 'media/img/warning.png', UNIX_TIMESTAMP(), NULL),
	(NULL, 'error', 'media/img/error.png', UNIX_TIMESTAMP(), NULL),
	(NULL, 'critical', 'media/img/critical.png', UNIX_TIMESTAMP(), NULL)");

		$db->query(NULL, 'ALTER TABLE `events` ADD `event_level_id` INT( 255 ) NOT NULL AFTER  `service_id` , ADD INDEX (  `event_level_id` )');

		$db->query(NULL, "ALTER TABLE `events` ADD CONSTRAINT `event_level_id_fk` FOREIGN KEY  (`event_level_id` ) REFERENCES  `event_levels` (`id`) ON DELETE RESTRICT");

	}

	/**
	 * Run queries needed to remove this migration
	 *
	 * @param Kohana_Database Database connection
	 */
	public function down(Kohana_Database $db)
	{
		$db->query(NULL, 'ALTER TABLE  `events` DROP FOREIGN KEY  `event_level_id_fk`');

		$db->query(NULL, 'ALTER TABLE  `events` DROP  `event_level_id`');

		$db->query(NULL, 'DROP TABLE `event_levels`');
	}
}
