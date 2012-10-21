<?php

if (!defined('e107_INIT')) { exit; }
include_lan(e_PLUGIN."twits_menu/languages/".e_LANGUAGE.".php");
include_once(e_HANDLER."date_handler.php");
if(file_exists(THEME."twits_template.php")){
	include_once(THEME."twits_template.php");
}else{
	include_once(e_PLUGIN."twits_menu/twits_template.php");
}

$gen = new convert();
$date_format = (($menu_pref['twits_menu']['datestyle']) ? $menu_pref['twits_menu']['datestyle'] : "long");

if($menu_pref['twits_menu']['username'] != ""){
	$xml = simplexml_load_file("http://api.twitter.com/1/statuses/user_timeline/".$menu_pref['twits_menu']['username'].".xml?count=1&include_rts=0callback=?");

	function parseContent($text){
		$text = strip_tags($text);
		$text = preg_replace("/(https?:\/\/[^\s\)]+)/", "<a href='\\1'>\\1</a>", $text);
		$text = preg_replace("/\#([^\s\ \:\.\;\-\,\!\)\(\"]+)/", "<a href='http://search.twitter.com/search?q=%23\\1'>#\\1</a>", $text);
		$text = preg_replace("/\@([^\s\ \:\.\;\-\,\!\)\(\"]+)/", "<a href='http://twitter.com/\\1'>@\\1</a>", $text);
		return $text;
	}

	$username = $xml->status->user->screen_name;
	$tweet = parseContent($xml->status->text);

	$text = str_replace(
		array(
		"%_TWEETER_%",
		"%_TWEET_%",
		"%_DATESTAMP_%"
	),
		array(
		"<a href='http://twitter.com/".$username."'>".$username."</a>",
		$tweet,
		"<a href='http://twitter.com/".$username."/status/".$xml->status->id."'>".$gen->convert_date(strtotime($xml->status->created_at, $date_format))."</a>"
		),
	$TWITSTEMPLATE);

	$ns->tablerender("@".$username, $text, 'twits');
}else{
	$ns->tablerender(TWITS_LAN005, TWITS_LAN006, 'twits');
}
?>