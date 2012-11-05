<?php

if (!defined('e107_INIT')) { exit; }
include_lan(e_PLUGIN."twits_menu/languages/".e_LANGUAGE.".php");
include_once(e_PLUGIN."twits_menu/class.php");
include_once(e_HANDLER."date_handler.php");
if(file_exists(THEME."twits_template.php"))
{
	include_once(THEME."twits_template.php");
}
else
{
	include_once(e_PLUGIN."twits_menu/twits_template.php");
}

$gen = new convert();
$date_format = (($pref['twits_dateformat']) ? $pref['twits_dateformat'] : "long");
$tweets = (($pref['twits_tweets']) ? $pref['twits_tweets'] : "1");
$retweets = (($pref['twits_retweets']) ? $pref['twits_retweets'] : "0");

if($pref['twits_username'] != "")
{
	$username = $pref['twits_username'];
	$xml = simplexml_load_file("http://api.twitter.com/1/statuses/user_timeline/".$username.".xml?count=25&include_rts=".$retweets."&callback=?");
	$sid = array();

	if($pref['twits_replies'] == "0")
	{
		$a = 0;
		foreach($xml as $status)
		{
			$a++;
			if(empty($status->in_reply_to_user_id))
			{
				array_push($sid, ($a-1));
			}
		}
	}
	else
	{
		for($i = 0; $i <= ($tweets - 1); $i++)
		{
			array_push($sid, $i);
		}
	}

	$b = 1;
	foreach($sid as $id)
	{
		if($b <= $tweets)
		{
			$text .= str_replace(
				array(
				"%_USERNAME_%",
				"%_STATUS_%",
				"%_DATESTAMP_%",
				"%_RETWEET_%",
				"%_REPLY_%",
				"%_FAVORITE_%"
			),

				array(
				"<a href='https://twitter.com/".$username."'>".$username."</a>",
				parseContent($xml->status[$id]->text),
				"<a href='https://twitter.com/".$username."/status/".$xml->status[$id]->id."'>".$gen->convert_date(strtotime($xml->status[$id]->created_at), $date_format)."</a>",
				"<a href='https://twitter.com/intent/retweet?in_reply_to=".$xml->status[$id]->id."' target='_blank'>".TWITS_MENU_01."</a>",
				"<a href='https://twitter.com/intent/tweet?in_reply_to=".$xml->status[$id]->id."' target='_blank'>".TWITS_MENU_02."</a>",
				"<a href='https://twitter.com/intent/favorite?in_reply_to=".$xml->status[$id]->id."' target='_blank'>".TWITS_MENU_03."</a>"
			),
			$TWITSTEMPLATE);
		}
		$b++;
	}

	$ns->tablerender("@".$username.TWITS_MENU_04, $text, 'twits');
}
else
{
	$ns->tablerender(TWITS_MENU_05, TWITS_MENU_06, 'twits');
}
?>