<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * @package    Status
 * @category   Minion Task
 * @author     Kiall Mac Innes
 * @copyright  (c) 2011 Kiall Mac Innes
 */
class Minion_Task_Status_Event_Level_Update extends Minion_Task
{
	/**
	 * An array of config options that this task can accept
	 */
	protected $_config = array('name', 'image');

	public function execute(array $config)
	{
		$event_level = ORM::factory('event_level', array(
			'name' => $config['name'],
		));

		if ( ! $event_level->loaded())
		{
			Minion_CLI::write('Invalid Event Level');
			return;
		}

		try
		{
			$event_level->values($config, array(
				'image',
			));

			$event_level->save();

			Minion_CLI::write('Sucessfully updated the \''.$event_level->name.'\' event level with ID \''.$event_level->id.'\'');
		}
		catch (ORM_Validation_Exception $e)
		{
			Minion_CLI::write('Validation Error');
		}
		catch (Exception $e)
		{
			Minion_CLI::write('Unknown Error');
		}
	}
}
