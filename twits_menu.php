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

if($menu_pref['twits_menu']['username'] != ""){
	$xml = simplexml_load_file("https://twitter.com/statuses/user_timeline/".$menu_pref['twits_menu']['username'].".rss");

	function parseContent($text){
		$text = strip_tags($text);
		$text = preg_replace("/(https?:\/\/[^\s\)]+)/", "<a href='\\1'>\\1</a>", $text);
		$text = preg_replace("/\#([^\s\ \:\.\;\-\,\!\)\(\"]+)/", "<a href='http://search.twitter.com/search?q=%23\\1'>#\\1</a>", $text);
		$text = preg_replace("/\@([^\s\ \:\.\;\-\,\!\)\(\"]+)/", "@<a href='http://twitter.com/\\1'>\\1</a>", $text);
		return $text;
	}

	$status = parseContent($xml->channel->item[0]->title);

	$username = str_replace(":", "", substr($status, 0, strpos($status, ":")));
	$tweet = substr($status, strpos($status, ":")+2);

	$text = str_replace(
		array(
		"%_TWEET_%",
		"%_DATESTAMP_%"
	),
		array(
		"<a href='".$xml->channel->link."'>".$username."</a>: ".$tweet,
		"<a href='".$xml->channel->item[0]->link."'>".$gen->convert_date(strtotime(substr($xml->channel->item[0]->pubDate, 0, -6)))."</a>"
		),
	$TWITSTEMPLATE);

	$ns->tablerender($xml->channel->title, $text, 'twits');
}else{
	$ns->tablerender(TWITS_LAN005, TWITS_LAN006, 'twits');
}
?>