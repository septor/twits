<?php
include_lan(e_PLUGIN.'twits_menu/languages/'.e_LANGUAGE.'.php');

// -- [ PLUGIN INFO ]
$eplug_name			= "Twits";
$eplug_version		= "0.3.3";
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
$eplug_icon			= $eplug_folder."/images/twit-menu_logo_32.png";
$eplug_icon_small	= $eplug_folder."/images/twit-menu_logo_16.png";
$eplug_caption		= TWITS_PLUGIN_02; 

// -- [ DEFAULT PREFERENCES ]
$eplug_prefs = array(
    "twits_header" => '',
    "twits_username" => '',
    "twits_dateformat" => 'long',
    "twits_tweets" => '1',
    "twits_replies" => '1',
    "twits_retweets" => '0',
	"twits_show_realname" => "1",
	"twits_show_screenname" => "1",
	"twits_show_usericon" => "1",
	"twits_show_userlocation" => "1",
	"twits_show_userurl" => "1",
    "twits_cacheupdate" => "60"
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
$upgrade_add_prefs    = array(
    "twits_header" => "",
	"twits_show_realname" => "1",
	"twits_show_screenname" => "1",
	"twits_show_usericon" => "1",
	"twits_show_userlocation" => "1",
	"twits_show_userurl" => "1",
    "twits_cacheupdate" => "60");
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done   = $eplug_name.TWITS_PLUGIN_04;
?>