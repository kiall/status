<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * @package    Status
 * @category   Minion Task
 * @author     Kiall Mac Innes
 * @copyright  (c) 2011 Kiall Mac Innes
 */
class Minion_Task_Status_Event_Level_Remove extends Minion_Task
{
	/**
	 * An array of config options that this task can accept
	 */
	protected $_config = array('id');

	public function execute(array $config)
	{
		$event_level = ORM::factory('event_level', array(
			'id' => $config['id'],
		));

		if ( ! $event_level->loaded())
		{
			Minion_CLI::write('Invalid Event Level ID');
			return;
		}

		$really = Minion_CLI::read('Are you sure you want to delete the \''.$event_level->name.'\' event level?', array('y','n'));

		if ($really == 'n')
			return;

		$old_event_level = clone $event_level;

		$event_level->delete();

		Minion_CLI::write('Sucessfully deleted the \''.$old_event_level->name.'\' event level with ID \''.$old_event_level->id.'\'');
	}
}
