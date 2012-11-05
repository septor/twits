<?php
include_lan(e_PLUGIN.'twits_menu/languages/'.e_LANGUAGE.'.php');

// -- [ PLUGIN INFO ]
$eplug_name			= "Twits";
$eplug_version		= "0.3.2";
$eplug_author		= "Patrick Weaver"; 
$eplug_url			= "http://trickmod.com/";
$eplug_email		= "patrickweaver@gmail.com";
$eplug_description	= TWITS_PLUGIN_01;
$eplug_compatible	= "e107 v1.0+";
$eplug_readme		= "README.mkd";
$eplug_compliant	= TRUE;
$eplug_folder		= "twits_menu";
$eplug_menu_name	= "twits_menu";
$eplug_conffile		= "config.php";
$eplug_icon			= "";
$eplug_icon_small	= $eplug_icon;
$eplug_caption		= TWITS_PLUGIN_02; 

// -- [ DEFAULT PREFERENCES ]
$eplug_prefs = array(
    "twits_header" => '',
    "twits_username" => '',
    "twits_dateformat" => 'long',
    "twits_tweets" => '1',
    "twits_replies" => '1',
    "twits_retweets" => '0'
);
	
// -- [ MYSQL TABLES ]
$eplug_table_names = "";
$eplug_tables = "";

// -- [ MAIN SITE LINK ]
$eplug_link			= FALSE;
$eplug_link_name	= "";
$eplug_link_url		= "";

// -- [ INSTALLED MESSAGE ]
$eplug_done = $eplug_name.TWITS_PLUGIN_03;

// -- [ UPGRADE INFORMATION ]
$upgrade_add_prefs    = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done   = $eplug_name.TWITS_PLUGIN_04;
?>