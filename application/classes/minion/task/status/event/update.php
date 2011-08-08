<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * @package    Status
 * @category   Minion Task
 * @author     Kiall Mac Innes
 * @copyright  (c) 2011 Kiall Mac Innes
 */
class Minion_Task_Status_Event_Update extends Minion_Task
{
	/**
	 * An array of config options that this task can accept
	 */
	protected $_config = array('id', 'service_id', 'event_level', 'timestamp', 'title', 'description', 'url');

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

		$event_level = ORM::factory('event_level', array(
			'name' => $config['event_level'],
		));

		if ( ! $event_level->loaded())
		{
			Minion_CLI::write('Invalid Event Level');
			return;
		}

		$service = ORM::factory('service', array(
			'name' => $config['service']
		));

		if ( ! $service->loaded())
		{
			Minion_CLI::write('Invalid Service');
			return;
		}

		try
		{
			$event->values($config, array(
				'service_id',
				'event_level_id',
				'timestamp',
				'title',
				'description',
				'url',
			));

			$event->values(array(
				'service_id'     => $service->id,
				'event_level_id' => $event_level->id,
			), array(
				'service_id',
				'event_level_id',
				'timestamp',
				'title',
				'description',
				'url',
			));

			$event->save();

			Minion_CLI::write('Sucessfully created the \''.$event->title.'\' event with ID \''.$event->id.'\'');
		}
		catch (ORM_Validation_Exception $e)
		{
			Minion_CLI::write('Validation Error');
		}
		catch (Exception $e)
		{
			Minion_CLI::write('Unknown Error ' . $e->getMessage());
		}
	}
}
