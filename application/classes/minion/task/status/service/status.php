<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * @package    Status
 * @category   Minion Task
 * @author     Kiall Mac Innes
 * @copyright  (c) 2011 Kiall Mac Innes
 */
class Minion_Task_Status_Service_Status extends Minion_Task
{
	/**
	 * An array of config options that this task can accept
	 */
	protected $_config = array('name', 'format');

	public function execute(array $config)
	{
		if (empty($config['format']))
		{
			$config['format'] = 'json';
		}

		$service = ORM::factory('service', array(
			'name' => $config['name'],
		));

		if ( ! $service->loaded())
		{
			Minion_CLI::write('Invalid Service');
			return;
		}

		if ($config['format'] == 'json')
		{
			Minion_CLI::write(json_encode($service->latest_event->as_array()));
			return;
		}
		else if ($config['format'] == 'dump')
		{
			Minion_CLI::write(var_export($service->latest_event->as_array(), TRUE));
			return;
		}
		else if ($config['format'] == 'php')
		{
			Minion_CLI::write(serialize($service->latest_event->as_array(), TRUE));
			return;
		}
		else
		{
			Minion_CLI::write('Unknown Format');
			return;
		}

		try
		{
			$service->values($config, array(
				'name',
				'description',
				'url',
			));

			$service->save();

			Minion_CLI::write('Sucessfully updated the \''.$service->name.'\' service with ID \''.$service->id.'\'');
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
