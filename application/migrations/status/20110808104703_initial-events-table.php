<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Initial Events Table
 *
 * @package    Status
 * @category   Model
 * @author     Kiall Mac Innes
 * @copyright  (c) 2011 Kiall Mac Innes
 */
class Migration_Status_20110808104703 extends Minion_Migration_Base {

	/**
	 * Run queries needed to apply this migration
	 *
	 * @param Kohana_Database Database connection
	 */
	public function up(Kohana_Database $db)
	{
		$db->query(NULL, 'CREATE TABLE `events` (
`id` INT( 255 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`service_id` INT( 255 ) NOT NULL ,
`timestamp` INT( 10 ) UNSIGNED NOT NULL ,
`title` VARCHAR( 255 ) NOT NULL ,
`description` TEXT NULL DEFAULT NULL ,
`url` VARCHAR( 255 ) NULL DEFAULT NULL ,
`created` INT( 10 ) UNSIGNED NOT NULL ,
`updated` INT( 10 ) UNSIGNED NULL DEFAULT NULL ,
INDEX (  `service_id` )
) ENGINE = INNODB;');

		$db->query(NULL, 'ALTER TABLE  `events` ADD CONSTRAINT `service_id_fk` FOREIGN KEY (  `service_id` ) REFERENCES  `services` (`id`) ON DELETE CASCADE');
	}

	/**
	 * Run queries needed to remove this migration
	 *
	 * @param Kohana_Database Database connection
	 */
	public function down(Kohana_Database $db)
	{
		$db->query(NULL, 'DROP TABLE `events`');
	}
}
