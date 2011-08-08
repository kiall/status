<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @package    Status
 * @category   Model
 * @author     Kiall Mac Innes
 * @copyright  (c) 2011 Kiall Mac Innes
 */

class Model_Service extends ORM {

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
	 * Has Many Relationships
	 *
	 * @var array
	 */
	protected $_has_many = array(
		'events' => array('model' => 'event'),
	);

	/**
	 * Varidation rules
	 *
	 * @return array
	 */
	public function rules()
	{
		return array(
			'name' => array(
				array('not_empty'),
				array('max_length', array(':value', 255)),
				array(array($this, 'unique'), array('name', ':value')),
			),
			'description' => array(
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