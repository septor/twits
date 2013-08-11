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
require_once(e_PLUGIN.'twits_menu/TwitterAPIExchange.php');

global $tp, $sc_style;
$gen = new convert();
$date_format = (($pref['twits_dateformat']) ? $pref['twits_dateformat'] : 'long');
$tweets = (($pref['twits_tweets']) ? $pref['twits_tweets'] : '1');
$retweets = (($pref['twits_retweets']) ? $pref['twits_retweets'] : '0');
$menutitle = (!empty($pref['twits_header']) ? $pref['twits_header'] : TWITS_MENU_07);
$username = $pref['twits_username'];
$twits_file = e_PLUGIN."twits_menu/twits.json";
$cachetime = $pref['twits_cachetime'] * 60;

$text = $tweet_text = '';
if($username !== '' && !empty($pref['twits_oauth_access_token']) && !empty($pref['twits_oauth_access_token_secret']) && !empty($pref['twits_consumer_key']) && !empty($pref['twits_consumer_secret']))
{
	$settings = array(
	    'oauth_access_token' => $pref['twits_oauth_access_token'],
	    'oauth_access_token_secret' => $pref['twits_oauth_access_token_secret'],
	    'consumer_key' => $pref['twits_consumer_key'],
	    'consumer_secret' => $pref['twits_consumer_secret']
	);

	if(!(file_exists($twits_file)) || time() - filemtime($twits_file) > $cachetime)
	{
		$twitter = new TwitterAPIExchange($settings);
		$response = $twitter->setGetfield('?screen_name='.$username.'&include_rts='.$retweets)
		                    ->buildOauth('https://api.twitter.com/1.1/statuses/user_timeline.json', 'GET')
		                    ->performRequest();
		file_put_contents($twits_file, $response);
	}

	$json = json_decode(file_get_contents($twits_file));


	$sid = array();

	if($pref['twits_replies'] == '0')
	{
		$a = 0;
		foreach($json as $status)
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
	
	$user_realname = $json[0]->user->name;
	$user_icon = $json[0]->user->profile_image_url;
	$user_location = $json[0]->user->location;
	$user_url = $json[0]->user->url;

	$b = 1;
	foreach($sid as $id)
	{
		if($b <= $tweets)
		{
			if($date_format == 'ago')
			{
				$timedif = time() - strtotime($json[$id]->created_at);
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
				$datestamp = $gen->convert_date(strtotime($json[$id]->created_at), $date_format);
			}

			$tweet_id = $json[$id]->id;
			cachevars('username', $username);
			cachevars('status', parseContent($json[$id]->text));
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