<?php
global $sc_style;
$sc_style['NO_TWEET_ACCOUNT']['pre'] = "<div style='text-align:center;'><span class='smalltext'>";
$sc_style['NO_TWEET_ACCOUNT']['post'] = "</span></div>";

$sc_style['USER_REALNAME']['post'] = "<br />";
$sc_style['USER_LOCATION']['post'] = "<br />";
$sc_style['USER_URL']['post'] = "<br />";

$sc_style['USER_SCREENNAME']['pre'] = "<span style='font-size:150%; font-weight:bold;'>";
$sc_style['USER_SCREENNAME']['post'] = "</span><hr />";

$TWITS_MENU = "
<div class='forumheader2'>
	<span class='smalltext'>
	{USER_ICON}{USER_REALNAME}
	{USER_LOCATION}
	{USER_URL}
	{USER_SCREENNAME}
	{ALL_TWEETS}
	{NO_TWEET_ACCOUNT}
	</span>
</div>";

$EACH_TWEET = "
<div style='border-bottom-width: 1px; border-bottom-style: dotted; border-bottom-color: #000; overflow-x: hidden; overflow-y: hidden;'>
	<span class='smalltext'>
	{USERNAME}: {STATUS}<br />
	{DATESTAMP} &bull; {REPLY} &bull; {RETWEET} &bull; {FAVORITE}
	</span>
</div>";
?>