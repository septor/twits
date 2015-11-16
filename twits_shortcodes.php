<?php
/*
 * Twits - A Twitter status display menu for e107
 *
 * Copyright (C) 2010-2015 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.mkd file.
 *
 */
if (!defined('e107_INIT')) { exit; }

class twits_shortcodes extends e_shortcode
{
	function sc_no_tweet_account($parm='')
	{
		return $this->var['no_tweet_account'];
	}

	function sc_all_tweets($parm='')
	{
		return $this->var['all_tweets'];
	}

	function sc_username($parm='')
	{
		return '<a href="https://twitter.com/'.$this->var['username'].'">'.$this->var['username'].'</a>';
	}

	function sc_user_screenname($parm='')
	{
		return $this->var['user_screenname'];
	}

	function sc_user_realname($parm='')
	{
		$item_array = $this->var['user_realname'];
		return '<a href="https://twitter.com/'.$item_array[0].'">'.$item_array[1].'</a>';
	}

	function sc_user_icon($parm='')
	{
		$item_array = $this->var['user_icon'];
		$linkclass = (isset($parm['linkclass']) ? $parm['linkclass'] : 'pull-left');
		$imgclass = (isset($parm['imgclass']) ? $parm['imgclass'] : 'img-circle');
		return '<a href="https://twitter.com/'.$item_array[0].'" class="'.$linkclass.'"><img src="'.$item_array[1].'" alt="" class="'.$imgclass.'"></a>';
		//return '<a href="https://twitter.com/'.$item_array[0].'"><img src="'.$item_array[1].'" style="float:left; margin-right:5px; max-width:30px;" /></a>';
	}

	function sc_user_location($parm='')
	{
		return $this->var['user_location'];
	}

	function sc_user_url($parm='')
	{
		return '<a href="'.$this->var['user_url'].'">'.$this->var['user_url'].'</a>';
	}

	function sc_user_description($parm='')
	{
		return $this->var['user_description'];
	}

	function sc_status($parm='')
	{
		return $this->var['status'];
	}

	function sc_datestamp($parm='')
	{
		$item_array = $this->var['datestamp'];
		return '<a href="https://twitter.com/'.$item_array[0].'/status/'.$item_array[1].'" target="_blank">'.$item_array[2].'</a>';
	}

	function sc_retweet($parm='')
	{
		return '<a href="javascript:;" onClick="window.open(\'https://twitter.com/intent/retweet?tweet_id='.$this->var['retweet'].'\',\'retweet\',\'scrollbars=yes,width=600,height=375\');">'.LAN_TWITS_MENU_03.'</a>';
	}

	function sc_reply($parm='')
	{
		return '<a href="javascript:;" onClick="window.open(\'https://twitter.com/intent/tweet?in_reply_to='.$this->var['reply'].'\',\'tweet\',\'scrollbars=yes,width=600,height=375\');">'.LAN_TWITS_MENU_04.'</a>';
	}

	function sc_favorite($parm='')
	{
		return '<a href="javascript:;" onClick="window.open(\'https://twitter.com/intent/favorite?tweet_id='.$this->var['favorite'].'\',\'favorite\',\'scrollbars=yes,width=600,height=375\');">'.LAN_TWITS_MENU_05.'</a>';
	}
}
?>
