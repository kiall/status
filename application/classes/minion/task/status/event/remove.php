<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * @package    Status
 * @category   Minion Task
 * @author     Kiall Mac Innes
 * @copyright  (c) 2011 Kiall Mac Innes
 */
class Minion_Task_Status_Event_Remove extends Minion_Task
{
	/**
	 * An array of config options that this task can accept
	 */
	protected $_config = array('id');

	public function execute(array $config)
	{
		$event = ORM::factory('event', array(
			'id' => $config['id'],
		));

		if ( ! $event->loaded())
		{
			Minion_CLI::write('Invalid Event ID');
			return;
		}

		$really = Minion_CLI::read('Are you sure you want to delete the \''.$event->title.'\' event?', array('y','n'));

		if ($really == 'n')
			return;

		$old_event = clone $event;

		$event->delete();

		Minion_CLI::write('Sucessfully deleted the \''.$old_event->title.'\' event with ID \''.$old_event->id.'\'');
	}
}
