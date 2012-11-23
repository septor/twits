<?php
if (!defined('e107_INIT')) { exit; }
include_lan(e_PLUGIN.'twits_menu/languages/'.e_LANGUAGE.'.php');
include_once(e_PLUGIN.'twits_menu/class.php');
include(e_PLUGIN.'twits_menu/twits_shortcodes.php');
include_once(e_HANDLER.'date_handler.php');
if(file_exists(THEME.'twits_template.php'))
{
	include_once(THEME.'twits_template.php');
}
else
{
	include_once(e_PLUGIN.'twits_menu/twits_template.php');
}

global $tp, $sc_style;
$gen = new convert();
$date_format = (($pref['twits_dateformat']) ? $pref['twits_dateformat'] : 'long');
$tweets = (($pref['twits_tweets']) ? $pref['twits_tweets'] : '1');
$retweets = (($pref['twits_retweets']) ? $pref['twits_retweets'] : '0');
$menutitle = (!empty($pref['twits_header']) ? $pref['twits_header'] : TWITS_MENU_07);
$username = $pref['twits_username'];
$twits_file = e_PLUGIN."twits_menu/twits.xml";
$cachetime = $pref['twits_cachetime'] * 60;


$text = $tweet_text = '';
if($username !== '')
{
	if(!(file_exists($twits_file)) || time() - filemtime($twits_file) > $cachetime)
	{
		if(!(file_exists($twits_file)))
		{
			file_put_contents($twits_file, '');
		}
		$txml = file_get_contents('http://api.twitter.com/1/statuses/user_timeline/'.$username.'.xml?count=25&include_rts='.$retweets.'&callback=?');
		file_put_contents($twits_file, $txml);
	}
		
	$xml = simplexml_load_file($twits_file);
	$sid = array();

	if($pref['twits_replies'] == '0')
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
	
	$user_realname = $xml->status->user->name;
	$user_icon = $xml->status->user->profile_image_url;
	$user_location = $xml->status->user->location;
	$user_url = $xml->status->user->url;

	$b = 1;
	foreach($sid as $id)
	{
		if($b <= $tweets)
		{
			if($date_format == 'ago')
			{
				$timedif = time() - strtotime($xml->status[$id]->created_at);
				if($timedif <= 86400)
				{
					$datestamp = TWITS_MENU_08;
				}
				else if($timedif > 86401 && $timedif <= 172800)
				{
					$datestamp = TWITS_MENU_09;
				}
				else if($timedif > 2592000)
				{
					$months = floor($timedif / 2592000);
					$datestamp = str_replace("{0}", $months, ($months == 1 ? TWITS_MENU_11 : TWITS_MENU_12));
				}
				else
				{
					$datestamp = str_replace("{0}", floor($timedif / 86400), TWITS_MENU_10);
				}
			}
			else
			{
				$datestamp = $gen->convert_date(strtotime($xml->status[$id]->created_at), $date_format);
			}

			$tweet_id = $xml->status[$id]->id;
			cachevars('username', $username);
			cachevars('status', parseContent($xml->status[$id]->text));
			cachevars('datestamp', array($username, $tweet_id, $datestamp));
			cachevars('retweet', $tweet_id);
			cachevars('reply', $tweet_id);
			cachevars('favorite', $tweet_id);
			
			$all_tweets .= $tp->parseTemplate($EACH_TWEET, FALSE, $twits_shortcodes);				
		}
		$b++;
	}
	$no_tweet_account = '';
}
else
{
	$username = '';
	$user_realname = '';
	$user_icon = '';
	$user_location = '';
	$user_url = '';
	$all_tweets = '';
	$no_tweet_account = TWITS_MENU_06;
}
($pref['twits_show_realname'] == "1" ? cachevars('user_realname', array($username, $user_realname)) : '');
($pref['twits_show_screenname'] == "1" ? cachevars('user_screenname', $username) : '');
($pref['twits_show_usericon'] == "1" ? cachevars('user_icon', array($username, $user_icon)) : '');
($pref['twits_show_userlocation'] == "1" ? cachevars('user_location', $user_location) : '');
($pref['twits_show_userurl'] == "1" ? cachevars('user_url', $user_url) : '');
cachevars('all_tweets', $all_tweets);
cachevars('no_tweet_account', $no_tweet_account);
$text = $tp->parseTemplate($TWITS_MENU, FALSE, $twits_shortcodes);
$ns->tablerender($tp->toHTML($menutitle), $text, 'twits');
?>