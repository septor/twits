<?php
/*
 * Twits - A Twitter status display menu for e107
 *
 * Copyright (C) 2010-2015 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.mkd file.
 *
 */
if (!defined('e107_INIT')) { exit; }
include_once(e_PLUGIN.'twits/class.php');
require_once(e_PLUGIN.'twits/TwitterAPIExchange.php');
e107::lan('twits');

$pref = e107::pref('twits');
$tp = e107::getParser();
$sc = e107::getScBatch('twits', true);
$template = e107::getTemplate('twits');

$date_format = (($pref['dateformat']) ? $pref['dateformat'] : 'relative');
$tweets = (($pref['tweets']) ? $pref['tweets'] : '1');
$retweets = ($pref['retweets'] == true ? '1' : '0');
$menutitle = (!empty($pref['header']) ? $pref['header'] : LAN_TWITS_MENU_01);
$username = $pref['username'];
$twits_file = e_PLUGIN."twits/twits.json";
$cachetime = $pref['cachetime'] * 60;

$text = '';
if($username !== '' && !empty($pref['access_token']) && !empty($pref['access_secret']) && !empty($pref['consumer_key']) && !empty($pref['consumer_secret']))
{
	$settings = array(
		'oauth_access_token' => $pref['access_token'],
		'oauth_access_token_secret' => $pref['access_secret'],
		'consumer_key' => $pref['consumer_key'],
		'consumer_secret' => $pref['consumer_secret']
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

	if($pref['replies'] == '0')
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
	$user_description = $json[0]->user->description;
	$user_following = $json[0]->user->friends_count;
	$user_followers = $json[0]->user->followers_count;
	$user_lists = $json[0]->user->listed_count;
	$user_tweets = $json[0]->user->statuses_count;

	$b = 1;
	foreach($sid as $id)
	{
		if($b <= $tweets)
		{
			$datestamp = $tp->toDate(strtotime($json[$id]->created_at), $date_format);
			$tweet_id = $json[$id]->id;

			$sc->setVars(array(
				'username' => $username,
				'status' => parseContent($json[$id]->text),
				'datestamp' => array($username, $tweet_id, $datestamp),
				'retweet' => $tweet_id,
				'reply' => $tweet_id,
				'favorite' => $tweet_id,
			));

			$all_tweets .= $tp->parseTemplate($template['tweet'], false, $sc);
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
	$user_description = '';
	$all_tweets = '';
	$no_tweet_account = LAN_TWITS_MENU_02;
}

$sc->setVars(array(
	'user_screenname' => $username,
	'user_location' => $user_location,
	'user_icon' => array($username, $user_icon),
	'user_realname' => array($username, $user_realname),
	'user_url' => $user_url,
	'user_description' => $user_description,
	'user_following' => $user_following,
	'user_followers' => $user_followers,
	'user_lists' => $user_lists,
	'user_tweets' => $user_tweets,
	'all_tweets' => $all_tweets,
	'no_tweet_account' => $no_tweet_account
));

$text = $tp->parseTemplate($template['menu'], false, $sc);
e107::getRender()->tablerender($tp->toHTML($menutitle), $text, 'twits');
?>
