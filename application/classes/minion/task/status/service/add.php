<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * @package    Status
 * @category   Minion Task
 * @author     Kiall Mac Innes
 * @copyright  (c) 2011 Kiall Mac Innes
 */
class Minion_Task_Status_Service_Add extends Minion_Task
{
	/**
	 * An array of config options that this task can accept
	 */
	protected $_config = array('name', 'description', 'url');

	public function execute(array $config)
	{
		$service = ORM::factory('service');

		try
		{
			$service->values($config, array(
				'name',
				'description',
				'url',
			));

			$service->save();

			Minion_CLI::write('Sucessfully created the \''.$service->name.'\' service with ID \''.$service->id.'\'');
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
