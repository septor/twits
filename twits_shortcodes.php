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
SC_BEGIN USER_SCREENNAME
	$item = getcachedvars('user_screenname');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN USER_REALNAME
	$item_array = getcachedvars('user_realname');
	$item = "<a href='https://twitter.com/".$item_array[0]."' alt=''>".$item_array[1]."</a>";
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN USER_ICON
	$item_array = getcachedvars('user_icon');
	$item = "<a href='https://twitter.com/".$item_array[0]."' alt=''><img src='".$item_array[1]."' alt='' style='float:left; margin-right: 5px; max-width:30px;' /></a>";
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN USER_LOCATION
	$item = getcachedvars('user_location');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN USER_URL
	$item = getcachedvars('user_url');
	$item = "<a href='".$item."' alt=''>".$item."</a>";
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN STATUS
	$item = getcachedvars('status');
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN DATESTAMP
	$item_array = getcachedvars('datestamp');
	$item = "<a href='https://twitter.com/".$item_array[0]."/status/".$item_array[1]."' alt='' target='_blank'>".$item_array[2]."</a>";
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN RETWEET
	$item = getcachedvars('retweet');
	$item = "<a href=\"javascript:;\" onClick=\"window.open('https://twitter.com/intent/retweet?tweet_id=".$item."','retweet','scrollbars=yes,width=600,height=375');\">".TWITS_MENU_01."</a>";
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN REPLY
	$item = getcachedvars('reply');
	$item = "<a href=\"javascript:;\" onClick=\"window.open('https://twitter.com/intent/tweet?in_reply_to=".$item."','tweet','scrollbars=yes,width=600,height=375');\">".TWITS_MENU_02."</a>";
	return $item;
SC_END

// ------------------------------------------------
SC_BEGIN FAVORITE
	$item = getcachedvars('favorite');
	$item = "<a href=\"javascript:;\" onClick=\"window.open('https://twitter.com/intent/favorite?tweet_id=".$item."','favorite','scrollbars=yes,width=600,height=375');\">".TWITS_MENU_03."</a>";
	return $item;
SC_END

*/
?>