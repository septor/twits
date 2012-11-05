<?php 
if (!defined('e107_INIT')) { exit; }
include_once(e_HANDLER.'shortcode_handler.php');
global $tp;
$twits_shortcodes = $tp->e_sc->parse_scbatch(__FILE__);
/*
// ------------------------------------------------
SC_BEGIN NO_TWEET_ACCOUNT
	$item = getcachedvars('no_tweet_account');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN ALL_TWEETS
	$item = getcachedvars('all_tweets');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN USERNAME
	$item = getcachedvars('username');
	$item = "<a href='https://twitter.com/".$item."' alt=''>".$item."</a>";
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN STATUS
	$item = getcachedvars('status');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN DATESTAMP
	$item = getcachedvars('datestamp');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN RETWEET
	$item = getcachedvars('retweet');
	$item = "<a href='https://twitter.com/intent/retweet?tweet_id=".$item."' alt='' target='_blank'>".TWITS_MENU_01."</a>";
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN REPLY
	$item = getcachedvars('reply');
	$item = "<a href='https://twitter.com/intent/tweet?in_reply_to=".$item."' alt='' target='_blank'>".TWITS_MENU_02."</a>";
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN FAVORITE
	$item = getcachedvars('favorite');
	$item = "<a href='https://twitter.com/intent/favorite?tweet_id=".$item."' alt='' target='_blank'>".TWITS_MENU_03."</a>";
	return $item;
SC_END

*/
?>