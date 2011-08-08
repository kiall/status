<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Initial Services Table
 *
 * @package    Status
 * @category   Model
 * @author     Kiall Mac Innes
 * @copyright  (c) 2011 Kiall Mac Innes
 */
class Migration_Status_20110808103322 extends Minion_Migration_Base {

	/**
	 * Run queries needed to apply this migration
	 *
	 * @param Kohana_Database Database connection
	 */
	public function up(Kohana_Database $db)
	{
		$db->query(NULL, 'CREATE TABLE  `services` (
`id` INT( 255 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 255 ) NOT NULL ,
`description` VARCHAR( 255 ) NOT NULL ,
`url` VARCHAR( 255 ) NULL DEFAULT NULL ,
`created` INT( 10 ) UNSIGNED NOT NULL ,
`updated` INT( 10 ) UNSIGNED NULL DEFAULT NULL
) ENGINE = INNODB;');
	}

	/**
	 * Run queries needed to remove this migration
	 *
	 * @param Kohana_Database Database connection
	 */
	public function down(Kohana_Database $db)
	{
		$db->query(NULL, 'DROP TABLE  `services`');
	}
}
