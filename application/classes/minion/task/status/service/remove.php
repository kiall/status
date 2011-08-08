<?php defined('SYSPATH') or die('No direct script access.');

/**
 *
 * @package    Status
 * @category   Minion Task
 * @author     Kiall Mac Innes
 * @copyright  (c) 2011 Kiall Mac Innes
 */
class Minion_Task_Status_Service_Remove extends Minion_Task
{
	/**
	 * An array of config options that this task can accept
	 */
	protected $_config = array('id');

	public function execute(array $config)
	{
		$service = ORM::factory('service', array(
			'id' => $config['id'],
		));

		if ( ! $service->loaded())
		{
			Minion_CLI::write('Invalid Service ID');
			return;
		}

		$really = Minion_CLI::read('Are you sure you want to delete the \''.$service->name.'\' service?', array('y','n'));

		if ($really == 'n')
			return;

		$old_service = clone $service;

		$service->delete();

		Minion_CLI::write('Sucessfully deleted the \''.$old_service->name.'\' service with ID \''.$old_service->id.'\'');
	}
}
