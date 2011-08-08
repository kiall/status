<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @package    Status
 * @category   Model
 * @author     Kiall Mac Innes
 * @copyright  (c) 2011 Kiall Mac Innes
 */

class Model_Event extends ORM {

	/**
	 * Auto-update columns for updates
	 * @var array
	 */
	protected $_updated_column = array(
		'column' => 'updated',
		'format' => TRUE,
	);

	/**
	 * Auto-update columns for creation
	 * @var array
	 */
	protected $_created_column = array(
		'column' => 'created',
		'format' => TRUE,
	);

	/**
	 * Belongs To Relationships
	 *
	 * @var array
	 */
	protected $_belongs_to = array(
		'service' => array(
			'model' => 'service',
		),
		'event_level' => array(
			'model' => 'event_level',
		),
	);

	/**
	 * Varidation rules
	 *
	 * @return array
	 */
	public function rules()
	{
		return array(
			'title' => array(
				array('not_empty'),
				array('max_length', array(':value', 255)),
			),
			'url' => array(
				array('url'),
				array('max_length', array(':value', 255)),
			),
		);
	}

}