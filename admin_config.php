<?php
/*
 * Twits - A Twitter status display menu for e107
 *
 * Copyright (C) 2010-2015 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.mkd file.
 *
 */
require_once('../../class2.php');
if (!getperms('P'))
{
	header('location:'.e_BASE.'index.php');
	exit;
}
e107::lan('twits', 'admin', true);

class twits_adminArea extends e_admin_dispatcher
{
	protected $modes = array(
		'main'	=> array(
			'controller' 	=> 'twits_ui',
			'path' 			=> null,
			'ui' 			=> 'twits_form_ui',
			'uipath' 		=> null
		),
	);

	protected $adminMenu = array(
		'main/prefs' 		=> array('caption'=> LAN_PREFS, 'perm' => 'P'),
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list',
		'main/list' => 'main/prefs'
	);

	protected $menuTitle = 'twits';
}

class twits_ui extends e_admin_ui
{

	protected $pluginTitle		= 'Twits';
	protected $pluginName		= 'twits';
	//	protected $eventName		= 'twits-'; // remove comment to enable event triggers in admin.
	protected $table			= '';
	protected $pid				= '';
	protected $perPage			= 10;
	protected $batchDelete		= true;
	//	protected $batchCopy		= true;
	//	protected $sortField		= 'somefield_order';
	//	protected $orderStep		= 10;
	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable.

	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.

	protected $listOrder		= ' DESC';

	protected $fields 		= NULL;

	protected $fieldpref = array();

	protected $preftabs = array('General', 'OAuth');
	protected $prefs = array(
		'header' => array(
			'title' => LAN_TWITS_CONFIG_01_A,
			'tab' => 0,
			'type' =>'text',
			'data' => 'str',
			'help' =>LAN_TWITS_CONFIG_01_B
		),
		'username' => array(
			'title' => LAN_TWITS_CONFIG_02,
			'tab' => 0,
			'type' =>'text',
			'data' => 'str',
			'help' => ''
		),
		'dateformat' => array(
			'title' => LAN_TWITS_CONFIG_03_A,
			'tab' => 0,
			'type' => 'dropdown',
			'data' => 'str',
			'help' => LAN_TWITS_CONFIG_03_B
		),
		'tweets' => array(
			'title' => LAN_TWITS_CONFIG_04,
			'tab' => 0,
			'type' => 'number',
			'data' => 'str',
			'help' => ''
		),
		'replies' => array(
			'title' => LAN_TWITS_CONFIG_05,
			'tab' => 0,
			'type' => 'boolean',
			'data' => 'str',
			'help' => ''
		),
		'retweets' => array(
			'title' => LAN_TWITS_CONFIG_06,
			'tab' => 0,
			'type' => 'boolean',
			'data' => 'str',
			'help'=>''
		),
		'cachetime'	=> array(
			'title' => LAN_TWITS_CONFIG_07_A,
			'tab' => 0,
			'type' =>'number',
			'data' => 'str',
			'help' => LAN_TWITS_CONFIG_07_B
		),
		'access_token'	=> array(
			'title' => LAN_TWITS_CONFIG_08,
			'tab' => 1,
			'type' => 'text',
			'data' => 'str',
			'help' => ''
		),
		'access_secret'	=> array(
			'title' => LAN_TWITS_CONFIG_09,
			'tab' => 1,
			'type' => 'text',
			'data' => 'str',
			'help' => ''
		),
		'consumer_key' => array(
			'title' => LAN_TWITS_CONFIG_10,
			'tab' => 1,
			'type' =>'text',
			'data' => 'str',
			'help' => ''
		),
		'consumer_secret' => array(
			'title' => LAN_TWITS_CONFIG_11,
			'tab' => 1,
			'type' => 'text',
			'data' => 'str',
			'help' => ''
		),
	);


	public function init()
	{
		$this->dateformat = array('short' => LAN_TWITS_CONFIG_12, 'long' => LAN_TWITS_CONFIG_13, 'relative' => LAN_TWITS_CONFIG_14);
		$this->prefs['dateformat']['writeParms'] = $this->dateformat;
	}

	// ------- Customize Create --------
	public function beforeCreate($new_data)
	{
		return $new_data;
	}

	public function afterCreate($new_data, $old_data, $id)
	{
		// do something
	}

	public function onCreateError($new_data, $old_data)
	{
		// do something
	}

	// ------- Customize Update --------
	public function beforeUpdate($new_data, $old_data, $id)
	{
		return $new_data;
	}

	public function afterUpdate($new_data, $old_data, $id)
	{
		// do something
	}

	public function onUpdateError($new_data, $old_data, $id)
	{
		// do something
	}
		/*
		// optional - a custom page.
		public function customPage()
		{
			$text = 'Hello World!';
			return $text;

		}
		*/
}

class twits_form_ui extends e_admin_form_ui
{
}

new twits_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;
?>
